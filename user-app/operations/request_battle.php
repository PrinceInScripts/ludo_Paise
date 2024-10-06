<?php 

require_once '../db.php';
$user_id = $_SESSION['id'];

if(isset($_GET['battle_id'])){
    $battle_id = $_GET['battle_id'];

    // first check battle exits or not, if exist set $user_id to accepted_by field 
    $sql = "SELECT * FROM games WHERE id = '$battle_id' AND status = 'pending'";
    $result = mysqli_query($con, $sql);
    $fetch = mysqli_fetch_assoc($result);
    $created_by = $fetch['created_by'];
    if(mysqli_num_rows($result) > 0 && $created_by != $user_id){
        $sql = "UPDATE games SET accepted_by = '$user_id' WHERE id = '$battle_id'";
        $result = mysqli_query($con, $sql);
        if($result){
            
            header('Location: ../newbattle.php');
                exit();
            
        }else{
            echo "An error occured";
        }
    }else{
        echo "Battle not found";
    }

    
}

?>