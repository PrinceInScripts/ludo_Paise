<?php 

require_once '../db.php';
$user_id = $_SESSION['id'];

if(isset($_GET['battle_id'])){
    $battle_id = $_GET['battle_id'];
    $sql = "UPDATE games SET isJoined = 1 AND status = 'pending' WHERE id = '$battle_id' AND created_by = '$user_id'";
    $result = mysqli_query($con, $sql);
    if($result){
       
            // Fallback: Redirect to a default page if HTTP_REFERER is not set
            header('Location: ../newbattle.php');
            exit();
     
    }else{
        echo "An error occured";
    }
}

?>