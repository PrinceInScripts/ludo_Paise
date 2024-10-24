<?php 
include '../db.php';
$user_id = $_SESSION['id'];


   
    $bank_name = $_POST['bank_name'];
    $holder_name = $_POST['bank_holder'];
    $account_no = $_POST['bank_acc'];
    $branch = $_POST['bank_branch'];
    $ifsc = $_POST['bank_ifsc'];
    $upi = $_POST['upi'];

    // check empty fields 
    if (empty($bank_name) || empty($holder_name) || empty($account_no) || empty($branch) || empty($ifsc) || empty($upi)) {
        $response =  array(['success' => false , 'message' => "All fields are required"]);
        echo json_encode($response);
        exit();
    }

    $fetch = "SELECT * FROM bankdetails WHERE userid = '$user_id'";
    $result = mysqli_query($con, $fetch);
    $fetch = mysqli_fetch_assoc($result);

    if (mysqli_num_rows($result) > 0) {
        $sql = "UPDATE bankdetails SET bank_name = '$bank_name', bank_holder = '$holder_name', bank_acc = '$account_no', bank_branch = '$branch', bank_ifsc = '$ifsc', upi = '$upi' WHERE userid = '$user_id'";
    } else {
        $sql = "INSERT INTO bankdetails (userid, bank_name, bank_holder, bank_acc, bank_branch, bank_ifsc, upi) VALUES ('$user_id', '$bank_name', '$holder_name', '$account_no', '$branch', '$ifsc', '$upi')";
    }

    $result = mysqli_query($con, $sql);
    if ($result) {
        $response =  array(['success' => true , 'message' => "Bank details updated successfully"]);
    } else {
        $response =  array(['success' => false , 'message' => "An error occured"]);
    }

    echo json_encode($response);

?>