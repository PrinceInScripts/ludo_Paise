<?php 

include('db.php');

function generatePenaltyTransactionId() {
    $prefix = "ply_"; // Prefix for the transaction ID
    $randomPart = bin2hex(random_bytes(6)); // Generate 12 random hexadecimal characters
    return $prefix . $randomPart;
}

if(isset($_POST['mobile']) && isset($_POST['amount']) && isset($_POST['id'])){
    $mobile = $_POST['mobile'];
    $amount = $_POST['amount'];
    $remark = $_POST['remark'];
    $id = $_POST['id'];
    $sql = "SELECT * FROM users WHERE mobile = '$mobile'";
    $result = mysqli_query($con, $sql);
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        $user_id = $row['id'];
        $deposit_wallet = $row['deposit_wallet'];
        $withdraw_wallet = $row['withdraw_wallet'];

        // deduct from deposit wallet but if deposit balance has been exhausted, deduct from withdraw wallet instead 

        if($deposit_wallet >= $amount){
            $deposit_wallet -= $amount;
        } else {
            $withdraw_wallet -= $amount;
        }

       $order_id = generatePenaltyTransactionId();
       $penalty_sql = "INSERT INTO paymenthistory (userid,order_id, amount,type, upi, remark,status,utr) VALUES ('$user_id','$order_id', '$amount','penalty', '$adminid', '$remark','2','$id')";


        $result = mysqli_query($con, $penalty_sql);
        if($result){
            echo json_encode(array('status' => 'success'));
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'Error adding penalty: ' . mysqli_error($con)));
        }
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'User not found'));
    }
}
?>