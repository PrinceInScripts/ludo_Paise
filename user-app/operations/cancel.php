<?php
require_once '../db.php';
$user_id = $_SESSION['id'];

if (!$user_id) {
    echo json_encode([['error' => true, 'message' => "User session not found."]]);
    exit;
}


if(isset($_POST['battle_id'])){
    
    $battle_id = $_POST['battle_id'];

    $fetch = "SELECT * FROM games WHERE id = '$battle_id' AND is_complete = 0 AND (created_by = '$user_id' OR accepted_by = '$user_id')";
    $result = mysqli_query($con, $fetch);
    $fetch_row = mysqli_fetch_assoc($result);

    if (mysqli_num_rows($result) > 0) {
         // fetch games table
         $getGames = "SELECT * FROM games WHERE id = '$battle_id'";
         $getGamesResult = mysqli_query($con, $getGames);
         $getGamesRow = mysqli_fetch_assoc($getGamesResult);
        if($fetch_row['created_by'] == $user_id){
           

            if($getGamesRow['acceptor_ss']=='cancel'){
                $amount = $getGamesRow['amount'];
                $status = 'cancel';
                $isComplete = 1;
                $reason = 'Game Cancel by creator and acceptor';
                $remark = 'Game cancel by creator and acceptor';
                $creator_ss = 'cancel';

                $sql = "UPDATE games SET status = '$status', is_complete = '$isComplete', creator_ss = '$creator_ss', status_reason = '$reason',
                remark = '$remark' WHERE id = '$battle_id' AND created_by = '$user_id'";

                mysqli_query($con, $sql);

                // update balance of opponent
                $updateBalanceCreator = "UPDATE users SET deposit_wallet = deposit_wallet + '$amount' WHERE id = '".$getGamesRow['created_by']."'";
                mysqli_query($con, $updateBalanceCreator);
                 //insert that amount in amount table for taking all amount insert data
                 $sql1 = "INSERT INTO amount (amount, user_id) VALUES ('$amount', '".$getGamesRow['created_by']."')";
                 mysqli_query($con, $sql1);
                $updateBalanceAcceptor = "UPDATE users SET deposit_wallet = deposit_wallet + '$amount' WHERE id = '".$getGamesRow['accepted_by']."'";
                mysqli_query($con, $updateBalanceAcceptor);
                //insert that amount in amount table for taking all amount insert data
                $sql2 = "INSERT INTO amount (amount, user_id) VALUES ('$amount', '".$getGamesRow['accepted_by']."')";
                mysqli_query($con, $sql2);
                



            } else{
                $status = 'pending';
                $isComplete = 0;
                $reason = 'Game cancel by creator';
                $creator_ss= 'cancel';
                $remark = 'Game cancel by creator';


                $sql = "UPDATE games SET status = '$status', is_complete = '$isComplete', creator_ss = '$creator_ss', status_reason = '$reason',
                 remark = '$remark' WHERE id = '$battle_id' AND created_by = '$user_id'";
                mysqli_query($con, $sql);
            }
        }else{
            
            if($fetch_row['creator_ss']=='cancel'){
                $amount = $getGamesRow['amount'];
                $status = 'cancel';
                $isComplete = 1;
                $reason = 'Game Cancel by creator and acceptor';
                $remark = 'Game cancel by creator and acceptor';
                $acceptor_ss = 'cancel';

                $sql = "UPDATE games SET status = '$status', is_complete = '$isComplete', acceptor_ss = '$acceptor_ss', status_reason = '$reason',  remark = '$remark' WHERE id = '$battle_id' AND accepted_by = '$user_id'";
                mysqli_query($con, $sql);
                // update balance of opponent
                $updateBalanceCreator = "UPDATE users SET deposit_wallet = deposit_wallet + '$amount' WHERE id = '".$getGamesRow['created_by']."'";
                mysqli_query($con, $updateBalanceCreator);
                $updateBalanceAcceptor = "UPDATE users SET deposit_wallet = deposit_wallet + '$amount' WHERE id = '".$getGamesRow['accepted_by']."'";
                mysqli_query($con, $updateBalanceAcceptor);
            } else{
                $status = 'pending';
                $isComplete = 0;
                $reason = 'Game cancel by acceptor';
                $remark = 'Game cancel by acceptor';
                $acceptor_ss = 'cancel';

                $sql = "UPDATE games SET status = '$status', is_complete = '$isComplete', acceptor_ss = '$acceptor_ss', status_reason = '$reason', remark = '$remark' WHERE id = '$battle_id' AND accepted_by = '$user_id'";
                mysqli_query($con, $sql);
            }


           
        }

        
        if (mysqli_affected_rows($con) > 0) {
            echo json_encode([['error' => false , 'message' => "You have cancel the game."]]);
        } else {
            echo json_encode([['error' => true , 'message' => "An error occured."]]);
        }
    } else {
        echo json_encode([['error' => true , 'message' => "Battle not found or unauthorized access."]]);

    }
}else{
    echo json_encode([['error' => true , 'message' => "Missing battle ID or user ID."]]);
}

?>