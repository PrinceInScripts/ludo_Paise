<?php 
session_start();
$con = mysqli_connect('localhost','root','','ludopaisa');
if(!$con){
    echo "Database connection failed...";
}

$maintain = "SELECT * FROM settings WHERE id = 1";
$maintain_result = mysqli_query($con,$maintain);
$maintain_row = mysqli_fetch_assoc($maintain_result);
$maintain_status = $maintain_row['maintain'];
if($maintain_status == 'on'){
    header('location:maintain.php');
}

?>