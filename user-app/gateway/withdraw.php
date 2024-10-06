<?php

require_once '../db.php';
$user_id = $_SESSION['id'];

// Fetch existing user data
$query = "SELECT * FROM users WHERE id = '$user_id'";
$result = mysqli_query($con, $query);
$user = mysqli_fetch_assoc($result);

$wallet = $user['withdraw_wallet'];

$setting = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM settings WHERE id = 1"));

$minWithdraw = $setting['minWithdraw'];

// fetch bank details from bankdetails table 

$bankdetails = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM bankdetails WHERE userid = '$user_id'"));

if(!$bankdetails){
    echo json_encode(array('status' => 'error', 'message' => 'Please add bank details first','url'=>'bank'));
    exit();
}elseif($bankdetails['status'] == 0){
    echo json_encode(array('status' => 'error', 'message' => 'Bank details not verified yet','url'=>'bank'));
    exit();
}elseif($bankdetails['upi'] == ''){
    echo json_encode(array('status' => 'error', 'message' => 'Please add UPI first','url'=>'bank'));
    exit();
}elseif($bankdetails['account'] == ''){
    echo json_encode(array('status' => 'error', 'message' => 'Please add account number first','url'=>'bank'));
    exit();
}elseif($bankdetails['ifsc'] == ''){
    echo json_encode(array('status' => 'error', 'message' => 'Please add IFSC code first','url'=>'bank'));
    exit();
}


// Initiate payment link AND UPDATE in database 

// Fetch existing user data

if (isset($_POST['payment_mode']) && isset($_POST['amount'])) {



    $payment_mode = $_POST['payment_mode'];
    $amount = $_POST['amount'];
    $mobile = $user['mobile'];  // assuming mobile is passed in the POST data

    if ($wallet < $amount) {
        echo json_encode(array('status' => 'error', 'message' => 'Insufficient balance'));
    } else if ($amount < $minWithdraw) {
        echo json_encode(array('status' => 'error', 'message' => 'Minimum withdraw amount is ' . $minWithdraw));
    } else {

        sleep(1);

        if ($payment_mode == 'upi') {
            $newWallet = $wallet - $amount;
            $sql = "UPDATE users SET withdraw_wallet = '$newWallet' WHERE id = '$user_id'";
            $result = mysqli_query($con, $sql);
            $txn_id = uniqid('txn_');
            $sql = "INSERT INTO withdrawrecord (userid, amount, type, txnid, status) VALUES ('$user_id', '$amount', 'upi', '$txn_id', 0)";
            $result = mysqli_query($con, $sql);
            if ($result) {
                
                echo json_encode(array('status' => 'success', 'message' => 'Withdraw request submitted successfully','url'=>'history'));
            } else {
                echo json_encode(array('status' => 'error', 'message' => 'An error occurred'));
            }
        } else if ($payment_mode == 'bankcard') {
            $newWallet = $wallet - $amount;
            $sql = "UPDATE users SET withdraw_wallet = '$newWallet' WHERE id = '$user_id'";
            $result = mysqli_query($con, $sql);
            $txn_id = uniqid('txn_');
            $sql = "INSERT INTO withdrawrecord (userid, amount, type, txnid, status) VALUES ('$user_id', '$amount', 'bank', '$txn_id', 0)";
            $result = mysqli_query($con, $sql);
            if ($result) {
                
                echo json_encode(array('status' => 'success', 'message' => 'Withdraw request submitted successfully','url'=>'history'));
            } else {
                echo json_encode(array('status' => 'error', 'message' => 'An error occurred'));
            }
        }else{
            echo json_encode(array('status' => 'error', 'message' => 'Invalid payment mode'));
        }
    }
}
