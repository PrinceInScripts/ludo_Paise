<?php 
session_start();
$con = mysqli_connect('localhost','root','','ludopaisa');
if(!$con){
    echo "Database connection failed...";
}

?>