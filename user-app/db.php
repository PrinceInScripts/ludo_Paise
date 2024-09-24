<?php 
session_start();
$con = mysqli_connect('localhost','root','','matkaplay');
if(!$con){
    echo "Database connection failed...";
}

?>