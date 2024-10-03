<?php
require_once '../db.php';

// Asia/Kolkata timezone 
date_default_timezone_set('Asia/Kolkata');

$user_id = $_SESSION['id']; // Adjust this to your session logic
$query1 = "SELECT * FROM games WHERE (status = 'pending' OR status = 'running') AND created_by = '$user_id'";
$result1 = mysqli_query($con, $query1);

$time_limit = 120; // Time limit in seconds (e.g., 120 seconds)
?>

<ul class="driver-list">
    <?php while ($row1 = mysqli_fetch_assoc($result1)) {
        $game_id = $row1['id'];
        $created_at = strtotime($row1['created_at']);
        $time_remaining = max(0, $time_limit - (time() - $created_at));
        $is_joined = !empty($row1['accepted_by']);
        $accept = $row1['accepted_by'];
        $isjoined = $row1['isJoined'];

        if($is_joined && $isjoined == 1){
            $fetchAcceptorName = "SELECT username FROM users WHERE id = '$accept'";
            $resultAcceptorName = mysqli_query($con, $fetchAcceptorName);
            $rowAcceptorName = mysqli_fetch_assoc($resultAcceptorName);
        }

        if($time_remaining == 0){
            $delete = "DELETE FROM games WHERE id = '$game_id' AND created_by = '$user_id' AND isJoined = 0";
            $result = mysqli_query($con, $delete);
        }

    ?>
        <li>
            <div class="driver-box">
                <div class="profile-head">
                    <div class="d-flex align-items-center gap-2">
                        <img class="img-fluid profile-img" src="../assets/images/profile/p8.png" alt="profile">
                        <?php 
                        if($is_joined && $isjoined == 1){
                            ?>
                        <h5>Accepted by : <span style="color:red"> <?=$rowAcceptorName['username'] ?></span></h5>

                            <?php 
                        }else{
                            ?>
                        <h5>Time Remaining : <span style="color:red"><span id="timer-<?= $game_id; ?>"><?= $time_remaining; ?></span> Second</span></h5>

                            <?php 
                        }
                        ?>
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-between mt-2">
                    <h5 class="fw-normal title-color"><span><img src="https://cdn-icons-png.flaticon.com/512/6828/6828650.png" width="22" alt=""> </span> Entry Fee : <?= $row1['amount']; ?></h5>
                </div>
                <div class="d-flex align-items-center justify-content-between mt-2">
                    <h5 class="fw-normal title-color"><span><img src="https://cdn-icons-png.flaticon.com/512/5984/5984518.png" width="20" alt=""> </span> Prize : <?= $row1['winAmount']; ?></h5>
                </div>

                <?php if ($is_joined && $isjoined == 0) {
                ?>
                    <div class="grid-btn mt-2">
                        <a href="operations/reject_battle.php?battle_id=<?= $game_id; ?>" class="btn btn-danger w-100 m-0">Reject</a>
                        <a href="operations/accept_battle.php?battle_id=<?= $game_id; ?>" class="btn btn-success w-100 m-0">Accept</a>
                    </div>
                <?php
                } elseif($is_joined && $isjoined == 1) {
                ?>
                    <div class="grid-btn mt-2">
                        <a href="room?battle=<?=$game_id?>" class="btn btn-primary w-100 m-0">Enter Room</a>
                    </div>
                <?php
                }else{
                    ?>
                    <div class="grid-btn mt-2">
                        <a href="operations/delete_battle.php?battle_id=<?=$game_id?>" class="btn btn-danger w-100 m-0">Delete</a>
                    </div>
                    <?php 
                }
                ?>

                <div class="progress mt-2" role="progressbar">
                    <div class="progress-bar w-25"></div>
                </div>
            </div>
        </li>
        <hr>
    <?php } ?>
</ul>