<?php 

// url: 'operations/cancelbattle.php',
//           type: 'POST',
//           data: {
//             id: id
//           },


if(isset($_POST['id'])){
    $id = $_POST['id'];
    // fetch game data from database using id 
    $sql = "SELECT * FROM games WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    // update game status to cancelled and refund the amount to both players
    $sql = "UPDATE games SET status = 'cancel', creator_ss = 'cancel' , acceptor_ss = 'cancel', status_reason = 'cancelled by admin', remark = 'cancelled by admin' WHERE id = '$id'";
    mysqli_query($conn, $sql);

    $player1 = $row['created_by'];
    $player2 = $row['accepted_by'];
    $amount = $row['amount'];

    $sql = "UPDATE users SET deposit_wallet = deposit_wallet + '$amount' WHERE id = '$player1'";
    mysqli_query($conn, $sql);

    $sql = "UPDATE users SET deposit_wallet = deposit_wallet + '$amount' WHERE id = '$player2'";
    mysqli_query($conn, $sql);

    // game_record table 

    $sql = "INSERT INTO game_record (game_id, user_id, amount, ProfitAmount, deposit_balance, withdraw_balance, status, remark) VALUES ('$id', '$player1', '$amount', '0', '0', '0', 'game_refund', 'battle cancelled by admin')";
    mysqli_query($conn, $sql);

    $sql = "INSERT INTO game_record (game_id, user_id, amount, ProfitAmount, deposit_balance, withdraw_balance, status, remark) VALUES ('$id', '$player2', '$amount', '0', '0', '0', 'game_refund', 'battle cancelled by admin')";
    mysqli_query($conn, $sql);

    echo json_encode(array("status" => "success"));

}else{
    echo json_encode(array("status" => "failed"));
}
?>