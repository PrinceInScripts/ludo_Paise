<?php
require_once '../db.php';
$user_id = $_SESSION['id'];

// Fetch existing user data
$query = "SELECT username, email, mobile FROM users WHERE id = '$user_id'";
$result = mysqli_query($con, $query);
$user = mysqli_fetch_assoc($result);
$username = $user['username'];
$email = $user['email'];


if(isset($_POST['username']) && isset($_POST['email'])){
    echo $_POST['username'];
    $username = $_POST['username'];
    $email = $_POST['email'];

    $sql = "UPDATE users SET username = '$username', email = '$email' WHERE id = '$user_id'";
    $result = mysqli_query($con, $sql);
    
    if($result){
        header('Location: ../profile.php');
        exit();
    } else {
        echo "An error occurred.";
    }
}
?>