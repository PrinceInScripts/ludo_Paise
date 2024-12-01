<?php 
include '../db.php';
date_default_timezone_set('Asia/Kolkata');

$user_id = $_SESSION['id'];

$game_id = $_GET['battle_id'];

$sql = "SELECT * FROM games WHERE id = '$game_id' AND accepted_by = '$user_id' AND status = 'pending'";
$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result) > 0) {
    $time = date('Y-m-d H:i:s');
    $sql = "UPDATE games SET accepted_by = null, created_at = '$time' WHERE id = '$game_id' AND accepted_by = '$user_id' AND status = 'pending'";
    if (mysqli_query($con, $sql)) {
        header('Location: ../newbattle.php');
        exit();
    } else {
        echo "Error: " . mysqli_error($con);
    }
} else {
    // echo "You are not authorized to cancel this battle";
    header('Location: ../newbattle.php');
        exit();
}
header('Location: ../newbattle.php');
        exit();
?>