<?php
require_once '../db.php';
$user_id = $_SESSION['id'];

if (isset($_FILES['file'])) {

    $battle_id = mysqli_real_escape_string($con, $_POST['battle_id']);
    
    $file_name = $_FILES['file']['name'];
    $file_tmp = $_FILES['file']['tmp_name'];
    $file_error = $_FILES['file']['error'];
    
    if ($file_error === 0) {

        $base_dir = dirname(__DIR__); 
        $base_dir.='/';
      echo $base_dir;



exit();

        
     


    } else {
        echo "Error during file upload.";
    }
} else {
    echo "No file uploaded.";
}
?>
