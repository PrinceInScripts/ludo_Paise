<?php 


require_once '../db.php';

$data = array("status" => "error", "message" => "An error occured");
$userid = $_SESSION['id'];

if(isset($_POST['amount'])){
    // Amount should be multiple of 10 and greater than 0 

    $amount = $_POST['amount'];
    $userbalance = "SELECT * FROM users WHERE id = '$userid'";
    $userbalance_result = mysqli_query($con, $userbalance);
    $userbalance_row = mysqli_fetch_assoc($userbalance_result);

    $balance = $userbalance_row['deposit_wallet'] + $userbalance_row['withdraw_wallet'];

    if($amount > $balance){
        $data = array("status" => "error", "message" => "You don't have enough balance to create a battle");
        echo json_encode($data);
        exit;
    }

    if($amount == ''){
         $data = array("status" => "error", "message" => "Amount is required");
    }else{
        if($amount % 10 == 0 && $amount > 0){

            // check pending record exist or not 

            $sql = "SELECT * FROM games WHERE is_complete = 0 AND created_by = '$userid'";
            $result = mysqli_query($con, $sql);
            if(mysqli_num_rows($result) > 0){
                $data = array("status" => "error", "message" => "You have already created a battle");
                echo json_encode($data);
                exit;
            }

            $setting = "SELECT * FROM settings WHERE id = 1";
            $setting_result = mysqli_query($con, $setting);
            $setting_row = mysqli_fetch_assoc($setting_result);

            $winningPercentage = 100 - $setting_row['classic_fee'];
            $winAmount = $amount + ($amount * $winningPercentage / 100);
            $battleid = uniqid();

            // games table having id	game_id	game_type	roomcode	amount	winAmount	created_by	accepted_by	created_at	updated_at	status	creator_ss	acceptor_ss	status_reason	room_status	winner	isJoined	
            $sql = "INSERT INTO games (game_id,game_type, amount, winAmount, created_by) VALUES ('$battleid','battle', '$amount', '$winAmount', '$userid')";
            $result = mysqli_query($con, $sql);
            if($result){
                $data = array("status" => "success", "message" => "Battle created successfully", "amount" => $winningPercentage);
            }else{
                $data = array("status" => "error", "message" => "An error occured");
            }
        }else{
            $data = array("status" => "error", "message" => "Amount should be multiple of 10 and greater than 0");
        }
    }

    
}else{
    $data = array("status" => "error", "message" => "Amount is required");

}

echo json_encode($data);
exit;

?>