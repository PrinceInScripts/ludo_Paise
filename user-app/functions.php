<?php 

require '../vendor/autoload.php';  // Include Guzzle

use GuzzleHttp\Client;

function sendOTP($number, $otp) {
    $client = new Client();
    $response = $client->post('https://www.fast2sms.com/dev/bulkV2', [
        'json' => [
            'sender_id' => 'FSTSMS',
            'message' => 'This is your OTP: ' . $otp,
            'language' => 'english',
            'route' => 'p',
            'numbers' => $number,
            'flash' => 0
        ],
        'headers' => [
            'authorization' => 'fyR0msa8K7tNjIgJu2bzF45Shv6cPl3opkGqOi1wxQUBdXVDnLrJIyE2RpN6lfd9DwQzLZvBTqHh5OVu',
            'Content-Type' => 'application/json',
        ]
    ]);

    // Convert the response body into an associative array
    $responseBody = json_decode($response->getBody(), true);

    if ($responseBody === null) {
        // Return false status if no response body is found or there's a JSON error
        return array('status' => false);
    } else {
        // Return success status and the parsed response
        return array('status' => true, 'response' => $responseBody);
    }
}


?>