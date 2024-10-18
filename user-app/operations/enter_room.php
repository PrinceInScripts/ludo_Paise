<?php 

require_once '../db.php';
$user_id = $_SESSION['id'];

if(isset($_POST['submit']) && isset($_POST['roomcode']) && isset($_POST['battle_id'])){
    $battle_id = $_POST['battle_id'];
    $roomcode = $_POST['roomcode'];

    //check roomcode is less then 8 characters

    if(strlen($roomcode) != 8){
        header('Location: ../room?battle='.$battle_id.'&error=Roomcode error');
        exit();
    } 
    

    // Insert Roomcode to games table 

    $sql = "UPDATE games SET roomcode = '$roomcode' WHERE id = '$battle_id' AND created_by = '$user_id'";
    $result = mysqli_query($con, $sql);
    if($result){
        
            // Fallback: Redirect to a default page if HTTP_REFERER is not set
            header('Location: ../room?battle='.$battle_id);
            exit();
       
    }else{
        echo "An error occured";
    }
}else{
    echo "Battle not found";


    
    
}

?>