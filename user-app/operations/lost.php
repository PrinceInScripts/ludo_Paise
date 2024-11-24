<?php
require_once '../db.php';
$user_id = $_SESSION['id'];

if (isset($_POST['battle_id'])) {
    $battle_id = $_POST['battle_id'];

    // Fetch game details
    $fetchGameQuery = $con->prepare("SELECT * FROM games WHERE id = ? AND is_complete = 0 AND (created_by = ? OR accepted_by = ?)");
    $fetchGameQuery->bind_param("iii", $battle_id, $user_id, $user_id);
    $fetchGameQuery->execute();
    $gameResult = $fetchGameQuery->get_result();
    $gameData = $gameResult->fetch_assoc();

    if ($gameResult->num_rows > 0) {
        $isCreator = $gameData['created_by'] == $user_id;
        $opponent = $isCreator ? $gameData['accepted_by'] : $gameData['created_by'];
        $prize = $gameData['winAmount'];
        $amount = $gameData['amount'];
        $reason = $isCreator ? 'Game lost by creator' : 'Game lost by acceptor';
        $remark = $isCreator ? 'Game lost by creator' : 'Game lost by acceptor';
        $ssField = $isCreator ? 'creator_ss' : 'acceptor_ss';

        // Update game status
        $updateGameQuery = $con->prepare("UPDATE games SET status = 'complete', is_complete = 1, $ssField = 'lost', status_reason = ?, winner = ?, remark = ? WHERE id = ? AND ($ssField = 'pending')");
        $updateGameQuery->bind_param("sisi", $reason, $opponent, $remark, $battle_id);
        $updateGameQuery->execute();

        // Update opponent balance
        $updateBalanceQuery = $con->prepare("UPDATE users SET withdraw_wallet = withdraw_wallet + ? WHERE id = ?");
        $updateBalanceQuery->bind_param("ii", $prize, $opponent);
        $updateBalanceQuery->execute();

        // Insert amount into the amount table
        $insertAmountQuery = $con->prepare("INSERT INTO amount (amount, user_id, type) VALUES (?, ?, 'credited')");
        $insertAmountQuery->bind_param("ii", $prize, $opponent);
        $insertAmountQuery->execute();

        // Insert game records
        $insertGameRecordQuery = $con->prepare("INSERT INTO game_record (user_id, game_id, amount, ProfitAmount, status, remark) VALUES (?, ?, ?, ?, ?, ?)");
        $insertGameRecordQuery->bind_param("iiisss", $opponent, $battle_id, $amount, $prize, $statusWon = 'won', $remarkWon = 'Game Won');
        $insertGameRecordQuery->execute();
        $insertGameRecordQuery->bind_param("iiisss", $user_id, $battle_id, $amount, $amount, $statusLost = 'lost', $remarkLost = 'Game Lost');
        $insertGameRecordQuery->execute();

        // Process referral bonuses
        processReferralBonus($con, $opponent, $user_id, $amount);

        echo json_encode(['error' => false, 'message' => $reason]);
    } else {
        echo json_encode(['error' => true, 'message' => "Invalid battle ID or no active game."]);
    }
}

/**
 * Process referral bonuses for both winner and loser.
 */
function processReferralBonus($con, $winner, $loser, $amount)
{
    $winnerReferral = $amount * 0.02;
    $loserReferral = $amount * 0.01;

    // Fetch referral codes
    $winnerReferralCode = getReferralCode($con, $winner);
    $loserReferralCode = getReferralCode($con, $loser);

    // Update and log winner referral bonus
    if ($winnerReferralCode) {
        updateReferralBonus($con, $winnerReferralCode, $winnerReferral, $loser, '2% Referral Bonus');
    }

    // Update and log loser referral bonus
    if ($loserReferralCode) {
        updateReferralBonus($con, $loserReferralCode, $loserReferral, $loser, '1% Referral Bonus');
    }
}

/**
 * Fetch referral code for a user.
 */
function getReferralCode($con, $userId)
{
    $referralQuery = $con->prepare("SELECT level_1 FROM users WHERE id = ?");
    $referralQuery->bind_param("i", $userId);
    $referralQuery->execute();
    $result = $referralQuery->get_result();
    $row = $result->fetch_assoc();
    return $row['level_1'] ?? null;
}

/**
 * Update referral bonus and log the referral data.
 */
function updateReferralBonus($con, $referrerId, $amount, $sourceUser, $remark)
{
    // Update user wallet and referral earnings
    $updateReferralQuery = $con->prepare("UPDATE users SET withdraw_wallet = withdraw_wallet + ?, referral_earning = referral_earning + ? WHERE referrer_id = ?");
    $updateReferralQuery->bind_param("iii", $amount, $amount, $referrerId);
    $updateReferralQuery->execute();

    // Insert into amount table
    $insertAmountQuery = $con->prepare("INSERT INTO amount (amount, user_id, type) VALUES (?, ?, 'credited')");
    $insertAmountQuery->bind_param("ii", $amount, $referrerId);
    $insertAmountQuery->execute();

    // Log referral data
    $insertReferralDataQuery = $con->prepare("INSERT INTO referral_data (earn_to, battle_id, amount, earn_from, remark) VALUES (?, ?, ?, ?, ?)");
    $insertReferralDataQuery->bind_param("iiiss", $referrerId, $sourceUser, $amount, $remark);
    $insertReferralDataQuery->execute();
}
?>
