<?php
require_once '../db.php';
$user_id = $_SESSION['id'];



// upload screenshot here 

if (isset($_FILES['file']) && isset($_POST['battle_id'])) {
    $battle_id = $_POST['battle_id'];

    $fetch = "SELECT * FROM games WHERE id = '$battle_id' AND created_by = '$user_id' OR accepted_by = '$user_id'";
    $result = mysqli_query($con, $fetch);
    $fetch = mysqli_fetch_assoc($result);

    if (mysqli_num_rows($result) > 0) {

 
        $file = $_FILES['file'];
        $filename = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];
        $fileType = $file['type'];
        $fileExt = explode('.', $filename);
        $fileActualExt = strtolower(end($fileExt));
        $allowed = array('jpg', 'jpeg', 'png', 'pdf');
        if (in_array($fileActualExt, $allowed)) {
            if ($fileError === 0) {
                if ($fileSize < 100000) {
                    $fileNameNew = uniqid('', true) . "." . $fileActualExt;
                    $fileDestination = '../../assets/games/';
                    // make directory as battle_id 
                    if (!file_exists($fileDestination . $battle_id)) {
                        mkdir($fileDestination . $battle_id, 0777, true);
                    }
                    $fileDestination = $fileDestination . $battle_id . "/" . $fileNameNew;
                    move_uploaded_file($fileTmpName, $fileDestination);


                    if($fetch['created_by'] == $user_id){
                        $sql = "UPDATE games SET creator_ss = '$fileNameNew' WHERE id = '$battle_id' AND created_by = '$user_id'";
                    }else{
                        $sql = "UPDATE games SET acceptor_ss = '$fileNameNew' WHERE id = '$battle_id' AND accepted_by = '$user_id'";
                    }


                    $result = mysqli_query($con, $sql);
                    if ($result) {
                        $response =  array(['error' => false , 'message' => "Screenshot uploaded successfully"]);
                    } else {
                        $response =  array(['error' => true , 'message' => "An error occured"]);
                    }
                } else {
                    $response =  array(['error' => true , 'message' => "Your file is too big!"]);
                }
            } else {
                $response =  array(['error' => true , 'message' => "There was an error uploading your file!"]);
            }
        } else {
            $response =  array(['error' => true , 'message' => "You cannot upload files of this type!"]);
        }
    } else {
        $response =  array(['error' => true , 'message' => "Battle not found"]);
    }
} else {
    $response =  array(['error' => true , 'message' => "Battle not found"]);
   
}


echo json_encode($response);
exit;
