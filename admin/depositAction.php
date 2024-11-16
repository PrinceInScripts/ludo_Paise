<?php
include("db.php");
include("top.php");

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($con, $_GET['id']);
    $action = mysqli_real_escape_string($con, $_GET['action']);

    $deposit_query = "SELECT * FROM paymenthistory WHERE id='$id'";
    $deposit_result = mysqli_query($con, $deposit_query);
    $deposit = mysqli_fetch_assoc($deposit_result);

    $user_id = $deposit['userid'];
   
    if ($action == 1) {
        $update_query = "UPDATE paymenthistory SET status='1' WHERE id='$id'";
        $userw = $deposit['amount'];
        $update_user_query = "UPDATE users SET deposit_wallet= deposit_wallet + '$userw' WHERE id='$user_id'";
        $update_user_result = mysqli_query($con, $update_user_query);
        //insert that amount in amount table for taking all amount insert data
        $sql1 = "INSERT INTO amount (amount, user_id) VALUES ('$userw', '$user_id')";
        $insertAmount = mysqli_query($con, $sql1);

        $update_result = mysqli_query($con, $update_query);
        if ($update_result) {
            echo "<script>alert('Status Updated Successfully!')</script>";
            echo "<script>window.location='deposit.php'</script>";
        } else {
            echo "<script>alert('Failed to Update Status!')</script>";
            echo "<script>window.location='deposit.php'</script>";
        }
    } else if($action==2){
        $update_query = "UPDATE paymenthistory SET status='2' WHERE id='$id'";
        $update_result = mysqli_query($con, $update_query);
        if ($update_result) {
            echo "<script>alert('Status Updated Successfully!')</script>";
            echo "<script>window.location='deposit.php'</script>";
        } else {
            echo "<script>alert('Failed to Update Status!')</script>";
            echo "<script>window.location='deposit.php'</script>";
        }
    }
    
}
