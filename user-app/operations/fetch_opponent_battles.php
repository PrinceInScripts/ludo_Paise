


<div id="opponent-battle" class="">
    <ul class="driver-list">
        <?php

        require_once '../db.php';
        // Asia/Kolkata timezone 
date_default_timezone_set('Asia/Kolkata');

$user_id = $_SESSION['id'];
        // Query to fetch battles created by opponents
        $sql = "SELECT * FROM games WHERE (status = 'pending' OR status = 'running') AND created_by != '$user_id'";
        $result = mysqli_query($con, $sql);
        $time_limit = 120; // Time limit in seconds

        while ($row = mysqli_fetch_assoc($result)) {
            $game_id = $row['id'];
            $created_at = strtotime($row['created_at']); // Get the creation time
            $current_time = time(); // Get current server time
            $time_remaining = max(0, $time_limit - ($current_time - $created_at)); // Remaining time in seconds

            // If time_remaining is more than the limit, set it to 0
            if ($time_remaining <= 0) {
                $time_remaining = 0;
            }

            // Assuming you have a field in your database to identify the challenge sender
            $challenger_username = $row['created_by'];
            $getName  = "SELECT username FROM users WHERE id = '$challenger_username'";
            $resultName = mysqli_query($con, $getName);
            $rowName = mysqli_fetch_assoc($resultName);

             // Change this as per your database field
        ?>
            <li>
                <div class="driver-box">
                    <div class="profile-head">
                        <div class="d-flex align-items-center gap-2">
                            <img class="img-fluid profile-img" src="../assets/images/profile/p8.png" alt="profile">
                            <h5>Challenge From <span style="color:red"><?= $rowName['username'] ?></span></h5>
                        </div>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mt-2">
                        <h5 class="fw-normal title-color"><span><img src="https://cdn-icons-png.flaticon.com/512/6828/6828650.png" width="22" alt=""> </span> Entry Fee: <?=$row['amount'] ?></h5>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mt-2">
                        <h5 class="fw-normal title-color"><span><img src="https://cdn-icons-png.flaticon.com/512/5984/5984518.png" width="20" alt=""> </span> Prize: <?=$row['winAmount'] ?></h5>
                    </div>
                    <?php 
                    if($row['accepted_by'] == $user_id && $row['isJoined'] == 0){
                        ?>
                        <div class="grid-btn mt-2">
                        <a href="#0" class="btn btn-secondary w-100 m-0">Waiting...</a>
                    </div>
                        <?php 
                    }elseif($row['accepted_by'] == $user_id && $row['isJoined'] == 1){
                        ?>
                        <div class="grid-btn mt-2">
                        <a href="#0" class="btn btn-primary w-100 m-0">Enter Room</a>
                    </div>
                        <?php 
                    }else{
                        ?>
                        <div class="grid-btn mt-2">
                        <a href="operations/request_battle.php?battle_id=<?=$game_id?>" class="btn btn-secondary w-100 m-0">Play</a>
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
        <?php
        }
        ?>
    </ul>
</div>
