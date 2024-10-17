<?php 
// callback url page for payment gateway
if(isset($_GET['txn_id']) && $_GET['status'] == 'success'){
    $txn_id = $_GET['txn_id'];
    $sql = "SELECT * FROM paymenthistory WHERE order_id = '$txn_id' AND status = 0";
    $result = mysqli_query($con, $sql);
    $payment = mysqli_fetch_assoc($result);
    $count = mysqli_num_rows($result);

    if($count > 0){
        $sql = "UPDATE paymenthistory SET status = 1, remark = 'Payment Received' WHERE order_id = '$txn_id'";
        $result = mysqli_query($con, $sql);
        if($result){
            echo "Payment Received";
            exit();
        }else{
            echo "Payment Failed";
            exit();
        }
    }else{
        echo "Invalid Transaction ID";
        exit();
    }
    
}elseif(isset($_GET['txn_id']) && $_GET['status'] == 'failed'){
    $txn_id = $_GET['txn_id'];
    $sql = "SELECT * FROM paymenthistory WHERE order_id = '$txn_id' AND status = 0";
    $result = mysqli_query($con, $sql);
    $payment = mysqli_fetch_assoc($result);
    $count = mysqli_num_rows($result);

    if($count > 0){
        $sql = "UPDATE paymenthistory SET status = 2, remark = 'Payment Failed' WHERE order_id = '$txn_id'";
        $result = mysqli_query($con, $sql);
        if($result){
            echo "Payment Failed";
            exit();
        }else{
            echo "Payment Failed";
            exit();
        }
    }else{
        echo "Invalid Transaction ID";
        exit();
    }
}else{
    echo "Invalid Request";
    exit();
}

?>