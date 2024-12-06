<?php 
include('db.php');

if(isset($_POST['mobile']) && isset($_POST['id'])){
    $mobile = $_POST['mobile'];
    $battle_id = $_POST['id'];
    // fetch games data 
    $fetch = "SELECT * FROM games WHERE id = '$battle_id' AND status != 'complete' AND is_complete = 0";
    $result = mysqli_query($con, $fetch);
    $fetch = mysqli_fetch_assoc($result);

    if(!$fetch){
        echo json_encode(array('status' => 'error', 'message' => 'Game not found'));
        exit();
    }

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
        // insert that amount in amount table for taking all amount insert data
        $sql1 = "INSERT INTO amount (amount, user_id) VALUES ('$winAmount', '$user_id')";
        $insertAmount = mysqli_query($con, $sql1);

        // update game_record
        $insertRecord = "INSERT INTO game_record (user_id, game_id, amount, ProfitAmount, status, remark, deposit_balance , withdraw_balance)
        VALUES ('$user_id', '$battle_id', '$amount', '$winAmount', 'game_win', 'balance added for winning game', '$deposit_wallet', '$winAmount')";
        $insertRecordResult = mysqli_query($con, $insertRecord);

        // update game status
        $sql = "UPDATE games SET status = 'complete', is_complete = 1, winner = '$accepted_by' WHERE id = '$battle_id'";
        $result = mysqli_query($con, $sql);

         // 2% for winner referral and 1% for loser referral

        $winnerReferral = $amount * 0.02;
        $loserReferral = $amount * 0.01;

        // fetch winner referral id
        $fetchWinnerReferral = "SELECT level_1 FROM users WHERE id = '$accepted_by'";
        $result = mysqli_query($con, $fetchWinnerReferral);
        $winnerReferralId = mysqli_fetch_assoc($result);
        $winnerReferralId = $winnerReferralId['level_1'];

        // fetch loser referral id
        $fetchLoserReferral = "SELECT level_1 FROM users WHERE id = '$created_by'";
        $result = mysqli_query($con, $fetchLoserReferral);
        $loserReferralId = mysqli_fetch_assoc($result);
        $loserReferralId = $loserReferralId['level_1'];

         // check if winner has referral code
        if($winnerReferralId != null){
            // update winner referral balance
            $updateWinnerReferral = "UPDATE users SET deposit_wallet = deposit_wallet + '$winnerReferral', referral_earning = referral_earning + '$winnerReferral' WHERE referrer_id = '$winnerReferralId'";
            $result = mysqli_query($con, $updateWinnerReferral);
            // insert that amount in amount table for taking all amount insert data
            $sql1 = "INSERT INTO amount (amount, user_id) VALUES ('$winnerReferral', '$winnerReferralId')";
            $insertAmount = mysqli_query($con, $sql1);

            // insert into referral_data table 
            $insertReferralData = "INSERT INTO referral_data (earn_to, battle_id, amount, earn_from, remark) VALUES ('$winnerReferralId', '$battle_id', '$winnerReferral', '$accepted_by', '2% winner referral earning')";
            $result = mysqli_query($con, $insertReferralData);

        }

        // // check if loser has referral code
        // if($loserReferralId != null){
        //     // update loser referral balance
        //     $updateLoserReferral = "UPDATE users SET deposit_wallet = deposit_wallet + '$loserReferral', referral_earning = referral_earning + '$loserReferral' WHERE referrer_id = '$loserReferralId'";
        //     $result = mysqli_query($con, $updateLoserReferral);
        //     // insert that amount in amount table for taking all amount insert data
        //     $sql1 = "INSERT INTO amount (amount, user_id) VALUES ('$loserReferral', '$loserReferralId')";
        //     $insertAmount = mysqli_query($con, $sql1);

        //     // insert into referral_data table 
        //     $insertReferralData = "INSERT INTO referral_data (earn_to, battle_id, amount, earn_from, remark) VALUES ('$loserReferralId', '$battle_id', '$loserReferral', '$created_by', '1% loser referral earning')";
        //     $result = mysqli_query($con, $insertReferralData);

        // }


        if($result){
            echo json_encode(array('status' => 'success'));
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'Error adding penalty: ' . mysqli_error($con)));
        }


    }elseif($user_id == $created_by){
        // update user withdraw_wallet 
        $sql = "UPDATE users SET withdraw_wallet = withdraw_wallet + '$winAmount' WHERE id = '$user_id'";
        $result = mysqli_query($con, $sql);
        // insert that amount in amount table for taking all amount insert data
        $sql1 = "INSERT INTO amount (amount, user_id) VALUES ('$winAmount', '$user_id')";
        $insertAmount = mysqli_query($con, $sql1);

        // update game_record
        $insertRecord = "INSERT INTO game_record (user_id, game_id, amount, ProfitAmount, status, remark, deposit_balance , withdraw_balance)
        VALUES ('$user_id', '$battle_id', '$amount', '$winAmount', 'game_win', 'balance added for winning game', '$deposit_wallet', '$winAmount')";
        $insertRecordResult = mysqli_query($con, $insertRecord);

        // update game status
        $sql = "UPDATE games SET status = 'complete', is_complete = 1, winner = '$created_by' WHERE id = '$battle_id'";
        $result = mysqli_query($con, $sql);

        // 2% for winner referral and 1% for loser referral

        $winnerReferral = $amount * 0.02;
        $loserReferral = $amount * 0.01;

        // fetch winner referral id
        $fetchWinnerReferral = "SELECT level_1 FROM users WHERE id = '$created_by'";
        $result = mysqli_query($con, $fetchWinnerReferral);
        $winnerReferralId = mysqli_fetch_assoc($result);
        $winnerReferralId = $winnerReferralId['level_1'];
        
        // fetch loser referral id
        $fetchLoserReferral = "SELECT level_1 FROM users WHERE id = '$accepted_by'";
        $result = mysqli_query($con, $fetchLoserReferral);
        $loserReferralId = mysqli_fetch_assoc($result);
        $loserReferralId = $loserReferralId['level_1'];

        // check if winner has referral code
        if($winnerReferralId != null){
            // update winner referral balance
            $updateWinnerReferral = "UPDATE users SET deposit_wallet = deposit_wallet + '$winnerReferral', referral_earning = referral_earning + '$winnerReferral' WHERE referrer_id = '$winnerReferralId'";
            $result = mysqli_query($con, $updateWinnerReferral);
            // insert that amount in amount table for taking all amount insert data
            $sql1 = "INSERT INTO amount (amount, user_id) VALUES ('$winnerReferral', '$winnerReferralId')";
            $insertAmount = mysqli_query($con, $sql1);

            // insert into referral_data table 
            $insertReferralData = "INSERT INTO referral_data (earn_to, battle_id, amount, earn_from, remark) VALUES ('$winnerReferralId', '$battle_id', '$winnerReferral', '$created_by', '2% winner referral earning')";
            $result = mysqli_query($con, $insertReferralData);

        }

        // check if loser has referral code

        // if($loserReferralId != null){
        //     // update loser referral balance
        //     $updateLoserReferral = "UPDATE users SET deposit_wallet = deposit_wallet + '$loserReferral', referral_earning = referral_earning + '$loserReferral' WHERE referrer_id = '$loserReferralId'";
        //     $result = mysqli_query($con, $updateLoserReferral);
        //     // insert that amount in amount table for taking all amount insert data
        //     $sql1 = "INSERT INTO amount (amount, user_id) VALUES ('$loserReferral', '$loserReferralId')";
        //     $insertAmount = mysqli_query($con, $sql1);

        //     // insert into referral_data table 
        //     $insertReferralData = "INSERT INTO referral_data (earn_to, battle_id, amount, earn_from, remark) VALUES ('$loserReferralId', '$battle_id', '$loserReferral', '$accepted_by', '1% loser referral earning')";
        //     $result = mysqli_query($con, $insertReferralData);

        // }

        if($result){
            echo json_encode(array('status' => 'success'));
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'Error adding penalty: ' . mysqli_error($con)));
        }

    }

}
?>