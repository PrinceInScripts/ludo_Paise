<?php 

// accept webhook data from payment gateway
// assuming the payment gateway sends the data in the POST request


// php:input 

$data = file_get_contents('php://input');
$payment_data = json_decode($data, true);

// append in txt file 
$fp = fopen('payment_log.txt', 'a');
fwrite($fp, json_encode($payment_data) . "\n");
fclose($fp);



?>