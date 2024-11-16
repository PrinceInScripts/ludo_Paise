<?php 
include ('db.php');

function generateBonusTransactionId() {
    $prefix = "bsn_"; // Prefix for the transaction ID
    $randomPart = bin2hex(random_bytes(6)); // Generate 12 random hexadecimal characters
    return $prefix . $randomPart;
}
function generatePenaltyTransactionId() {
    $prefix = "ply_"; // Prefix for the transaction ID
    $randomPart = bin2hex(random_bytes(6)); // Generate 12 random hexadecimal characters
    return $prefix . $randomPart;
}



// admin role_id 
$adminid = $_SESSION['role_id'];
if (isset($_POST['action'])) {
    $id = mysqli_real_escape_string($con, $_POST['id']);
    $user_sql = "SELECT * FROM users WHERE id='$id'";
    $user_run = mysqli_query($con, $user_sql);
    $user = mysqli_fetch_assoc($user_run);
    
    // Check which action to perform (bonus or penalty)
    if ($_POST['action'] == 'bonus') {
        $bonus = mysqli_real_escape_string($con, $_POST['bonus_amount']);
        $remark = mysqli_real_escape_string($con, $_POST['bonus_remark']);
        $wallet = $user['deposit_wallet'] + $bonus;
        $sql = "UPDATE users SET deposit_wallet='$wallet' WHERE id='$id'";
        mysqli_query($con, $sql);
        //insert that amount in amount table for taking all amount insert data in amount table
        $sql1 = "INSERT INTO amount (amount, user_id,type) VALUES ('$bonus', '$id','credited')";
        $insertAmount = mysqli_query($con, $sql1);


        //check remark if it's empty then add default remark message
        if (empty($remark)) {
            $remark = 'Bonus added by admin';
        }
        $order_id = generateBonusTransactionId();

        // add bonus table 
        $bonus_sql = "INSERT INTO paymenthistory (userid,order_id, amount,type, upi, remark,status) VALUES ('$id','$order_id', '$bonus','bonus', '$adminid', '$remark','1')";
        $ch = mysqli_query($con, $bonus_sql);
        header("Location:viewUser.php?id=$id");
        exit;
    }
    
    if ($_POST['action'] == 'penalty') {
        $penalty = mysqli_real_escape_string($con, $_POST['penalty_amount']);
        $remark = mysqli_real_escape_string($con, $_POST['penalty_remark']);

        $wallet = $user['deposit_wallet'] - $penalty;
        $sql = "UPDATE users SET deposit_wallet='$wallet' WHERE id='$id'";
        mysqli_query($con, $sql);
        //insert that amount in amount table for taking all amount insert data in amount table
        $sql1 = "INSERT INTO amount (amount, user_id,type) VALUES ('$penalty', '$id','debited')";
        $insertAmount = mysqli_query($con, $sql1);

        //check remark if it's empty then add default remark message
        if (empty($remark)) {
            $remark = 'Penalty added by admin';
        }
        $order_id = generatePenaltyTransactionId();

        // add penalty table
        $penalty_sql = "INSERT INTO paymenthistory (userid,order_id, amount,type, upi, remark,status) VALUES ('$id','$order_id', '$penalty','penalty', '$adminid', '$remark','2')";
        $ch = mysqli_query($con, $penalty_sql);

        header("Location:viewUser.php?id=$id");
        exit;
    }
}

?>