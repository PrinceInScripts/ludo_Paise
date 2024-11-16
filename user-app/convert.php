<?php
include './db.php';
include('includes/sessions.php');

header('Content-Type: application/json'); 

$userid = $_SESSION['id'];

$users = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM users WHERE id = $userid"));
$withdraw_balance = $users['withdraw_wallet'];

// Check if the session is active
if (!$userid) {
    echo json_encode([
        'success' => false,
        'message' => 'User not logged in.'
    ]);
    exit;
}


// Validate and sanitize the amount
if (isset($_GET['amount']) && is_numeric($_GET['amount']) && $_GET['amount'] > 0) {
    $amount = floatval($_GET['amount']); 

    if($amount > $withdraw_balance) {
        echo json_encode([
            'success' => false,
            'message' => 'Insufficient balance.'
        ]);
        exit;
    }

    $bonus = $amount * 0.01;
    $total = $amount + $bonus;

    // Use a transaction to ensure atomicity
    mysqli_begin_transaction($con);

    try {
        // Update the wallet balances, only deduct $amount from withdraw_wallet
        $sql = "UPDATE users SET deposit_wallet = deposit_wallet + ?, withdraw_wallet = withdraw_wallet - ? WHERE id = ?";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, 'ddi', $total, $amount, $userid);
        mysqli_stmt_execute($stmt);

                //insert that amount in amount table for taking all amount insert data in amount table
          $sql1 = "INSERT INTO amount (amount, user_id,type) VALUES ($bonus, $userid,'credited')";
          mysqli_query($con, $sql1);

        if (mysqli_stmt_affected_rows($stmt) > 0) {
            // Commit the transaction
            mysqli_commit($con);
            
            echo json_encode([
                'success' => true,
                'amount' => $amount,
                'total' => $total,
                'message' => "Converted $amount to Deposit Money with a 1% bonus of $bonus. Total credited: $total."
            ]);
        } else {
            throw new Exception('Error updating balance. No rows affected.');
        }
    } catch (Exception $e) {
        // Rollback the transaction on error
        mysqli_rollback($con);
        
        echo json_encode([
            'success' => false,
            'message' => 'Error updating balance: ' . $e->getMessage()
        ]);
    }

} else {
    // Handle missing or invalid 'amount' in the GET request
    echo json_encode([
        'success' => false,
        'message' => 'Invalid or missing amount.'
    ]);
}
?>
