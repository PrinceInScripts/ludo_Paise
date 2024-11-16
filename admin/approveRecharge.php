<?php
include('db.php');

if (isset($_POST['order_id']) && isset($_POST['r_type'])) {
    $r_type = $_POST['r_type'];

    if ($r_type == 'credit') {
        $order_id = $_POST['order_id'];
        $sql = "UPDATE paymenthistory SET status = 1 WHERE order_id = '$order_id' AND status = 0";
        $result = mysqli_query($con, $sql);
        if ($result) {
            // fetch amount and update users wallet
            $fetch = "SELECT * FROM paymenthistory WHERE order_id = '$order_id'";
            $result = mysqli_query($con, $fetch);
            $fetch = mysqli_fetch_assoc($result);
            $amount = $fetch['amount'];
            $userid = $fetch['userid'];
            $sql = "UPDATE users SET deposit_wallet = deposit_wallet + '$amount' WHERE id = '$userid'";
            $result = mysqli_query($con, $sql);

            // insert amount in amount table for taking all amount insert data in amount table
            $sql1 = "INSERT INTO amount (amount, user_id,type) VALUES ('$amount', '$userid','credited')";
            $insertAmount = mysqli_query($con, $sql1);
            
            
            if ($result) {
                echo json_encode(array('status' => 'success','type' => 'credit'));
            } else {
                echo json_encode(array('status' => 'error','type' => 'credit', 'message' => 'Error adding penalty: ' . mysqli_error($con)));
            }
        } else {
            echo 'error';
        }
    } else {
        $order_id = $_POST['order_id'];
        $sql = "UPDATE paymenthistory SET status = 2 WHERE order_id = '$order_id' AND status = 0";
        $result = mysqli_query($con, $sql);
        if ($result) {
            echo json_encode(array('status' => 'success','type' => 'debit'));
        } else {
            echo json_encode(array('status' => 'error','type' => 'debit', 'message' => 'Error adding penalty: ' . mysqli_error($con)));
        }
    }
}
