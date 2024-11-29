<?php

include './db.php';
include('includes/sessions.php');
$user_id = $_SESSION['id'];

$query = "SELECT * FROM users WHERE id = '$user_id'";
$run = mysqli_query($con, $query);
$data = mysqli_fetch_assoc($run);
$wallet = $data['deposit_wallet'] + $data['withdraw_wallet'];

?>

<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from themes.pixelstrap.com/pwa/taxify/user-app/add-new-rider.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 01 Sep 2024 04:37:14 GMT -->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="description" content="ludopaisa">
    <meta name="keywords" content="ludopaisa">
    <meta name="author" content="ludopaisa">
    <link rel="manifest" href="manifest.json">
    <link rel="icon" href="../assets/images/logo/favicon.png" type="image/x-icon">
    <title>Ludo Paisa </title>

    <link rel="apple-touch-icon" href="../assets/images/logo/favicon.png">
    <meta name="title-color" content="#01AA85">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="ludopaisa">
    <meta name="msapplication-TileImage" content="../assets/images/logo/favicon.png">

    <meta name="msapplication-TileColor" content="#FFFFFF">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!--Google font-->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100;200;300;400;500;600;700;800;900&amp;display=swap"
        rel="stylesheet">

    <!-- iconsax css -->
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/iconsax.css">

    <!-- bootstrap css -->
    <link rel="stylesheet" id="rtl-link" type="text/css" href="../assets/css/vendors/bootstrap.css">


    <!-- Theme css -->
    <link rel="stylesheet" id="change-link" type="text/css" href="../assets/css/style.css">
    <link rel="stylesheet" id="change-link" type="text/css" href="../assets/css/style2.css">

    <script src="https://kit.fontawesome.com/734dee5206.js" crossorigin="anonymous"></script>


    <style>
        .Wfloat {
            position: fixed;
            width: 50px;
            height: 50px;
            bottom: 110px;
            right: 20px;
            background-color: #25d366;
            color: #FFF;
            border-radius: 50px;
            text-align: center;
            font-size: 30px;
            box-shadow: 2px 2px 3px #999;
            z-index: 10000;
        }

        .myW-float {
            margin-top: 11px;
        }
    </style>

    <style>
        section,
        .section-t-space {
            padding-top: 2px;
        }

        .driver-request .driver-list li .driver-box {
            padding: 0 12px;
        }

        .challenges-container {
            display: flex;
            justify-content: space-around;
            align-items: center;
            padding: 0 20px;
        }

        .challenges {
            display: flex;
            flex-direction: column;
            justify-content: center;
            gap: 5px;
            margin-bottom: 20px;
        }

        .finding-player {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .timer-container {
            display: flex;
            flex-direction: column;
            font-size: 1em;
            margin-bottom: 20px;
            gap: 10px;
        }

        .loading-spinner {
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-top-color: #000;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin-right: 10px;
        }

        .profile-pic {
            display: block;
            margin: auto;
            border-radius: 100%;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .driver-request .driver-list {
            padding: 0;
        }

        .driver-request .driver-list li {
            padding-top: 8px;
        }

        /* Running Battle Start  */

        .driver-request .driver-list li .driver-box .profile-head .profile-img {
            width: 25px;
            height: 25px;

        }

        /* Running Battle End  */
    </style>
</head>

<body>
    <!-- header starts -->
    <header id="header" class="main-header inner-page-header">
        <div class="custom-container">
            <div class="header-panel">
                <a href="home.php">
                    <i class="iconsax icon-btn" data-icon="chevron-left"> </i>
                </a>

                <h3 class="fw-semibold title-color">Ludo Classic</h3>

                <a href="payment">
                    <div class="add-cash-button">
                        <div class="add-cash-content">
                            <p>Add cash</p>
                            <p>₹<?php echo $wallet ?> </p>
                        </div>
                        <div class="add-cash-circle">
                            +
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </header>
    <!-- header end -->

    <!-- new rider section start -->
    <section class="section-b-space">
        <div class="custom-container">
            <div class="theme-form ">
                <div class="grid-btn mt-4">
                    <a href="#0" class="btn theme-btn w-100 m-0">Create New Battle</a>
                </div>
                <!-- <p class="fw-normal content-color">Your device's address book will not contain this contact. </p> -->

                <div>
                    <div class="form-group">
                        <label class="form-label mb-2" for="amount">Enter Amount</label>
                        <input type="text" class="form-control" id="amount" placeholder="Amount should be multiple of 10">

                    </div>
                    <div class="grid-btn mt-4 col-6 mx-auto">
                        <button onclick="create_battle()" class="btn btn-success w-100 m-0">Create Battle</button>
                    </div>
                </div>
                <hr>
                <div>

                </div>
            </div>
            <div id="self-battle" class="driver-request">
                <ul class="driver-list">
                    <!-- Battle list loaded here via Ajax -->
                </ul>
            </div>

            <div class="theme-form ">
                <div class="grid-btn mt-4">
                    <button class="btn theme-btn w-100 m-0">Open Battle</button>
                </div>
                <!-- <p class="fw-normal content-color">Your device's address book will not contain this contact. </p> -->

                <section class="pt-0 driver-request">



                    <div id="opponent-battle" class="">
                        <ul class="driver-list">
                            <?php


                            // Query to fetch battles created by opponents
                            $sql = "SELECT * FROM games WHERE status = 'running' AND created_by != '$user_id' ORDER BY id DESC";
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
                                                <h5>Challenge From <span style="color:red">
                                                        <?php
                                                        $str = $rowName['username'];

                                                        if (strlen($str) > 10) {
                                                            $shortened = $str[0] . str_repeat('*', 6) . $str[strlen($str) - 1];
                                                            echo $shortened;
                                                        } else {
                                                            echo $str; // If the string is 10 characters or less, show it as is
                                                        }
                                                        ?>

                                                    </span></h5>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mt-2">
                                            <h5 class="fw-normal title-color"><span><img src="https://cdn-icons-png.flaticon.com/512/6828/6828650.png" width="22" alt=""> </span> Entry Fee: <?= $row['amount'] ?></h5>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mt-2">
                                            <h5 class="fw-normal title-color"><span><img src="https://cdn-icons-png.flaticon.com/512/5984/5984518.png" width="20" alt=""> </span> Prize: <?= $row['winAmount'] ?></h5>
                                        </div>
                                        <?php
                                        if ($row['accepted_by'] == $user_id && $row['isJoined'] == 0) {
                                        ?>
                                            <div class="grid-btn mt-2">
                                                <a href="#0" class="btn btn-secondary w-100 m-0">Waiting...</a>
                                            </div>
                                        <?php
                                        } elseif ($row['accepted_by'] == $user_id && $row['isJoined'] == 1) {
                                        ?>
                                            <div class="grid-btn mt-2">
                                                <a href="room?battle=<?= $game_id ?>" class="btn btn-primary w-100 m-0">Enter Room</a>
                                            </div>
                                        <?php
                                        } else {
                                        ?>
                                            <div class="grid-btn mt-2">
                                                <a href="operations/request_battle.php?battle_id=<?= $game_id ?>" class="btn btn-secondary w-100 m-0">Play</a>
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

                </section>


                <div>

                </div>
            </div>

            <!-- Running Battle  -->

            <div class="theme-form ">
                <div class="grid-btn mt-4">
                    <a href="#0" class="btn theme-btn w-100 m-0">Running Battle</a>
                </div>
                <!-- <p class="fw-normal content-color">Your device's address book will not contain this contact. </p> -->

                <section class="pt-0 driver-request">
                    <div id="running-battle" class="pt-2">
                        <ul class="driver-list">

                            <?php

                            $query2 = "SELECT * FROM games WHERE status = 'running'";
                            $result2 = mysqli_query($con, $query2);
                            while ($row2 = mysqli_fetch_assoc($result2)) {
                            ?>
                                <li>
                                    <div class="driver-box">
                                        <?php
                                        $challenger_username = $row2['created_by'];
                                        $getName  = "SELECT * FROM users WHERE id = '$challenger_username'";
                                        $resultName = mysqli_query($con, $getName);
                                        $rowName = mysqli_fetch_assoc($resultName);
                                        ?>
                                        <div class="profile-head">
                                            <div class="d-flex align-items-center gap-2">
                                                <img class="img-fluid profile-img" src="https://cdn-icons-png.flaticon.com/512/3637/3637532.png" alt="profile">
                                                <h5>Challenge From <span style="color:green">
                                                <?php
                                                        $str = $rowName['username'];

                                                        if (strlen($str) > 10) {
                                                            $shortened = $str[0] . str_repeat('*', 6) . $str[strlen($str) - 1];
                                                            echo $shortened;
                                                        } else {
                                                            echo $str; // If the string is 10 characters or less, show it as is
                                                        }
                                                        ?>
                                                </span></h5>
                                            </div>
                                            <h4 class="fw-semibold theme-color">

                                            </h4>
                                        </div>
                                        <section class="challenge-section">
                                            <div class="challenges-container">
                                                <div class="challenges ">

                                                    <img id="output" width="40px" class="profile-pic" src="../assets/images/profile/p<?= $rowName['profile_pic'] ?>.png" alt="p<?= $rowName['profile_pic'] ?>">
                                                    <p>
                                                    <?php
                                                        $str = $rowName['username'];

                                                        if (strlen($str) > 10) {
                                                            $shortened = $str[0] . str_repeat('*', 6) . $str[strlen($str) - 1];
                                                            echo $shortened;
                                                        } else {
                                                            echo $str; // If the string is 10 characters or less, show it as is
                                                        }
                                                        ?>
                                                    </p>

                                                </div>
                                                <div class="timer-container">
                                                    <img id="output" width="60px" class="profile-pic" src="../assets/images/product/vs.png" alt="p8">
                                                    <p>Prize : <?= $row2['winAmount'] ?></p>
                                                </div>

                                                <div class="challenges ">
                                                    <?php
                                                    $acceptor_username = $row2['accepted_by'];
                                                    $getName  = "SELECT * FROM users WHERE id = '$acceptor_username'";
                                                    $resultName = mysqli_query($con, $getName);
                                                    $rowName = mysqli_fetch_assoc($resultName);
                                                    ?>
                                                    <img id="output" width="40px" class="profile-pic" src="../assets/images/profile/p<?= $rowName['profile_pic'] ?>.png" alt="p<?= $rowName['profile_pic'] ?>">
                                                    <p>
                                                    <?php
                                                        $str = $rowName['username'];

                                                        if (strlen($str) > 10) {
                                                            $shortened = $str[0] . str_repeat('*', 6) . $str[strlen($str) - 1];
                                                            echo $shortened;
                                                        } else {
                                                            echo $str; // If the string is 10 characters or less, show it as is
                                                        }
                                                        ?>
                                                    </p>

                                                </div>
                                            </div>
                                        </section>
                                    </div>
                                </li>
                                <hr>
                            <?php
                            }

                            ?>


                        </ul>
                    </div>
                </section>


                <div>

                </div>
            </div>


        </div>





    </section>
    <!-- new rider section end -->

    <!-- panel-space start -->
    <section class="panel-space"></section>


    <a href="https://api.whatsapp.com/send?phone=917042536431" class="Wfloat" target="_blank">
        <i class="fa fa-whatsapp myW-float" aria-hidden="true"></i>
    </a>
    <!-- panel-space end -->

    <!-- iconsax js -->
    <script src="../assets/js/iconsax.js"></script>

    <!-- sticky-header js -->
    <script src="../assets/js/sticky-header.js"></script>

    <!-- bootstrap js -->
    <script src="../assets/js/bootstrap.bundle.min.js"></script>

    <!-- template-setting js -->
    <script src="../assets/js/template-setting.js"></script>

    <!-- script js -->
    <script src="../assets/js/script.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        // Create Battle operations/create_battle.php using Ajax 

        function create_battle() {
            var amount = document.getElementById('amount').value;

            $.ajax({
                url: 'operations/create_battle.php',
                type: 'POST',
                data: {
                    amount: amount
                },
                success: function(data) {

                    console.log(data);
                    var response = JSON.parse(data);
                    if (response.status == 'success') {
                        // if success refresh page with swal message 
                        swal.fire('Success', response.message, 'success');
                    } else {
                        swal.fire('Error', response.message, 'error');
                    }

                }
            });
        }
    </script>


    <script>
        // Function to update countdown timers
        function updateTimers() {
            $('.driver-list li').each(function() {
                var timerElement = $(this).find('[id^=timer-]');
                var currentTime = parseInt(timerElement.text());

                if (currentTime > 0) {
                    timerElement.text(currentTime - 1); // Decrement the timer by 1 second
                }
            });
        }

        // Function to reload the battle list every 5 seconds
        function reloadBattleList() {
            $.ajax({
                url: 'operations/reload_battle.php', // The PHP file that generates the battle list
                type: 'GET',
                success: function(data) {
                    $('#self-battle .driver-list').html(data); // Update the battle list
                }
            });
        }

        // Set the countdown to run every second
        setInterval(updateTimers, 1000);

        // Set the Ajax reload to run every 5 seconds
        setInterval(reloadBattleList, 1000);


        function fetchOpponentBattles() {
            $.ajax({
                url: 'operations/fetch_opponent_battles.php', // Change to your endpoint
                type: 'GET',
                success: function(data) {
                    $('#opponent-battle .driver-list').html(data);
                },
                error: function() {
                    console.error('Failed to fetch opponent battles.');
                }
            });
        }

        function fetchRunningBattles() {
            $.ajax({
                url: 'operations/fetch_running_battles.php', // Change to your endpoint
                type: 'GET',
                success: function(data) {
                    $('#running-battle .driver-list').html(data);
                },
                error: function() {
                    console.error('Failed to fetch opponent battles.');
                }
            });
        }

        // Initial call to load opponent battles
        fetchOpponentBattles();
        fetchRunningBattles();

        // Set an interval to update opponent battles every second
        setInterval(fetchOpponentBattles, 1000);
        setInterval(fetchRunningBattles, 1000);
    </script>

</body>


<!-- Mirrored from themes.pixelstrap.com/pwa/taxify/user-app/add-new-rider.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 01 Sep 2024 04:37:14 GMT -->

</html>