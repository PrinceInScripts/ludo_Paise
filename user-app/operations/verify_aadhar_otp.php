<?php

require_once '../db.php';

$user_id = $_SESSION['id'];
$aadhar_request_id = $_SESSION['aadhar_request_id'];



if (isset($_POST['otp'])) {

    // API URL
    $url = "https://api.quickekyc.com/api/v1/aadhaar-v2/submit-otp";
    $aadhar_otp = $_POST['otp'];
    // The data you want to send in the POST request
    $postData = [
        'key' => '7b4c50bf-21ae-49f8-850f-f74133a65546',
        'request_id' => $aadhar_request_id,
        'otp' => $aadhar_otp,
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
        // print_r( $responseData);
       
        if ($responseData['status'] == 'success') {

            $full_name = $responseData['data']['full_name'];
            $aadhaar_number = $responseData['data']['aadhaar_number'];
            $dob = $responseData['data']['dob'];
            $gender = $responseData['data']['gender'];
            $country = $responseData['data']['address']['country'];
            $dist = $responseData['data']['address']['dist'];
            $state = $responseData['data']['address']['state'];
            $po = $responseData['data']['address']['po'];
            $vtc = $responseData['data']['address']['vtc'];
            $subdist = $responseData['data']['address']['subdist'];
            $street = $responseData['data']['address']['street'];
            $house = $responseData['data']['address']['house'];
            $zip = $responseData['data']['zip'];
            // $profile_image = $responseData['data']['profile_image'];
            $mobile_hash = $responseData['data']['mobile_hash'];
            $share_code = $responseData['data']['share_code'];
            // $reference_id = $responseData['data']['reference_id'];
            $request_id = $responseData['request_id'];

            // INSERT INTO `aadhaar_data`(`id`, `user_id`, `full_name`, `aadhaar_number`, `dob`, `gender`, `country`, `dist`, `state`, `po`, `vtc`, `subdist`, `street`, `house`, `zip`, `profile_image`, `mobile_hash`, `share_code`, `reference_id`, `request_id`, `created_at`) VALUES ('[value-1]','[value-2]','[value-3]','[value-4]','[value-5]','[value-6]','[value-7]','[value-8]','[value-9]','[value-10]','[value-11]','[value-12]','[value-13]','[value-14]','[value-15]','[value-16]','[value-17]','[value-18]','[value-19]','[value-20]','[value-21]')

            $insertAadhardata = "INSERT INTO `aadhaar_data`(`user_id`, `full_name`, `aadhaar_number`, `dob`, `gender`, `country`, `dist`, `state`, `po`, `vtc`, `subdist`, `street`, `house`, `zip`, `mobile_hash`, `share_code`, `request_id`) VALUES ('$user_id','$full_name','$aadhaar_number','$dob','$gender','$country','$dist','$state','$po','$vtc','$subdist','$street','$house','$zip','$mobile_hash','$share_code','$request_id')";
            $run = mysqli_query($con, $insertAadhardata);
            if($insertAadhardata){
                $query = "UPDATE users SET kyc_status = 1 WHERE id = '$user_id'";
                $run = mysqli_query($con, $query);
                if($run){
                    $res =  array(['status' => 'success', 'message' => $responseData['message']]);
                }else{
                $res =  array(['status' => 'success', 'message' => 'Failed to update user status']);
                }
            }

            
           
            
        } else {
            $res = array(['status' => 'error', 'message' => 'Failed to verify account']);
        }
    }

    echo json_encode($res);
    // Close cURL
    curl_close($ch);
}
