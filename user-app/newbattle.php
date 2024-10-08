<?php

include './db.php';
include('includes/sessions.php');
$user_id = $_SESSION['id'];

?>

<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from themes.pixelstrap.com/pwa/taxify/user-app/add-new-rider.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 01 Sep 2024 04:37:14 GMT -->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="description" content="taxify">
    <meta name="keywords" content="taxify">
    <meta name="author" content="taxify">
    <link rel="manifest" href="manifest.json">
    <link rel="icon" href="../assets/images/logo/favicon.png" type="image/x-icon">
    <title>Matka Play </title>

    <link rel="apple-touch-icon" href="../assets/images/logo/favicon.png">
    <meta name="title-color" content="#01AA85">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="taxify">
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

    <style>
        .challenges-container {
            display: flex;
            justify-content: space-around;
            align-items: center;
            padding: 40px 20px;
            margin: 10px 0;
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
                <div id="opponent-battle" class="driver-request">
    <ul class="driver-list">
        <!-- Opponent battles will be loaded here via Ajax -->
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
                    <div class="">
                        <ul class="driver-list">

                            <?php

                            $query2 = "SELECT * FROM games WHERE status = 'running' AND created_by = '$user_id'";
                            $result2 = mysqli_query($con, $query2);
                            while ($row2 = mysqli_fetch_assoc($result2)) {
                            ?>
                                <li>
                                    <div class="driver-box">
                                        <div class="profile-head">
                                            <div class="d-flex align-items-center gap-2">
                                                <img class="img-fluid profile-img" src="../assets/images/profile/p8.png" alt="profile">
                                                <h5>Challange From <span style="color:red">xgTDD</span></h5>
                                            </div>
                                            <h4 class="fw-semibold theme-color">

                                            </h4>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mt-2">
                                            <h5 class="fw-normal title-color"><span><img src="https://cdn-icons-png.flaticon.com/512/6828/6828650.png" width="22" alt=""> </span> Entry Fee : </h5>

                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mt-2">
                                            <h5 class="fw-normal title-color"><span><img src="https://cdn-icons-png.flaticon.com/512/5984/5984518.png" width="20" alt=""> </span> Prize : </h5>

                                        </div>

                                        <div class="grid-btn mt-2">
                                            <a href="accept-ride-details.html" class="btn btn-secondary w-100 m-0">Play</a>
                                        </div>
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

                <hr>
                <div>

                </div>
            </div>


        </div>





    </section>
    <!-- new rider section end -->

    <!-- panel-space start -->
    <section class="panel-space"></section>
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

// Initial call to load opponent battles
fetchOpponentBattles();

// Set an interval to update opponent battles every second
setInterval(fetchOpponentBattles, 1000);
</script>

</body>


<!-- Mirrored from themes.pixelstrap.com/pwa/taxify/user-app/add-new-rider.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 01 Sep 2024 04:37:14 GMT -->

</html>