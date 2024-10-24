<?php
$apiKey = 'dca6dd9e-8cea-4cbe-b473-ffacb32cfd76';
$secretKey = 'srWhot/ddae5Ky1Jw1aFttNg/sQoL47KAe8rtw2Khq4=';
$url = 'https://api-live.kvmpay.com/payouts/OAuth/get-token';

$headers = [
    "X-Api-Key: $apiKey",
    "X-Secret-Key: $secretKey",
];

$curl = curl_init();
curl_setopt_array($curl, [
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => $headers,
    CURLOPT_POST => true, // Make sure you're using POST
]);

$response = curl_exec($curl);
curl_close($curl);

// Check if cURL execution was successful
if ($response === false) {
    echo "cURL Error: " . curl_error($curl);
    exit;
}

// Decode the response and check for errors
$data = json_decode($response, true);

// Debug the response
echo "<pre>";
print_r($data); // Use print_r to see the structure of the response
echo "</pre>";

// Check for JSON decoding errors
if (json_last_error() === JSON_ERROR_NONE && isset($data['Access_token'])) {
    // Successfully retrieved the token
    $token = $data['Access_token'];
    echo "Access Token: " . $token;
    
    // $token = 'your_generated_token';
$url = 'https://api-live.kvmpay.com/payouts/v1/Balance/funding-account';

$headers = [
    "Authorization: Bearer $token"
];

$curl = curl_init();
curl_setopt_array($curl, [
 CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => $headers,
]);

$response = curl_exec($curl);
curl_close($curl);

echo "<pre>";
print_r($response); // Use print_r to see the structure of the response
echo "</pre>";

$balance = json_decode($response, true)['balance'];
echo "Account Balance: $balance";

    
    
} else {
    // Handle the error - log or display the issue
    echo "Error: Unable to retrieve Access token.";
    echo "API Response: " . $response; // Optional: Debug the raw response
}
