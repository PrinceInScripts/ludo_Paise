<?php 

include("db.php");
// logout code destroy cookie and session
setcookie('login_token', '', time() - 3600);
session_destroy();

echo 1;

?>