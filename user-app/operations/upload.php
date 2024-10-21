<?php
require_once '../db.php';

// Check if user is logged in
if (!isset($_SESSION['id'])) {
    echo json_encode([['error' => true, 'message' => "Unauthorized access."]]);
    exit;
}

$user_id = $_SESSION['id'];

if (isset($_FILES['file']) && isset($_POST['battle_id']) && isset($_POST['screenshotType'])) {

    $ssType = $_POST['screenshotType'];
    if ($ssType == 'won') {
        $battle_id = mysqli_real_escape_string($con, $_POST['battle_id']);

        // Prepare SQL to prevent SQL injection
        $query = "SELECT * FROM games WHERE id = ? AND (created_by = ? OR accepted_by = ?)";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, 'iii', $battle_id, $user_id, $user_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        // fetch battle details 

        $fetch = mysqli_fetch_assoc($result);

        $creator = $fetch['created_by'];
        $acceptor = $fetch['accepted_by'];

        if($user_id == $creator){
            // check if cretor_join_ss uploaded proof ss or not 
            if($fetch['creator_join_ss'] == null){
                echo json_encode([['error' => true, 'message' => "Please upload Game Join screenshot first."]]);
                exit;
            }

        }elseif($user_id == $acceptor){
            // check if acceptor_join_ss uploaded proof ss or not 
            if($fetch['acceptor_join_ss'] == null){
                echo json_encode([['error' => true, 'message' => "Please upload Game Join screenshot first."]]);
                exit;
            }
        }

        

       
        

        if (mysqli_num_rows($result) > 0) {
            $file = $_FILES['file'];
            $filename = basename($file['name']);
            $fileTmpName = $file['tmp_name'];
            $fileSize = $file['size'];
            $fileError = $file['error'];
            $fileType = mime_content_type($fileTmpName); // More secure than just checking file extension
            $allowedTypes = ['image/jpeg', 'image/png', 'application/pdf'];

            // Check if file type is allowed
            if (in_array($fileType, $allowedTypes)) {
                if ($fileError === 0) {
                    // Check if the file size is within the allowed limit (2MB)
                    if ($fileSize < 2000000) { // 2MB limit
                        // Generate a unique file name
                        $fileExt = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
                        $fileNameNew = bin2hex(random_bytes(16)) . "." . $fileExt;

                        // Set file destination
                        $fileDestination = "../../assets/games/{$battle_id}/";

                        // Create directory if it doesn't exist
                        if (!file_exists($fileDestination)) {
                            mkdir($fileDestination, 0777, true);
                        }

                        // Complete file path
                        $fileDestination .= $fileNameNew;

                        // Move the uploaded file to the server
                        if (move_uploaded_file($fileTmpName, $fileDestination)) {

                          

                            // Prepare SQL for updating screenshot
                            if ($fetch['created_by'] == $user_id) {
                                if($fetch['acceptor_ss'] != null ){
                                    $conflict = "UPDATE games SET status = 'conflict' WHERE id = ? AND created_by = ?";
                                    $stmt = mysqli_prepare($con, $conflict);
                                    mysqli_stmt_bind_param($stmt, 'ii', $battle_id, $user_id);
                                    mysqli_stmt_execute($stmt);

                                }
                                $sql = "UPDATE games SET creator_ss = ? WHERE id = ? AND created_by = ?";
                            } else {
                                if($fetch['creator_ss'] != null ){
                                    $conflict = "UPDATE games SET status = 'conflict' WHERE id = ? AND accepted_by = ?";
                                    $stmt = mysqli_prepare($con, $conflict);
                                    mysqli_stmt_bind_param($stmt, 'ii', $battle_id, $user_id);
                                    mysqli_stmt_execute($stmt);

                                }
                                $sql = "UPDATE games SET acceptor_ss = ? WHERE id = ? AND accepted_by = ?";
                            }

                            $stmt = mysqli_prepare($con, $sql);
                            mysqli_stmt_bind_param($stmt, 'sii', $fileNameNew, $battle_id, $user_id);
                            mysqli_stmt_execute($stmt);

                            if (mysqli_stmt_affected_rows($stmt) > 0) {
                                // Successfully uploaded and updated database
                                echo json_encode([['error' => false, 'message' => "Screenshot uploaded successfully"]]);
                            } else {
                                // Database update failed
                                echo json_encode([['error' => true, 'message' => "Failed to update database."]]);
                            }
                        } else {
                            // Failed to move the uploaded file
                            echo json_encode([['error' => true, 'message' => "Failed to upload file."]]);
                        }
                    } else {
                        // File size too large
                        echo json_encode([['error' => true, 'message' => "File is too large. Maximum size is 2MB."]]);
                    }
                } else {
                    // File error occurred during upload
                    echo json_encode([['error' => true, 'message' => "Error uploading file."]]);
                }
            } else {
                // Invalid file type
                echo json_encode([['error' => true, 'message' => "Invalid file type. Only JPG, PNG, and PDF files are allowed."]]);
            }
        } else {
            // Battle not found or user not authorized
            echo json_encode([['error' => true, 'message' => "Battle not found or unauthorized access."]]);
        }
    
    
    } elseif ($ssType == 'proof') {
        $battle_id = mysqli_real_escape_string($con, $_POST['battle_id']);

        // Prepare SQL to prevent SQL injection
        $query = "SELECT * FROM games WHERE id = ? AND (created_by = ? OR accepted_by = ?)";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, 'iii', $battle_id, $user_id, $user_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            $file = $_FILES['file'];
            $filename = basename($file['name']);
            $fileTmpName = $file['tmp_name'];
            $fileSize = $file['size'];
            $fileError = $file['error'];
            $fileType = mime_content_type($fileTmpName); // More secure than just checking file extension
            $allowedTypes = ['image/jpeg', 'image/png', 'application/pdf'];

            // Check if file type is allowed
            if (in_array($fileType, $allowedTypes)) {
                if ($fileError === 0) {
                    // Check if the file size is within the allowed limit (2MB)
                    if ($fileSize < 2000000) { // 2MB limit
                        // Generate a unique file name
                        $fileExt = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
                        $fileNameNew = bin2hex(random_bytes(16)) . "." . $fileExt;

                        // Set file destination
                        $fileDestination = "../../assets/games/{$battle_id}/";

                        // Create directory if it doesn't exist
                        if (!file_exists($fileDestination)) {
                            mkdir($fileDestination, 0777, true);
                        }

                        // Complete file path
                        $fileDestination .= $fileNameNew;

                        // Move the uploaded file to the server
                        if (move_uploaded_file($fileTmpName, $fileDestination)) {

                            // Fetch battle details to determine who is uploading the screenshot
                            $fetch = mysqli_fetch_assoc($result);

                            // Prepare SQL for updating screenshot
                            if ($fetch['created_by'] == $user_id) {
                                $sql = "UPDATE games SET creator_join_ss = ? WHERE id = ? AND created_by = ?";
                            } else {
                                $sql = "UPDATE games SET acceptor_join_ss = ? WHERE id = ? AND accepted_by = ?";
                            }

                            $stmt = mysqli_prepare($con, $sql);
                            mysqli_stmt_bind_param($stmt, 'sii', $fileNameNew, $battle_id, $user_id);
                            mysqli_stmt_execute($stmt);

                            if (mysqli_stmt_affected_rows($stmt) > 0) {
                                // Successfully uploaded and updated database
                                echo json_encode([['error' => false, 'message' => "Screenshot uploaded successfully"]]);
                            } else {
                                // Database update failed
                                echo json_encode([['error' => true, 'message' => "Failed to update database."]]);
                            }
                        } else {
                            // Failed to move the uploaded file
                            echo json_encode([['error' => true, 'message' => "Failed to upload file."]]);
                        }
                    } else {
                        // File size too large
                        echo json_encode([['error' => true, 'message' => "File is too large. Maximum size is 2MB."]]);
                    }
                } else {
                    // File error occurred during upload
                    echo json_encode([['error' => true, 'message' => "Error uploading file."]]);
                }
            } else {
                // Invalid file type
                echo json_encode([['error' => true, 'message' => "Invalid file type. Only JPG, PNG, and PDF files are allowed."]]);
            }
        } else {
            // Battle not found or user not authorized
            echo json_encode([['error' => true, 'message' => "Battle not found or unauthorized access."]]);
        }




    } else {
    }
} else {
    // Missing file or battle ID
    echo json_encode([['error' => true, 'message' => "Missing file or battle ID."]]);
}

exit;
