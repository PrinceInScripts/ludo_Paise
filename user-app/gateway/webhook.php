<?php
// File: webhook.php

// Database connection parameters
include '../db.php';

// Set the response content type to JSON
header("Content-Type: application/json");

// Specify the log file
$logFile = 'webhook_log.txt'; // Path to log file

// Read the raw POST data
$rawPayload = file_get_contents("php://input");

// Decode the URL-encoded payload
$parsedData = [];
parse_str($rawPayload, $parsedData);

// Log the raw payload and parsed data
file_put_contents($logFile, "[" . date('Y-m-d H:i:s') . "] Raw: " . $rawPayload . PHP_EOL, FILE_APPEND);
file_put_contents($logFile, "[" . date('Y-m-d H:i:s') . "] Parsed: " . json_encode($parsedData, JSON_PRETTY_PRINT) . PHP_EOL, FILE_APPEND);

// Validate that the required fields are present
if (!isset($parsedData['order_id'], $parsedData['status'], $parsedData['amount'])) {
    http_response_code(400);
    echo json_encode(["error" => "Missing required fields"]);
    exit;
}

// fetch the order from the database using the order_id
$order_id = $parsedData['order_id'];
$sql = "SELECT * FROM paymenthistory WHERE order_id = '$order_id'";
$result = mysqli_query($con, $sql);
$order = mysqli_fetch_assoc($result);

$user_id = $order['userid'];
$amount = $order['amount'];
$status = $order['status'];
$utr = $parsedData['utr'];

if($status == 1 || $status == 2){
    http_response_code(400);
    echo json_encode(["error" => "Order already processed"]);
    exit;
}elseif($status == 0 && $parsedData['status'] == 'SUCCESS' && $parsedData['amount'] == $amount){
    // Update the order status in the database
    $sql = "UPDATE paymenthistory SET status = 1,utr = '$utr' WHERE order_id = '$order_id'";
    $result = mysqli_query($con, $sql);

    // update user balance in the database

    $sql = "UPDATE users SET deposit_wallet = deposit_wallet + '$amount' WHERE id = '$user_id'";
    $result = mysqli_query($con, $sql);

    // Return success response
    echo json_encode(["status" => "success", "message" => "Order processed successfully"]);
}else{
    // Return error response
    echo json_encode(["status" => "error", "message" => "Order processing failed"]);
}
