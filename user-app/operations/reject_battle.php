<?php 

require_once '../db.php';
$user_id = $_SESSION['id'];

if(isset($_GET['battle_id'])){
    $battle_id = $_GET['battle_id'];
    $sql = "UPDATE games SET accepted_by = null WHERE id = '$battle_id' AND created_by = '$user_id'";
    $result = mysqli_query($con, $sql);
    if($result){
       
        header('Location: ../newbattle.php');
            exit();
       
    }else{
        echo "An error occured";
    }
}

?>