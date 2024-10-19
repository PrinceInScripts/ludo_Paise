<?php

include("db.php");

if(isset($_POST['order_id']) && isset($_POST['r_type'])){
    if($_POST['r_type']=='confirm'){
        $order_id = $_POST['order_id'];
        $sql = "UPDATE paymenthistory SET status = 1 WHERE order_id = '$order_id' AND status = 0";
        $result = mysqli_query($con, $sql);
        if($result){
            echo json_encode(array('status'=>'success','type'=>'confirm'));
        }else{
            echo json_encode(array('status'=>'error','type'=>'confirm','message'=>'Error adding penalty: '.mysqli_error($con)));
        }
    } else{
        $order_id = $_POST['order_id'];
        $data_sql="SELECT * FROM paymenthistory WHERE order_id = '$order_id'";
        $data_result = mysqli_query($con, $data_sql);
        $data = mysqli_fetch_assoc($data_result);
        $userid = $data['userid'];
        $amount = $data['amount'];
        mysqli_query($con, "UPDATE users SET withdraw_wallet = withdraw_wallet + '$amount' WHERE id = '$userid'");
        $sql = "UPDATE paymenthistory SET status = 2 WHERE order_id = '$order_id' AND status = 0";
        $result = mysqli_query($con, $sql);

        if($result){
            echo json_encode(array('status'=>'success','type'=>'decline'));
        }else{
            echo json_encode(array('status'=>'error','type'=>'decline','message'=>'Error adding penalty: '.mysqli_error($con)));
        }
    }
}
?>