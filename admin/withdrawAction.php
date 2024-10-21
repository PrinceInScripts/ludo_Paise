
<?php
 include("db.php");
    include("top.php");

    if (isset($_GET['id'])) {
        $id = mysqli_real_escape_string($con, $_GET['id']);
        $action = mysqli_real_escape_string($con, $_GET['action']);

        $withdraw_query = "SELECT * FROM withdrawrecord WHERE id='$id'";
        $withdraw_result = mysqli_query($con, $withdraw_query);
        $withdraw = mysqli_fetch_assoc($withdraw_result);

        $user_id = $withdraw['userid'];
       
        if ($action == 1) {
            $update_query = "UPDATE withdrawrecord SET status='1' WHERE id='$id'";
           
            $update_result = mysqli_query($con, $update_query);
            if ($update_result) {
                echo "<script>alert('Status Updated Successfully!')</script>";
                echo "<script>window.location='withdraw.php'</script>";
            } else {
                echo "<script>alert('Failed to Update Status!')</script>";
                echo "<script>window.location='withdraw.php'</script>";
            }
        } else if($action==2){
            $update_query = "UPDATE withdrawrecord SET status='2' WHERE id='$id'";
            $userw = $withdraw['amount'] + $withdraw['fee'];
            $update_user_query = "UPDATE users SET withdraw_wallet= withdraw_wallet + '$userw' WHERE id='$user_id'";
            $update_user_result = mysqli_query($con, $update_user_query);
            $update_result = mysqli_query($con, $update_query);
            if ($update_result) {
                echo "<script>alert('Status Updated Successfully!')</script>";
                echo "<script>window.location='withdraw.php'</script>";
            } else {
                echo "<script>alert('Failed to Update Status!')</script>";
                echo "<script>window.location='withdraw.php'</script>";
            }
        }
        
    }
?>