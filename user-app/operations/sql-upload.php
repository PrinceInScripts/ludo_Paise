<?php 
// Include database connection file
require_once '../db.php';

// Fetch data from 'tablename' table
$sql = "SELECT * FROM tablename";
$result = mysqli_query($con, $sql);

// Check if data was fetched
if ($result && mysqli_num_rows($result) > 0) {
    // Prepare insert statement for 'users' table
    
    $insert_stmt = $con->prepare("INSERT INTO users (fname, email, profile_pic, mobile, deposit_wallet, referrer_id, level_1) VALUES (?,?, ?, ?, ?, ?, ?)");

    // Check if prepare was successful
    if ($insert_stmt) {
        // Bind parameters for insertion
        $insert_stmt->bind_param("ssssdss", $name, $email, $profile, $mobile, $deposit_wallet, $referrer, $level_1);

        // Loop through each row of fetched data
        while ($row = mysqli_fetch_assoc($result)) {
            // Assign values to variables
            $profile = rand(1,22);
            $name = $row['Name'];
            $email = $row['Email'];
            $mobile = $row['Phone'];
            $deposit_wallet = $row['Wallet_balance'];
            $referrer = $row['referral_code'];
            $level_1 = $row['referral'];

            // Execute the prepared statement
            if ($insert_stmt->execute()) {
                echo "Data uploaded successfully for user: $name <br>";
            } else {
                echo "An error occurred while uploading data for user: $name. Error: " . $insert_stmt->error . "<br>";
            }
        }

        // Close the prepared statement
        $insert_stmt->close();
    } else {
        echo "Failed to prepare the insert statement: " . $con->error;
    }
} else {
    echo "No data found in 'tablename' table or query error: " . mysqli_error($con);
}

// Close database connection
mysqli_close($con);
?>
