<?php 
include("../db.php");
// switch manual bank account status
if (isset($_POST['status']) && isset($_POST['id'])) {
    $status = $_POST['status'];
    $gid = $_POST['id'];
    $q = "UPDATE manual_deposit SET status = 0";
    mysqli_query($con, $q);
    $sql = "UPDATE manual_deposit SET status = $status WHERE id = $gid";
    if (mysqli_query($con, $sql)) {
        echo json_encode(array('status' => 'success', 'message' => 'Gateway status changed successfully'));
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Error in changing gateway status'));
    }
}else{
    echo json_encode(array('status' => 'error', 'message' => 'Error in changing gateway status'));
}
