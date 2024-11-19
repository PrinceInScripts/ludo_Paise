<?php

require_once '../db.php';
$user_id = $_SESSION['id'];

// Fetch existing user data
$query = "SELECT username, email, mobile FROM users WHERE id = '$user_id'";
$result = mysqli_query($con, $query);
$user = mysqli_fetch_assoc($result);

// Initiate payment link AND UPDATE in database 

// Fetch existing user data

if (isset($_POST['payment_mode']) && isset($_POST['amount'])) {

    $payment_mode = $_POST['payment_mode'];
    $amount = $_POST['amount'];
    $mobile = $user['mobile'];

    $setting = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM settings WHERE id = 1"));
    $min_deposit = $setting['minRecharge'];

    if ($amount < $min_deposit) {
        echo json_encode(array('status' => 'error', 'message' => 'Minimum deposit amount is ' . $min_deposit));
        exit();
    }

    // assuming mobile is passed in the POST data

    if ($payment_mode == 'phonepe_api') {
        // Unique transaction ID
        $txn_id = uniqid('txn_');

        // API URLs
        $callback_url = 'http://ludopaisa.com/user-app/webhook/payment_callback.php?txn_id=' . $txn_id;
        $redirect_url = 'http://ludopaisa.com/user-app/history';

        // Prepare request data
        $url = 'https://phonepe.dkkart.com/ludopaisa/api.php';
        $data = array(
            'amount' => $amount,   // Assuming $amount is defined and passed from somewhere
            'mobile' => $mobile,   // Assuming $mobile is defined and passed from somewhere
            'txn_id' => $txn_id,
            'callback_url' => $callback_url,
            'redirect_url' => $redirect_url
        );

        // Initialize cURL session
        $ch = curl_init();

        // Set cURL options
        curl_setopt($ch, CURLOPT_URL, $url);                        // Set the target URL
        curl_setopt($ch, CURLOPT_POST, true);                       // Use POST method
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data)); // Set the POST fields

        // Set headers (optional but recommended)
        $headers = [
            'Content-Type: application/x-www-form-urlencoded',        // Specify the content type
            'Content-Length: ' . strlen(http_build_query($data))     // Specify the content length
        ];
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);              // Set the headers

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);              // Return response as a string
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);

        // Execute cURL request
        $result = curl_exec($ch);

        // Check for cURL errors
        if (curl_errno($ch)) {
            $error_msg = curl_error($ch);
            curl_close($ch);  // Close cURL session
            die(json_encode(array('status' => 'error', 'message' => 'cURL Error: ' . $error_msg)));
        }

        // Close cURL session
        curl_close($ch);

        // Decode the JSON response
        $response = json_decode($result, true);

        // Check for success or failure in response
        if (isset($response['payment_link'])) {

            // insert data into paymenthistory table 



            $sql = "INSERT INTO `paymenthistory`(`userid`, `order_id`, `amount`, `type`, `upi`, `status`, `remark`) VALUES ('$user_id','$txn_id','$amount','deposit','phonepe',0,'Pending Payment')";
            $result = mysqli_query($con, $sql);


            // Return success response with payment link

            echo json_encode(array('status' => 'success', 'url' => $response['payment_link']));
        } else {
            // Handle API failure response
            echo json_encode(array('status' => 'error', 'message' => 'Error in response', 'response' => $response));
        }
    } else if ($payment_mode == 'manual') {
        sleep(1);
        // fetch upi list from manualupi table 

        $sql = "SELECT * FROM manualupi WHERE status = 1";
        $result = mysqli_query($con, $sql);
        $upi_list = mysqli_fetch_all($result, MYSQLI_ASSOC);

        if (count($upi_list) == 0) {
            echo json_encode(array('status' => 'error', 'message' => 'No UPI available'));
            exit();
        } else {
            // take random upi entry from the list
            $upi = $upi_list[array_rand($upi_list)]['upi'];

            $txn_id = uniqid('txn_');
            // INSERT INTO `paymenthistory`(`id`, `userid`, `order_id`, `amount`, `type`, `upi`, `status`, `remark`, `utr`, `created_at`) VALUES ('[value-1]','[value-2]','[value-3]','[value-4]','[value-5]','[value-6]','[value-7]','[value-8]','[value-9]','[value-10]')
            $sql = "INSERT INTO `paymenthistory`(`userid`, `order_id`, `amount`, `type`, `upi`, `status`, `remark`) VALUES ('$user_id','$txn_id','$amount','deposit','$upi',0,'Pending Payment')";
            $result = mysqli_query($con, $sql);
            if ($result) {
                echo json_encode(array('status' => 'success', 'url' => './recharge?txn_id=' . $txn_id));
            } else {
                echo json_encode(array('status' => 'error', 'message' => 'Error in generating payment link'));
            }
        }
    } else if ($payment_mode == 'upigateway') {
        sleep(1);

        // API Endpoint
        $url = "https://upig.in/api/create-order";
        $orderid = uniqid('txn_qr_');

        // Data to send (replace with dynamic data as needed)
        $data = [
            "customer_mobile" => $mobile,
            "user_token" => "70080ad1bdbef1d1d0b394be20e1c7ff",
            "amount" => $amount,
            "order_id" => $orderid, // Generate a unique order ID for each request
            "redirect_url" => "https://ludopaisa.com/user-app/history",
            "remark1" => "ludopaisa",
            "remark2" => "ludopaisa"
        ];

        // Initialize cURL session
        $ch = curl_init();

        // Set cURL options
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data)); // Form-encoded payload
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Content-Type: application/x-www-form-urlencoded"
        ]);

        // Execute the request
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        // Check for errors
        if (curl_errno($ch)) {
            echo "cURL Error: " . curl_error($ch);
        } else {
            if ($httpCode === 200) {
                $responseData = json_decode($response, true);
                if ($responseData['status'] === true) {
                    echo json_encode(array('status' => 'success', 'url' => $responseData['result']['payment_url']));
                } else {
                    echo json_encode(array('status' => 'error', 'message' => 'Error in response', 'response' => $responseData));
                }
            } else {
                echo json_encode(array('status' => 'error', 'message' => 'HTTP Error: ' . $httpCode));
            }
        }

        // Close cURL session
        curl_close($ch);
    } else if ($payment_mode == 'bankcard') {
        sleep(1);
        echo json_encode(array('status' => 'error', 'message' => 'Use other gateway'));
    } else {
        sleep(1);
        echo json_encode(array('status' => 'error', 'message' => 'Use other gateway'));
    }
}
