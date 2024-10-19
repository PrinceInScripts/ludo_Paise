<?php

include("db.php");

if(isset($_POST['txnid']) && isset($_POST['r_type'])){
    if($_POST['r_type']=='confirm'){
        $txnid = $_POST['txnid'];
        $sql = "UPDATE withdrawrecord SET status = 1 WHERE txnid = '$txnid' AND status = 0";
        $result = mysqli_query($con, $sql);
        if($result){
            echo json_encode(array('status'=>'success','type'=>'confirm'));
        }else{
            echo json_encode(array('status'=>'error','type'=>'confirm','message'=>'Error adding penalty: '.mysqli_error($con)));
        }
    } else{
        $txnid = $_POST['txnid'];
        $data_sql="SELECT * FROM withdrawrecord WHERE txnid = '$txnid'";
        $data_result = mysqli_query($con, $data_sql);
        $data = mysqli_fetch_assoc($data_result);
        $userid = $data['userid'];
        $amount = $data['amount'];
        mysqli_query($con, "UPDATE users SET withdraw_wallet = withdraw_wallet + '$amount' WHERE id = '$userid'");
        $txt = "Amount Refunded + ".$amount;
        $sql = "UPDATE withdrawrecord SET status = 2, remark = '$txt' WHERE txnid = '$txnid' AND status = 0";
        $result = mysqli_query($con, $sql);

        if($result){
            echo json_encode(array('status'=>'success','type'=>'decline'));
        }else{
            echo json_encode(array('status'=>'error','type'=>'decline','message'=>'Error adding penalty: '.mysqli_error($con)));
        }
    }
}
?>