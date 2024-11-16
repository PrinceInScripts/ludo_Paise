<?php

require_once '../db.php';
$user_id = $_SESSION['id'];

// Fetch existing user data
$query = "SELECT * FROM users WHERE id = '$user_id'";
$result = mysqli_query($con, $query);
$user = mysqli_fetch_assoc($result);

$userWithdrawCount = $user['withdraw_count'];

$wallet = $user['withdraw_wallet'];

$setting = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM settings WHERE id = 1"));

$minWithdraw = $setting['minWithdraw'];

// fetch bank details from bankdetails table 

$bankdetails = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM bankdetails WHERE userid = '$user_id'"));

if(!$bankdetails){
    echo json_encode(array('status' => 'error', 'message' => 'Please add bank details first','url'=>'bank'));
    exit();
}elseif($bankdetails['upi'] == ''){
    echo json_encode(array('status' => 'error', 'message' => 'Please add UPI first','url'=>'bank'));
    exit();
}elseif($bankdetails['bank_acc'] == ''){
    echo json_encode(array('status' => 'error', 'message' => 'Please add account number first','url'=>'bank'));
    exit();
}elseif($bankdetails['bank_ifsc'] == ''){
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
        echo json_encode(array('status' => 'error', 'message' => 'Insufficient balance', 'url' => 'payment'));
    } else if ($amount < $minWithdraw) {
        echo json_encode(array('status' => 'error', 'message' => 'Minimum withdraw amount is ' . $minWithdraw . ' INR', 'url' => 'withdraw'));
    } else {

        $setting = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM settings WHERE id = 1"));
        $withdraw_status = $setting['withdraw_status'];

        if ($withdraw_status == 'off') {
            echo json_encode(array('status' => 'error', 'message' => 'Withdrawal is disabled by admin', 'url' => 'withdraw'));
            exit();
        }

        sleep(1);

        

        if ($payment_mode == 'upi') {
            $newWallet = $wallet - $amount;
            $sql = "UPDATE users SET withdraw_wallet = '$newWallet' WHERE id = '$user_id'";
            $result = mysqli_query($con, $sql);
            //insert that amount in amount table for taking all amount insert data
            $sql1 = "INSERT INTO amount (amount, user_id) VALUES ('$amount', '$user_id')";
            $insertAmount = mysqli_query($con, $sql1);


            $txn_id = uniqid('txn_');
            $payment_info = array('is_upi' => true, 'is_bank' => false, 'upi' => $bankdetails['upi'], 'bank' => ["ac" => null, "ifsc" => null]);
            $payment_info = json_encode($payment_info);
            if($userWithdrawCount >= $setting['withdraw_count']){
                // 1% fee will be deducted from the amount 
                $fee = $amount * 0.01;
                $amount = $amount - $fee;

            }else{
                $fee = 0;

            }
            $sql = "INSERT INTO withdrawrecord (userid, amount,fee, type, txnid, payment_info , status, remark) VALUES ('$user_id', '$amount','$fee', 'upi', '$txn_id', '$payment_info', 0, 'Convinence fee : ₹ $fee')";
            $result = mysqli_query($con, $sql);

            // update user withdraw_count 
            $sql = "UPDATE users SET withdraw_count = withdraw_count + 1 WHERE id = '$user_id'";
            $result = mysqli_query($con, $sql);
            if ($result) {
                
                echo json_encode(array('status' => 'success', 'message' => 'Withdraw request submitted successfully','url'=>'history'));
            } else {
                echo json_encode(array('status' => 'error', 'message' => 'An error occurred', 'url' => 'withdraw'));
            }
        } else if ($payment_mode == 'bankcard') {
            $newWallet = $wallet - $amount;
            $sql = "UPDATE users SET withdraw_wallet = '$newWallet' WHERE id = '$user_id'";
            $result = mysqli_query($con, $sql);
            //insert that amount in amount table for taking all amount insert data
            // $sql1 = "INSERT INTO amount (amount, user_id) VALUES ('$amount', '$user_id')";
            // $insertAmount = mysqli_query($con, $sql1);
            
            $txn_id = uniqid('txn_');
            // {"is_upi":false,"is_bank":false,"upi":null,"bank" : {"ac":5463573,"ifsc":null}} 
            $payment_info = array('is_upi' => false, 'is_bank' => true,'upi' =>null, 'bank' => array('ac' => $bankdetails['bank_acc'], 'ifsc' => $bankdetails['bank_ifsc']));
            $payment_info = json_encode($payment_info);

            if($userWithdrawCount >= $setting['withdraw_count']){
                // 1% fee will be deducted from the amount 
                $fee = $amount * 0.01;
                $amount = $amount - $fee;

            }else{
                $fee = 0;

            }

            $sql = "INSERT INTO withdrawrecord (userid, amount,fee, type, txnid, payment_info, status, remark) VALUES ('$user_id', '$amount','$fee', 'bank', '$txn_id', '$payment_info' , 0, 'Convinence fee : ₹ $fee ')";
            $result = mysqli_query($con, $sql);

            // update user withdraw_count
            $sql = "UPDATE users SET withdraw_count = withdraw_count + 1 WHERE id = '$user_id'";
            $result = mysqli_query($con, $sql);

            if ($result) {
                
                echo json_encode(array('status' => 'success', 'message' => 'Withdraw request submitted successfully','url'=>'history'));
            } else {
                echo json_encode(array('status' => 'error', 'message' => 'An error occurred', 'url' => 'withdraw'));
            }
        }else{
            echo json_encode(array('status' => 'error', 'message' => 'Invalid payment mode', 'url' => 'withdraw'));
        }
    }
}
