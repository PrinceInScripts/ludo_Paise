<?php
// File: webhook.php

// Set the response content type to JSON
header("Content-Type: application/json");

// Specify the log file
$logFile = 'webhook_log.txt'; // Path to log file

// Read the raw POST data
$rawPayload = file_get_contents("php://input");

// Append the raw payload to the log file with a timestamp
file_put_contents($logFile, "[" . date('Y-m-d H:i:s') . "] " . $rawPayload . PHP_EOL, FILE_APPEND);

// Respond to the webhook request
http_response_code(200);
echo json_encode(["message" => "Webhook data received successfully"]);
