<?php 
require_once '../db.php';
$user_id = $_SESSION['id'];

if(isset($_POST['battle_id'])){
    
    $battle_id = $_POST['battle_id'];

    $fetch = "SELECT * FROM games WHERE id = '$battle_id' AND created_by = '$user_id' OR accepted_by = '$user_id'";
    $result = mysqli_query($con, $fetch);
    $fetch = mysqli_fetch_assoc($result);

    if (mysqli_num_rows($result) > 0) {
        if($fetch['created_by'] == $user_id){
            // fetch games table
            $getGames = "SELECT * FROM games WHERE id = '$battle_id'";
            $getGamesResult = mysqli_query($con, $getGames);
            $getGamesRow = mysqli_fetch_assoc($getGamesResult);
            $opponent = $getGamesRow['accepted_by'];
            $prize = $getGamesRow['winAmount'];
            $status = 'complete';
            $isComplete = 1;
            $reason = 'Game lost by creator';
            $winner = $opponent;
            $remark = 'Game lost by creator';
            $creator_ss = 'lost';

            // UPDATE `games` SET `id`='[value-1]',`game_id`='[value-2]',`game_type`='[value-3]',`roomcode`='[value-4]',`amount`='[value-5]',`winAmount`='[value-6]',`created_by`='[value-7]',`accepted_by`='[value-8]',`created_at`='[value-9]',`updated_at`='[value-10]',`status`='[value-11]',`is_complete`='[value-12]',`creator_ss`='[value-13]',`acceptor_ss`='[value-14]',`creator_join_ss`='[value-15]',`acceptor_join_ss`='[value-16]',`status_reason`='[value-17]',`room_status`='[value-18]',`winner`='[value-19]',`isJoined`='[value-20]',`remark`='[value-21]' WHERE 1

            $sql = "UPDATE games SET status = '$status', is_complete = '$isComplete', creator_ss = '$creator_ss', status_reason = '$reason', winner = '$winner', remark = '$remark' WHERE id = '$battle_id' AND created_by = '$user_id'";
        }else{
            // fetch games table
            $getGames = "SELECT * FROM games WHERE id = '$battle_id'";
            $getGamesResult = mysqli_query($con, $getGames);
            $getGamesRow = mysqli_fetch_assoc($getGamesResult);
            $opponent = $getGamesRow['created_by'];
            $prize = $getGamesRow['winAmount'];
            $status = 'complete';
            $isComplete = 1;
            $reason = 'Game lost by acceptor';
            $winner = $opponent;
            $remark = 'Game lost by acceptor';
            $acceptor_ss = 'lost';

            $sql = "UPDATE games SET status = '$status', is_complete = '$isComplete', acceptor_ss = '$acceptor_ss', status_reason = '$reason', winner = '$winner', remark = '$remark' WHERE id = '$battle_id' AND accepted_by = '$user_id'";
        }

        $result = mysqli_query($con, $sql);
        if ($result) {
            echo json_encode([['error' => false , 'message' => "You have lost the game."]]);
        } else {
            echo json_encode([['error' => true , 'message' => "An error occured."]]);
        }
    } else {
        echo json_encode([['error' => true , 'message' => "Battle not found or unauthorized access."]]);
    }
} else {
    echo json_encode([['error' => true , 'message' => "Missing battle ID or user ID."]]);
}

?>