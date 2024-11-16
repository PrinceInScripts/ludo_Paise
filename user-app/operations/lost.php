<?php
require_once '../db.php';
$user_id = $_SESSION['id'];

if (isset($_POST['battle_id'])) {

    $battle_id = $_POST['battle_id'];

    $fetch = "SELECT * FROM games WHERE id = '$battle_id' AND is_complete = 0 AND (created_by = '$user_id' OR accepted_by = '$user_id')";
    $result = mysqli_query($con, $fetch);
    $fetch = mysqli_fetch_assoc($result);

    if (mysqli_num_rows($result) > 0) {
        if ($fetch['created_by'] == $user_id) {
            // fetch games table
            $getGames = "SELECT * FROM games WHERE id = '$battle_id'";
            $getGamesResult = mysqli_query($con, $getGames);
            $getGamesRow = mysqli_fetch_assoc($getGamesResult);
            $opponent = $getGamesRow['accepted_by'];
            $prize = $getGamesRow['winAmount'];
            $amount = $getGamesRow['amount'];
            $status = 'complete';
            $isComplete = 1;
            $reason = 'Game lost by creator';
            $winner = $opponent;
            $remark = 'Game lost by creator';
            $creator_ss = 'lost';

            // UPDATE `games` SET `id`='[value-1]',`game_id`='[value-2]',`game_type`='[value-3]',`roomcode`='[value-4]',`amount`='[value-5]',`winAmount`='[value-6]',`created_by`='[value-7]',`accepted_by`='[value-8]',`created_at`='[value-9]',`updated_at`='[value-10]',`status`='[value-11]',`is_complete`='[value-12]',`creator_ss`='[value-13]',`acceptor_ss`='[value-14]',`creator_join_ss`='[value-15]',`acceptor_join_ss`='[value-16]',`status_reason`='[value-17]',`room_status`='[value-18]',`winner`='[value-19]',`isJoined`='[value-20]',`remark`='[value-21]' WHERE 1

            $sql = "UPDATE games SET status = '$status', is_complete = '$isComplete', creator_ss = '$creator_ss', status_reason = '$reason', winner = '$winner', remark = '$remark' WHERE id = '$battle_id' AND created_by = '$user_id'";
            // update balance of opponent
            $updateBalance = "UPDATE users SET withdraw_wallet = withdraw_wallet + '$prize' WHERE id = '$opponent'";
            $updateBalanceResult = mysqli_query($con, $updateBalance);
            //insert that amount in amount table for taking all amount insert data
            $sql1 = "INSERT INTO amount (amount, user_id) VALUES ('$prize', '$opponent')";
            $insertAmount = mysqli_query($con, $sql1);

            if ($updateBalanceResult) {
                // INSERT INTO `game_record`(`id`, `user_id`, `game_id`, `amount`, `ProfitAmount`, `status`, `remark`, `created_at`, `updated_at`) VALUES ('[value-1]','[value-2]','[value-3]','[value-4]','[value-5]','[value-6]','[value-7]','[value-8]','[value-9]') 
                $insertRecord = "INSERT INTO game_record (user_id, game_id, amount, ProfitAmount, status, remark) VALUES ('$opponent', '$battle_id', '$amount', '$prize', 'won', 'Game Won')";
                $insertRecord2 = "INSERT INTO game_record (user_id, game_id, amount, ProfitAmount, status, remark) VALUES ('$user_id', '$battle_id', '$amount', '$amount', 'lost', 'Game Lost')";
                $insertRecordResult = mysqli_query($con, $insertRecord);
                $insertRecordResult2 = mysqli_query($con, $insertRecord2);
            }

            // 2% for winner referral and 1% for loser referral 
            $winnerReferral = $amount * 0.02;
            $loserReferral = $amount * 0.01;

            // fetch referral code of winner 
            $fetchWinnerReferral = "SELECT level_1 FROM users WHERE id = '$opponent'";
            $fetchWinnerReferralResult = mysqli_query($con, $fetchWinnerReferral);
            $fetchWinnerReferralRow = mysqli_fetch_assoc($fetchWinnerReferralResult);
            $winnerReferralCode = $fetchWinnerReferralRow['level_1'];

            // fetch referral code of loser
            $fetchLoserReferral = "SELECT level_1 FROM users WHERE id = '$user_id'";
            $fetchLoserReferralResult = mysqli_query($con, $fetchLoserReferral);
            $fetchLoserReferralRow = mysqli_fetch_assoc($fetchLoserReferralResult);
            $loserReferralCode = $fetchLoserReferralRow['level_1'];

            // check if winner has referral code 

            if ($winnerReferralCode != null) {
                $updateWinnerReferral = "UPDATE users SET withdraw_wallet = withdraw_wallet + '$winnerReferral', referral_earning = referral_earning + '$winnerReferral' WHERE id = '$winnerReferralCode'";
                $updateWinnerReferralResult = mysqli_query($con, $updateWinnerReferral);
                //insert that amount in amount table for taking all amount insert data
                $sql1 = "INSERT INTO amount (amount, user_id) VALUES ('$winnerReferral', '$winnerReferralCode')";
                $insertAmount = mysqli_query($con, $sql1);


                // insert into referral_data table 
                $insertReferralData = "INSERT INTO referral_data (earn_to, battle_id, amount, earn_from, remark) VALUES ('$winnerReferralCode', '$battle_id', '$winnerReferral', '$user_id', '2% Referral Bonus')";
                $insertReferralDataResult = mysqli_query($con, $insertReferralData);

            }

            if ($loserReferralCode != null) {
                $updateLoserReferral = "UPDATE users SET withdraw_wallet = withdraw_wallet + '$loserReferral', referral_earning = referral_earning + '$loserReferral' WHERE id = '$loserReferralCode'";
                $updateLoserReferralResult = mysqli_query($con, $updateLoserReferral);
                //insert that amount in amount table for taking all amount insert data
                $sql1 = "INSERT INTO amount (amount, user_id) VALUES ('$loserReferral', '$loserReferralCode')";
                $insertAmount = mysqli_query($con, $sql1);


                // insert into referral_data table
                $insertReferralData = "INSERT INTO referral_data (earn_to, battle_id, amount, earn_from, remark) VALUES ('$loserReferralCode', '$battle_id', '$loserReferral', '$user_id', '1% Referral Bonus')";
                $insertReferralDataResult = mysqli_query($con, $insertReferralData);
            }



            $result = mysqli_query($con, $sql);
            if ($result) {
                echo json_encode([['error' => false, 'message' => "Lost by creator."]]);
            } else {
                echo json_encode([['error' => true, 'message' => "An error occured."]]);
            }
        } else {
            // fetch games table
            $getGames = "SELECT * FROM games WHERE id = '$battle_id'";
            $getGamesResult = mysqli_query($con, $getGames);
            $getGamesRow = mysqli_fetch_assoc($getGamesResult);
            $opponent = $getGamesRow['created_by'];
            $prize = $getGamesRow['winAmount'];
            $amount = $getGamesRow['amount'];
            $status = 'complete';
            $isComplete = 1;
            $reason = 'Game lost by acceptor';
            $winner = $opponent;
            $remark = 'Game lost by acceptor';
            $acceptor_ss = 'lost';

            $sql = "UPDATE games SET status = '$status', is_complete = '$isComplete', acceptor_ss = '$acceptor_ss', status_reason = '$reason', winner = '$winner', remark = '$remark' WHERE id = '$battle_id' AND accepted_by = '$user_id'";

            $updateBalance = "UPDATE users SET withdraw_wallet = withdraw_wallet + '$prize' WHERE id = '$opponent'";
            $updateBalanceResult = mysqli_query($con, $updateBalance);
            //insert that amount in amount table for taking all amount insert data
            $sql1 = "INSERT INTO amount (amount, user_id) VALUES ('$prize', '$opponent')";
            $insertAmount = mysqli_query($con, $sql1);
            

            if ($updateBalanceResult) {
                // INSERT INTO `game_record`(`id`, `user_id`, `game_id`, `amount`, `ProfitAmount`, `status`, `remark`, `created_at`, `updated_at`) VALUES ('[value-1]','[value-2]','[value-3]','[value-4]','[value-5]','[value-6]','[value-7]','[value-8]','[value-9]') 
                $insertRecord = "INSERT INTO game_record (user_id, game_id, amount, ProfitAmount, status, remark) VALUES ('$opponent', '$battle_id', '$amount', '$prize', 'won', 'Game Won')";
                $insertRecord2 = "INSERT INTO game_record (user_id, game_id, amount, ProfitAmount, status, remark) VALUES ('$user_id', '$battle_id', '$amount', '$amount', 'lost', 'Game Lost')";
                $insertRecordResult = mysqli_query($con, $insertRecord);
                $insertRecordResult2 = mysqli_query($con, $insertRecord2);
            }

            $result = mysqli_query($con, $sql);
            if ($result) {
                echo json_encode([['error' => false, 'message' => "Lost by acceptor."]]);
            } else {
                echo json_encode([['error' => true, 'message' => "An error occured."]]);
            }
        }
    } else {
        echo json_encode([['error' => true, 'message' => "Battle not found or unauthorized access."]]);
    }
} else {
    echo json_encode([['error' => true, 'message' => "Missing battle ID or user ID."]]);
}
