<?php
// Define the API URL
$url = "https://backend.aisensy.com/campaign/t1/api/v2";

// Define the JSON payload
$data = [
    "apiKey" => "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6IjY3M2UxNjlhMjUzNDJjMjM1ZjUyNDQ4YSIsIm5hbWUiOiJLaGVsbyBCdWRkeSA1NTY2IiwiYXBwTmFtZSI6IkFpU2Vuc3kiLCJjbGllbnRJZCI6IjY3M2UxNjlhMjUzNDJjMjM1ZjUyNDQ4MSIsImFjdGl2ZVBsYW4iOiJCQVNJQ19NT05USExZIiwiaWF0IjoxNzMyMTIyMjY2fQ.qeBSK9Asdgwq1nOcVtmuTc9jW8uHq1yft_qz04Z1_T8",
    "campaignName" => "App Authentication",
    "destination" => "919588221390",
    "userName" => "Khelo Buddy 5566",
    "templateParams" => ["\$FirstName"],
    "source" => "new-landing-page form",
    "media" => new stdClass(), // Empty object
    "buttons" => [
        [
            "type" => "button",
            "sub_type" => "url",
            "index" => 0,
            "parameters" => [
                [
                    "type" => "text",
                    "text" => "123456"
                ]
            ]
        ]
    ],
    "carouselCards" => [],
    "location" => new stdClass(), // Empty object
    "paramsFallbackValue" => [
        "FirstName" => "user"
    ]
];

// Initialize cURL
$ch = curl_init();

// Set cURL options
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Content-Type: application/json"
]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

// Execute the request
$response = curl_exec($ch);

// Handle errors
if (curl_errno($ch)) {
    echo "cURL Error: " . curl_error($ch);
} else {
    // Print response from the API
    echo "Response: " . $response;
}

// Close the cURL session
curl_close($ch);
?>
