<?php
include ("db.php");

if(isset($_GET['id'])){
  $id=$_GET['id'];
  $update_sql="UPDATE users SET role='admin' WHERE id='$id'";
  $res=mysqli_query($con,$update_sql);
    header("location:addAdmin.php");
 
}



?>