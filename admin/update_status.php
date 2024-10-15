<?php
include("db.php");


if(isset($_POST['update_status'])){
    $id = $_POST['id'];
    $status = $_POST['status'];

    $sql = "UPDATE paymenthistory SET status='$status' WHERE id='$id'";
    $res = mysqli_query($con, $sql);

    if($res){
        echo "<script>alert('Status Updated Successfully')</script>";
        echo "<script>window.location='index.php'</script>";
    }else{
        echo "<script>alert('Failed to Update Status')</script>";
        echo "<script>window.location='index.php'</script>";
    }
}
?>