<?php 
include("../db.php");

if (isset($_POST['bank_name']) && isset($_POST['ac_holder']) && isset($_POST['account_no']) && isset($_POST['ifsc_code'])) {
    $bank_name = $_POST['bank_name'];
    $ac_holder = $_POST['ac_holder'];
    $account_no = $_POST['account_no'];
    $ifsc_code = $_POST['ifsc_code'];

    $sql = "INSERT INTO manual_deposit (ac_holder,bank_name, ac, ifsc) VALUES ('$ac_holder','$bank_name', '$account_no', '$ifsc_code')";
    if (mysqli_query($con, $sql)) {
        echo json_encode(array('status' => 'success', 'message' => 'Bank added successfully'));
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Error in adding bank'));
    }
}else{
    echo json_encode(array('status' => 'error', 'message' => 'Error in adding bank'));
}
?>