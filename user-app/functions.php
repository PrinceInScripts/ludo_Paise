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

function sendOTP2($number, $otp) {

    $phone = $number; // Concatenate country code with phone number
    $message = $otp;
    
    $data = json_encode([
        "contact" => [
            [
                "number" => $phone,
                "message" => $message
            ]
        ]
    ]);
    
    $ch = curl_init();
    
    curl_setopt($ch, CURLOPT_URL, "https://codedrops.in/api/whatsapp/send");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Api-key: 1",
        "Content-Type: application/json",
    ]);
    
    $response = curl_exec($ch);
    $err = curl_error($ch);
    
    curl_close($ch);
    
    if ($err) {
        // echo "cURL Error #:" . $err;
        return array('status' => false);
    } else {
        return array('status' => true, 'response' => json_decode($response, true));
    }
    }

function generateCode(){
    // alpha numeric 10 digit code
    $code = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10);
    return $code;
}

?>
