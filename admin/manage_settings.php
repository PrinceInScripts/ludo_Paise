<?php
// Include database connection
require_once 'db.php';

// Check if the form is submitted for Min Withdraw update
if (isset($_POST['update_withdraw'])) {
    $minWithdraw = mysqli_real_escape_string($con, $_POST['minWithdraw']); // Sanitize input
    $sql = "UPDATE settings SET minWithdraw = '$minWithdraw' WHERE id = '1'";
    $result = mysqli_query($con, $sql);

    if ($result) {
        echo "Min Withdraw updated successfully.";
        header("Location:limits.php"); // Redirect back to the page
        exit();
    } else {
        echo "Error updating Min Withdraw: " . mysqli_error($con);
    }
}

// Check if the form is submitted for Min Recharge update
if (isset($_POST['update_recharge'])) {
    $minRecharge = mysqli_real_escape_string($con, $_POST['minRecharge']); // Sanitize input
    $sql = "UPDATE settings SET minRecharge = '$minRecharge' WHERE id = 1 ";
    $result = mysqli_query($con, $sql);

    if ($result) {
        echo "Min Recharge updated successfully.";
        header("Location:limits.php"); // Redirect back to the page
        exit();
    } else {
        echo "Error updating Min Recharge: " . mysqli_error($con);
    }
}else{
    echo "Error updating Min Recharge: " . mysqli_error($con);
}
if (isset($_POST['update_classicFees'])) {
    $clasicFees = mysqli_real_escape_string($con, $_POST['clasicFees']); // Sanitize input
    $sql = "UPDATE settings SET classic_fee = '$clasicFees' WHERE id = '1'";
    $result = mysqli_query($con, $sql);

    if ($result) {
        echo "Min Withdraw updated successfully.";
        header("Location:adjust_fees.php"); // Redirect back to the page
        exit();
    } else {
        echo "Error updating Min Withdraw: " . mysqli_error($con);
    }
}

if (isset($_POST['update_popularFees'])) {
    $popularFees = mysqli_real_escape_string($con, $_POST['popularFees']); // Sanitize input
    $sql = "UPDATE settings SET popular_fee = '$popularFees' WHERE id = '1'";
    $result = mysqli_query($con, $sql);

    if ($result) {
        echo "Min Withdraw updated successfully.";
        header("Location:adjust_fees.php"); // Redirect back to the page
        exit();
    } else {
        echo "Error updating Min Withdraw: " . mysqli_error($con);
    }
}

if (isset($_POST['update_game3Fees'])) {
    $game3Fees = mysqli_real_escape_string($con, $_POST['game3fee']); // Sanitize input
    $sql = "UPDATE settings SET game3_fee = '$game3Fees' WHERE id = '1'";
    $result = mysqli_query($con, $sql);

    if ($result) {
        echo "Min Withdraw updated successfully.";
        header("Location:adjust_fees.php"); // Redirect back to the page
        exit();
    } else {
        echo "Error updating Min Withdraw: " . mysqli_error($con);
    }
}
if (isset($_POST['update_game4Fees'])) {
    $game4Fees = mysqli_real_escape_string($con, $_POST['game4fee']); // Sanitize input
    $sql = "UPDATE settings SET game4_fee = '$game4Fees' WHERE id = '1'";
    $result = mysqli_query($con, $sql);

    if ($result) {
        echo "Min Withdraw updated successfully.";
        header("Location:adjust_fees.php"); // Redirect back to the page
        exit();
    } else {
        echo "Error updating Min Withdraw: " . mysqli_error($con);
    }
}



?>
