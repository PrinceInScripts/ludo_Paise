<?php 

require_once '../db.php';
$user_id = $_SESSION['id'];
// fetch balance of user 


if(isset($_GET['battle_id'])){
    $battle_id = $_GET['battle_id'];

    $fetchBalance = "SELECT * FROM users WHERE id = '$user_id'";
$fetchBalanceResult = mysqli_query($con, $fetchBalance);
$fetchBalanceRow = mysqli_fetch_assoc($fetchBalanceResult);
$balance = $fetchBalanceRow['withdraw_wallet'] + $fetchBalanceRow['deposit_wallet'];

    // first check battle exits or not, if exist set $user_id to accepted_by field 
    $sql = "SELECT * FROM games WHERE id = '$battle_id' AND status = 'pending'";
    $result = mysqli_query($con, $sql);
    $fetch = mysqli_fetch_assoc($result);
    $created_by = $fetch['created_by'];
    $joining_fee = $fetch['amount'];

    if($balance >= $joining_fee){
        if(mysqli_num_rows($result) > 0 && $created_by != $user_id){
            $sql = "UPDATE games SET accepted_by = '$user_id', requested_at = current_timestamp() WHERE id = '$battle_id'";
            $result = mysqli_query($con, $sql);
            if($result){
                
                header('Location: ../newbattle.php');
                    exit();
                
            }else{
                $title = "Error";
                $error = "An error occured";
            }
        }else{
            $title = "Error";
            $error =  "Battle not found";
        }
    }else{
        $title = "Insufficient balance";
        $error = "Add money to wallet";
    }

    

    
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <style>
        body{
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* background for alter message  */

        .swal-overlay {
            background-color: rgba(0, 0, 0, 0.6);
        }

        .swal-modal {
            width: 400px;
            background-color: #fff;
            border-radius: 10px;
        }

        .swal-title {
            padding: 20px 0;
            font-size: 24px;
            font-weight: 600;
            color: #333;
        }

        .swal-text {
            padding: 0 20px;
            font-size: 18px;
            color: #333;
        }

        .swal-button {
            padding: 10px 20px;
            font-size: 18px;
            font-weight: 600;
            color: #fff;
            background-color: #333;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .swal-button:hover {
            background-color: #555;
        }


    </style>
</head>
<body>
    <!-- swal fire alert message here  -->
    <?php 
    if(isset($error)){
        ?>
        <script>
            // clear this page from back history after swal fire message

            swal({
                title: "<?php echo $title; ?>",
                text: "<?php echo $error; ?>",
                icon: "error",
                button: "Ok",
            }).then(function() {
                window.location = "../payment";
                // history null state 
                window.history.pushState(null, "", "../newbattle");
            });
            
        </script>
        <?php 
    }
    ?>

</body>
</html>