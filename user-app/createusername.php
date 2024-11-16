<?php 
include('db.php');

// generate 8 digit alphanumeric code for username

function generateCode(){
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $code = '';
    for ($i = 0; $i < 8; $i++) {
        $code .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $code;
}

$sql = "SELECT * FROM users WHERE username is null";
$result = mysqli_query($con, $sql);
if (mysqli_num_rows($result) > 0) {
    $usernames = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $code = generateCode();
        $usernames[] = $code;
        $id = $row['id'];
        $sql = "UPDATE users SET username = '$code' WHERE id = '$id'";
        if (!mysqli_query($con, $sql)) {
            error_log("Failed to update username: " . mysqli_error($con)); // Log error
        }
    }
}




?>