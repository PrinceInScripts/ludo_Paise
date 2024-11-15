<?php
include('../db.php');
session_start();

if (!isset($_SESSION['id'])) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['txn_id'])) {
    $txn_id = $_POST['txn_id'];
    $ss = $_FILES['ss'];

    // Check if file is uploaded
    if ($ss['error'] == 4) {
        echo json_encode(['status' => 'error', 'message' => 'No file uploaded']);
        exit;
    }

    // Validate file type
    $allowedTypes = ['image/jpg', 'image/jpeg', 'image/png', 'image/gif'];
    if (!in_array($ss['type'], $allowedTypes)) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid file type']);
        exit;
    }

    // Validate file size
    if ($ss['size'] > 2 * 1024 * 1024) {
        echo json_encode(['status' => 'error', 'message' => 'File size exceeds 2MB']);
        exit;
    }

    // Generate unique filename and ensure directory exists
    $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/assets/payment/screenshot/' . $txn_id . '/';
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    $filename = uniqid('ss_') . '.' . strtolower(pathinfo($ss['name'], PATHINFO_EXTENSION));

    // Move uploaded file
    if (!move_uploaded_file($ss['tmp_name'], $uploadDir . $filename)) {
        error_log("Failed to move file: " . json_encode(error_get_last()));
        echo json_encode(['status' => 'error', 'message' => 'Failed to upload file']);
        exit;
    }

    // Handle database updates
    $txn_sql = "SELECT * FROM paymenthistory WHERE order_id = ?";
    $stmt = $con->prepare($txn_sql);
    $stmt->bind_param("s", $txn_id);
    $stmt->execute();
    $txn = $stmt->get_result()->fetch_assoc();

    if ($txn) {
        $remark = 'Payment Requested';
        if ($txn['type'] === 'usdt') {
            $query = "UPDATE paymenthistory SET remark = ?, payment_ss = ? WHERE order_id = ?";
            $stmt = $con->prepare($query);
            $stmt->bind_param("sss", $remark, $filename, $txn_id);
        } else {
            $ref_no = $_POST['utr'];
            $query = "UPDATE paymenthistory SET remark = ?, utr = ?, payment_ss = ? WHERE order_id = ?";
            $stmt = $con->prepare($query);
            $stmt->bind_param("ssss", $remark, $ref_no, $filename, $txn_id);
        }

        if ($stmt->execute()) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to update database']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Transaction not found']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}
?>
