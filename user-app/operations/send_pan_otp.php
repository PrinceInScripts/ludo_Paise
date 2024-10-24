<?php

require_once '../db.php';

$user_id = $_SESSION['id'];

if(isset($_POST['pan'])){
    
// API URL
$url = "https://api.quickekyc.com/api/v1/pan/pan";
$pan = $_POST['pan'];
// The data you want to send in the POST request

// check aadhar is already exist or not 

$check = "SELECT * FROM users WHERE pan_no = '$pan'";
$result = mysqli_query($con, $check);
$fetch = mysqli_fetch_assoc($result);

if(mysqli_num_rows($result) > 0){
    $res = array(['status' => 'error', 'message' => 'PAN already exist']);
    echo json_encode($res);
    exit();
}

$postData = [
    // 'key' => '',
    'key' => '7b4c50bf-21ae-49f8-850f-f74133a65546',
    'id_number' => $pan,
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
        $full_name = $responseData['data']['full_name'];
        $category = $responseData['data']['category'];

        $query = "UPDATE users SET pan_no = '$pan', pan_status = 1 WHERE id = '$user_id'";
        $query2 = "INSERT INTO pan_data (userid, pan_no, full_name, category) VALUES ('$user_id', '$pan', '$full_name', '$category')";
        $run = mysqli_query($con, $query2);
        $result = mysqli_query($con, $query);

        if($result){
            $res =  array(['status' => 'success', 'message' => $responseData['message']]);
        } else {
            $res =  array(['status' => 'success', 'message' => $responseData['message']]);
        }
        
    } else {
        $res = array(['status' => 'error', 'message' => $responseData['message']]);
    }
}

echo json_encode($res);
// Close cURL
curl_close($ch);
}

?>
