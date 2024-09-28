<?php 

function sendOTP($number, $otp) {
    // The URL for the API endpoint
    $url = 'https://www.fast2sms.com/dev/bulkV2';

    // The data to send in the POST request
    $postData = [
        'sender_id' => 'FSTSMS',
        'message' => 'This is your OTP: ' . $otp,
        'language' => 'english',
        'route' => 'p',
        'numbers' => $number,
        'flash' => 0
    ];

    // The headers for the request
    $headers = [
        'authorization: fyR0msa8K7tNjIgJu2bzF45Shv6cPl3opkGqOi1wxQUBdXVDnLrJIyE2RpN6lfd9DwQzLZvBTqHh5OVu',
        'Content-Type: application/json'
    ];

    // Initialize cURL session
    $ch = curl_init();

    // Set cURL options
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData)); // Set the POST fields as JSON
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); // Set the headers

    // Execute the cURL request and get the response
    $response = curl_exec($ch);

    // Check for cURL errors
    if (curl_errno($ch)) {
        // Return false status if there was a cURL error
        return array('status' => false, 'error' => curl_error($ch));
    }

    // Close the cURL session
    curl_close($ch);

    // Convert the response body into an associative array
    $responseBody = json_decode($response, true);

    if ($responseBody === null) {
        // Return false status if no response body is found or there's a JSON error
        return array('status' => false);
    } else {
        // Return success status and the parsed response
        return array('status' => true, 'response' => $responseBody);
    }
}

?>
