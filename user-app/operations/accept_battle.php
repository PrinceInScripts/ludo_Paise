<?php 

require_once '../db.php';
$user_id = $_SESSION['id'];

if(isset($_GET['battle_id'])){
    $battle_id = $_GET['battle_id'];
    // fetch games data 
    $fetch = "SELECT * FROM games WHERE id = '$battle_id' AND status = 'pending'";
    $result = mysqli_query($con, $fetch);
    $fetch = mysqli_fetch_assoc($result);
    $created_by = $fetch['created_by'];
    $joining_fee = $fetch['amount'];
    $accepted_by = $fetch['accepted_by'];

    // fetch balance of creator and acceptor 
    $fetchCreatorBalance = "SELECT * FROM users WHERE id = '$created_by'";
    $fetchCreatorBalanceResult = mysqli_query($con, $fetchCreatorBalance);
    $fetchCreatorBalanceRow = mysqli_fetch_assoc($fetchCreatorBalanceResult);
    $creatorBalance = $fetchCreatorBalanceRow['deposit_wallet'];
    $creatorWithdrawBalance = $fetchCreatorBalanceRow['withdraw_wallet'];
    
    $fetchAcceptorBalance = "SELECT * FROM users WHERE id = '$accepted_by'";
    $fetchAcceptorBalanceResult = mysqli_query($con, $fetchAcceptorBalance);
    $fetchAcceptorBalanceRow = mysqli_fetch_assoc($fetchAcceptorBalanceResult);
    $acceptorBalance = $fetchAcceptorBalanceRow['deposit_wallet'];
    $acceptorWithdrawBalance = $fetchAcceptorBalanceRow['withdraw_wallet'];

    // deduct amount from deposit wallet if remaining then deduct from withdraw wallet 
    if($creatorBalance >= $joining_fee){
        $updatedcreatorBalance = $creatorBalance - $joining_fee;
        $updateCreatorBalance = "UPDATE users SET deposit_wallet = '$updatedcreatorBalance' WHERE id = '$created_by'";
        $updateCreatorBalanceResult = mysqli_query($con, $updateCreatorBalance);
        //insert that amount in amount table for taking all amount insert data in amount table
        $sql1 = "INSERT INTO amount (amount, user_id,type) VALUES ('$joining_fee', '$created_by','debited')";
        mysqli_query($con, $sql1);

        // update game_record 
        $insertRecord = "INSERT INTO game_record (user_id, game_id, amount, ProfitAmount, status, remark, deposit_balance , withdraw_balance) 
        VALUES ('$created_by', '$battle_id', '$joining_fee', '$joining_fee', 'game_join', 'balance Deduct for joining game from deposit wallet', '$joining_fee', '0')";
        $insertRecordResult = mysqli_query($con, $insertRecord);

    }else{
        $updatedjoining_fee = $joining_fee - $creatorBalance;
        $updateCreatorBalance
            = "UPDATE users SET deposit_wallet = 0, withdraw_wallet = withdraw_wallet - '$updatedjoining_fee' WHERE id = '$created_by'";
        $updateCreatorBalanceResult = mysqli_query($con, $updateCreatorBalance);
        //insert that amount in amount table for taking all amount insert data in amount table
        $sql1 = "INSERT INTO amount (amount, user_id,type) VALUES ('$joining_fee', '$created_by','debited')";
        mysqli_query($con, $sql1);

        // update game_record
        $insertRecord = "INSERT INTO game_record (user_id, game_id, amount, ProfitAmount, status, remark, deposit_balance , withdraw_balance)
        VALUES ('$created_by', '$battle_id', '$joining_fee', '$joining_fee', 'game_join', 'balance Deduct for joining game from both wallet', '$creatorBalance', '$updatedjoining_fee')";
        $insertRecordResult = mysqli_query($con, $insertRecord);
    }

    // deduct amount from deposit wallet if remaining then deduct from withdraw wallet
    if($acceptorBalance >= $joining_fee){
        $updatedacceptorBalance = $acceptorBalance - $joining_fee;
        $updateAcceptorBalance = "UPDATE users SET deposit_wallet = '$updatedacceptorBalance' WHERE id = '$accepted_by'";
        $updateAcceptorBalanceResult = mysqli_query($con, $updateAcceptorBalance);

        // update game_record
        $insertRecord = "INSERT INTO game_record (user_id, game_id, amount, ProfitAmount, status, remark, deposit_balance , withdraw_balance)
        VALUES ('$accepted_by', '$battle_id', '$joining_fee', '$joining_fee', 'game_join', 'balance Deduct for joining game from deposit wallet', '$joining_fee', '0')";
        $insertRecordResult = mysqli_query($con, $insertRecord);
    }else{
        $upjoining_fee = $joining_fee - $acceptorBalance;
        $updateAcceptorBalance
            = "UPDATE users SET deposit_wallet = 0, withdraw_wallet = withdraw_wallet - '$upjoining_fee' WHERE id = '$accepted_by'";
        $updateAcceptorBalanceResult = mysqli_query($con, $updateAcceptorBalance);

        // update game_record
        $insertRecord = "INSERT INTO game_record (user_id, game_id, amount, ProfitAmount, status, remark, deposit_balance , withdraw_balance)
        VALUES ('$accepted_by', '$battle_id', '$joining_fee', '$joining_fee', 'game_join', 'balance Deduct for joining game from both wallet', '$acceptorBalance', '$upjoining_fee')";
        $insertRecordResult = mysqli_query($con, $insertRecord);


    }



    $sql = "UPDATE games SET isJoined = 1, status = 'running' WHERE id = '$battle_id' AND created_by = '$user_id'";

    $result = mysqli_query($con, $sql);
    if($result){
       
            // Fallback: Redirect to a default page if HTTP_REFERER is not set
            header('Location: ../newbattle.php');
            exit();
     
    }else{
        echo "An error occured";
    }
}

?>