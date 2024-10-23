
<?php
include './db.php';
include('includes/sessions.php');

header('Content-Type: application/json'); 
$userid = $_SESSION['id'];


if($_GET['amount']){
    $amount = floatval($_GET['amount']); 
    $bonus=$amount*0.01;
    $total=$amount+$bonus;
    $sql="UPDATE users SET deposit_wallet=deposit_wallet+$total,withdraw_wallet=withdraw_wallet-$amount WHERE id='$userid'";
    $result = mysqli_query($con, $sql);

     if (mysqli_query($con, $sql)) {
        // If the query is successful, send a success response
        echo json_encode([
            'success' => true,
            'amount' => $amount,
            'total' => $total,
            'message' => "Converted $amount to Deposit Money with a 1% bonus of $bonus. Total credited: $total."
        ]);
    } else {
        // If there's an error in the SQL execution
        echo json_encode([
            'success' => false,
            'message' => 'Error updating balance: ' . mysqli_error($con)
        ]);
    }
} else {
    // If 'amount' is not set in the GET request
    echo json_encode([
        'success' => false,
        'message' => 'No amount specified.'
    ]);
}



?>
