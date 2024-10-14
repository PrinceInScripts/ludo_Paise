<?php 

include('db.php');

if(isset($_POST['mobile']) && isset($_POST['amount']) && isset($_POST['id'])){
    $mobile = $_POST['mobile'];
    $amount = $_POST['amount'];
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

        

        $sql = "INSERT INTO penalties (user_id, amount, admin_id, battle_id) VALUES ('$user_id', '$amount',0, '$id')";
        $result = mysqli_query($con, $sql);
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