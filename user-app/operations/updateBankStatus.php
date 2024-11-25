<?php 
include("../db.php");

if(isset($_POST['txn_id']) && isset($_POST['utr']) ){
    $txn_id = $_POST['txn_id'];
    $utr = $_POST['utr'];
    $sql = "UPDATE paymenthistory SET utr = '$utr', remark = 'UTR Submitted by Player' WHERE order_id = '$txn_id'";
    if (mysqli_query($con, $sql)) {
        echo json_encode(array('status' => 'success', 'message' => 'Payment status updated successfully'));
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Error in updating payment status'));
    }
}else{
    echo json_encode(array('status' => 'error', 'message' => 'Error in updating payment status'));
}
?>