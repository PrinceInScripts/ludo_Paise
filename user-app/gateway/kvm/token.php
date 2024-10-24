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
]);

$response = curl_exec($curl);
curl_close($curl);

$data = json_decode($response, true);
$token = $data['Access_token'];

?>