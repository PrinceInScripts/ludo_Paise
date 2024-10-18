<?php 
include('../db.php');

// handle the file upload here and save the file to the server and update the reference no in the database 

// Check if the form is submitted
if (isset($_POST['txn_id'])) {
    // Get the uploaded screenshot file
    $ss = $_FILES['ss'];

    $txn_id = $_POST['txn_id'];

    // Check if screenshot is empty
    if ($ss['error'] == 4) {
        // Show error message
        echo 'error';
        return;
    }

    // Check if the file is an image
    $allowed = array('image/jpeg', 'image/png', 'image/gif');
    if (!in_array($ss['type'], $allowed)) {
        // Show error message
        echo 'error';
        return;
    }

    // Check if the file size is less than 2MB
    if ($ss['size'] > 2 * 1024 * 1024) {
        // Show error message
        echo 'error';
        return;
    }

    // Generate a unique filename and create new folder for payment screenshot as txn_id in assets/payment/screenshot
    if (!file_exists('../../assets/payment/screenshot/' . $txn_id)) {
        mkdir('../../assets/payment/screenshot/' . $txn_id, 0777, true);
    }
    $filename = uniqid('ss_') . '.' . pathinfo($ss['name'], PATHINFO_EXTENSION);

    // Move the uploaded file to the uploads directory
    if (move_uploaded_file($ss['tmp_name'], '../../assets/payment/screenshot/' . $txn_id . '/' . $filename)) {
        // Update the reference number in the database
        $ref_no = $_POST['utr'];
        $user_id = $_SESSION['id'];
        $txnRecord = "update paymenthistory set remark = 'Payment Requested', utr = '$ref_no', payment_ss = '$filename' where order_id = '$txn_id'";
        $result = mysqli_query($con, $txnRecord);

        if ($result) {
            // Show success message
            echo 'success';
        } else {
            // Show error message
            echo 'error';
        }
    } else {
        // Show error message
        echo 'error';
    }
}else{
    // Show error message
    echo 'error in submit';
}



?>