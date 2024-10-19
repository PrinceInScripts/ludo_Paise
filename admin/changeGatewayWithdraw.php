<?php 
include('db.php');

if(isset($_POST['action']) && $_POST['action'] == 'SwitchGateway'){
    $status = $_POST['status'];
    $gid = $_POST['gid'];
    $sql = "UPDATE `withdraw_modes` SET `status` = '$status' WHERE `id` = '$gid'";
    $query = mysqli_query($con, $sql);
    if($query){
        echo "Gateway status has been changed successfully!";
    }else{
        echo "Failed to change gateway status!";
    }
}
?>