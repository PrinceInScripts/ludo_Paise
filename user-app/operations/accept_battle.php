<?php 

require_once '../db.php';
$user_id = $_SESSION['id'];

if(isset($_GET['battle_id'])){
    $battle_id = $_GET['battle_id'];
    $sql = "UPDATE games SET isJoined = 1 AND status = 'pending' WHERE id = '$battle_id' AND created_by = '$user_id'";
    $result = mysqli_query($con, $sql);
    if($result){
        if (isset($_SERVER['HTTP_REFERER'])) {
            // Redirect to the referring page
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit(); // Always use exit after a header redirect to stop further script execution
        } else {
            // Fallback: Redirect to a default page if HTTP_REFERER is not set
            header('Location: ../index.php');
            exit();
        }
    }else{
        echo "An error occured";
    }
}

?>