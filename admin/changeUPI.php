<?php 
include('db.php');

if(isset($_POST['action']) && $_POST['action'] == 'changeUPI'){
    $upi = $_POST['upi_id'];
    $sql = "UPDATE `manualupi` SET `upi` = '$upi' WHERE `id` = '1'";
    $query = mysqli_query($con, $sql);
    if($query){
        echo "UPI has been updated successfully!";
    }else{
        echo "Failed to update UPI!";
    }
}
?>