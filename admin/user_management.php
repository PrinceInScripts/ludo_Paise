<?php
include("db.php");

if (isset($_GET['id']) && isset($_GET['status'])) {
    $id = mysqli_real_escape_string($con, $_GET['id']);
    $status = mysqli_real_escape_string($con, $_GET['status']);

    // Update user status in the database
    $update_status_query = "UPDATE users SET status='$status' WHERE id='$id'";
    mysqli_query($con, $update_status_query);

    // Redirect to previous page or display a success message
    header("Location: viewUser.php?id=$id"); // Replace with your actual page
    // exit;
}
?>