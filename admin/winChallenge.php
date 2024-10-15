<?php 
include('db.php');

if(isset($_POST['mobile']) && isset($_POST['id'])){
    $mobile = $_POST['mobile'];
    $battle_id = $_POST['id'];
    // fetch games data 
    $fetch = "SELECT * FROM games WHERE id = '$battle_id'";
    $result = mysqli_query($con, $fetch);
    $fetch = mysqli_fetch_assoc($result);
    $created_by = $fetch['created_by'];
    $winAmount = $fetch['winAmount'];
    $amount = $fetch['amount'];
    $accepted_by = $fetch['accepted_by'];
    
    // fetch user data 
    $sql = "SELECT * FROM users WHERE mobile = '$mobile'";
    $result = mysqli_query($con, $sql);
    $users = mysqli_fetch_assoc($result);
    $user_id = $users['id'];
    $deposit_wallet = $users['deposit_wallet'];

    if($user_id == $accepted_by){

        // update user withdraw_wallet 
        $sql = "UPDATE users SET withdraw_wallet = withdraw_wallet + '$winAmount' WHERE id = '$user_id'";
        $result = mysqli_query($con, $sql);

        // update game_record
        $insertRecord = "INSERT INTO game_record (user_id, game_id, amount, ProfitAmount, status, remark, deposit_balance , withdraw_balance)
        VALUES ('$user_id', '$battle_id', '$amount', '$winAmount', 'game_win', 'balance added for winning game', '$deposit_wallet', '$winAmount')";
        $insertRecordResult = mysqli_query($con, $insertRecord);

        // update game status
        $sql = "UPDATE games SET status = 'complete', is_complete = 1, winner = '$accepted_by' WHERE id = '$battle_id'";
        $result = mysqli_query($con, $sql);

        if($result){
            echo json_encode(array('status' => 'success'));
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'Error adding penalty: ' . mysqli_error($con)));
        }


    }elseif($user_id == $created_by){
        // update user withdraw_wallet 
        $sql = "UPDATE users SET withdraw_wallet = withdraw_wallet + '$winAmount' WHERE id = '$user_id'";
        $result = mysqli_query($con, $sql);

        // update game_record
        $insertRecord = "INSERT INTO game_record (user_id, game_id, amount, ProfitAmount, status, remark, deposit_balance , withdraw_balance)
        VALUES ('$user_id', '$battle_id', '$amount', '$winAmount', 'game_win', 'balance added for winning game', '$deposit_wallet', '$winAmount')";
        $insertRecordResult = mysqli_query($con, $insertRecord);

        // update game status
        $sql = "UPDATE games SET status = 'complete', is_complete = 1, winner = '$created_by' WHERE id = '$battle_id'";
        $result = mysqli_query($con, $sql);

        if($result){
            echo json_encode(array('status' => 'success'));
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'Error adding penalty: ' . mysqli_error($con)));
        }

    }

}
?>