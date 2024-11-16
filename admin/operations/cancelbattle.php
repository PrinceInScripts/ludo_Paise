<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', '../errors.log'); // Log errors to a file named errors.log

include('../db.php');

if (isset($_POST['id']) && !empty($_POST['id'])) {
    $id = mysqli_real_escape_string($con, $_POST['id']); // Sanitize input to prevent SQL injection

    // Fetch game data from database using the provided ID
    $sql = "SELECT * FROM games WHERE id = '$id'";
    $result = mysqli_query($con, $sql);

    if (!$result) {
        error_log("Database query failed: " . mysqli_error($con)); // Log error
        echo json_encode(array("status" => "failed", "error" => "Failed to fetch game data."));
        exit;
    }

    $row = mysqli_fetch_assoc($result);
    if (!$row) {
        echo json_encode(array("status" => "failed", "error" => "Game not found."));
        exit;
    }

    // Update game status to cancelled
    $sql = "UPDATE games SET status = 'cancel', creator_ss = 'cancel', acceptor_ss = 'cancel', 
            status_reason = 'cancelled by admin', remark = 'cancelled by admin' WHERE id = '$id'";
    if (!mysqli_query($con, $sql)) {
        error_log("Failed to update game status: " . mysqli_error($con)); // Log error
    }

    // Refund the amount to both players
    $player1 = $row['created_by'];
    $player2 = $row['accepted_by'];
    $amount = $row['amount'];

    $refund_sql = "UPDATE users SET deposit_wallet = deposit_wallet + ? WHERE id = ?";
    $stmt = mysqli_prepare($con, $refund_sql);
    if (!$stmt) {
        error_log("Failed to prepare statement for refund: " . mysqli_error($con)); // Log error
        echo json_encode(array("status" => "failed", "error" => "Refund process failed."));
        exit;
    }

    mysqli_stmt_bind_param($stmt, 'di', $amount, $player1);
    if (!mysqli_stmt_execute($stmt)) {
        error_log("Failed to refund player1: " . mysqli_error($con)); // Log error
    }

    mysqli_stmt_bind_param($stmt, 'di', $amount, $player2);
    if (!mysqli_stmt_execute($stmt)) {
        error_log("Failed to refund player2: " . mysqli_error($con)); // Log error
    }
    mysqli_stmt_close($stmt);

    // Record the cancellation in the game_record table
    $record_sql = "INSERT INTO game_record (game_id, user_id, amount, ProfitAmount, deposit_balance, withdraw_balance, status, remark) 
                   VALUES (?, ?, ?, 0, 0, 0, 'game_refund', 'battle cancelled by admin')";
    $stmt = mysqli_prepare($con, $record_sql);
    if (!$stmt) {
        error_log("Failed to prepare statement for game record: " . mysqli_error($con)); // Log error
        echo json_encode(array("status" => "failed", "error" => "Game record update failed."));
        exit;
    }

    mysqli_stmt_bind_param($stmt, 'iid', $id, $player1, $amount);
    if (!mysqli_stmt_execute($stmt)) {
        error_log("Failed to record refund for player1: " . mysqli_error($con)); // Log error
    }

    mysqli_stmt_bind_param($stmt, 'iid', $id, $player2, $amount);
    if (!mysqli_stmt_execute($stmt)) {
        error_log("Failed to record refund for player2: " . mysqli_error($con)); // Log error
    }
    mysqli_stmt_close($stmt);

    echo json_encode(array("status" => "success"));
} else {
    echo json_encode(array("status" => "failed", "error" => "Invalid or missing ID."));
}
?>
