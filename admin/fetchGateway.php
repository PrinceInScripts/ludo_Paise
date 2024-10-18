<?php
include('db.php'); // Include your DB connection

if (isset($_POST['id'])) {
    $id = mysqli_real_escape_string($con, $_POST['id']); // Sanitize input
    $query = "SELECT * FROM payment_modes WHERE id = '$id'";
    $result = mysqli_query($con, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        echo json_encode([
            'success' => true,
            'data' => $row
        ]);
    } else {
        echo json_encode([
            'success' => false
        ]);
    }
} else {
    echo json_encode([
        'success' => false
    ]);
}
