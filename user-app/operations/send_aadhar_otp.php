<?php

require_once '../db.php';

$user_id = $_SESSION['id'];

if(isset($_POST['aadhar'])){
    
// API URL
$url = "https://api.quickekyc.com/api/v1/aadhaar-v2/generate-otp";
$aadhar = $_POST['aadhar'];
// The data you want to send in the POST request
$postData = [
    'key' => '7b4c50bf-21ae-49f8-850f-f74133a65546',
    'id_number' => $aadhar,
];

// Initialize cURL
$ch = curl_init();

// Set cURL options
curl_setopt($ch, CURLOPT_URL, $url); // API endpoint
curl_setopt($ch, CURLOPT_POST, true); // Use POST method
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData)); // Send form-urlencoded data
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return response instead of printing it

// Execute the request
$response = curl_exec($ch);

// Check for errors
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
} else {
    // Decode and display the response
    $responseData = json_decode($response, true);
    if ($responseData['status'] == 'success') {
        $_SESSION['aadhar_request_id'] = $responseData['request_id'];
        $query = "UPDATE users SET adhaar_id = '$aadhar' WHERE id = '$user_id'";
        $res =  array(['status' => 'success', 'message' => $responseData['message']]);
    } else {
        $res = array(['status' => 'error', 'message' => $responseData['message']]);
    }
}

echo json_encode($res);
// Close cURL
curl_close($ch);
}

?>
