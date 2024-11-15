<?php 
include ('db.php');
// admin role_id 
$adminid = $_SESSION['role_id'];
if (isset($_POST['action'])) {
    $id = mysqli_real_escape_string($con, $_POST['id']);
    $user_sql = "SELECT * FROM users WHERE id='$id'";
    $user_run = mysqli_query($con, $user_sql);
    $user = mysqli_fetch_assoc($user_run);
    
    // Check which action to perform (bonus or penalty)
    if ($_POST['action'] == 'bonus') {
        $bonus = mysqli_real_escape_string($con, $_POST['bonus_amount']);
        $remark = mysqli_real_escape_string($con, $_POST['bonus_remark']);
        $wallet = $user['deposit_wallet'] + $bonus;
        $sql = "UPDATE users SET deposit_wallet='$wallet' WHERE id='$id'";
        mysqli_query($con, $sql);

        //check remark if it's empty then add default remark message
        if (empty($remark)) {
            $remark = 'Bonus added by admin';
        }

        // add bonus table 
        $bonus_sql = "INSERT INTO bonus (userid, amount, created_by, remark) VALUES ('$id', '$bonus', '$adminid', '$remark')";
        $ch = mysqli_query($con, $bonus_sql);
        header("Location:viewUser.php?id=$id");
        exit;
    }
    
    if ($_POST['action'] == 'penalty') {
        $penalty = mysqli_real_escape_string($con, $_POST['penalty_amount']);
        $remark = mysqli_real_escape_string($con, $_POST['penalty_remark']);

        $wallet = $user['deposit_wallet'] - $penalty;
        $sql = "UPDATE users SET deposit_wallet='$wallet' WHERE id='$id'";
        mysqli_query($con, $sql);

        //check remark if it's empty then add default remark message
        if (empty($remark)) {
            $remark = 'Penalty added by admin';
        }

        // add penalty table
        $penalty_sql = "INSERT INTO penalties (user_id, amount, admin_id, remark) VALUES ('$id', '$penalty', '$adminid', '$remark')";
        $ch = mysqli_query($con, $penalty_sql);

        header("Location:viewUser.php?id=$id");
        exit;
    }
}

?>