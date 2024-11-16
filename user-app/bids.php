<?php
include('db.php');
include('includes/sessions.php');

$user_id = $_SESSION['id'];
?>
<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from themes.pixelstrap.com/pwa/taxify/user-app/finding-driver by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 01 Sep 2024 04:37:12 GMT -->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="taxify">
    <meta name="keywords" content="taxify">
    <meta name="author" content="taxify">
    <link rel="manifest" href="manifest.json">
    <link rel="icon" href="../assets/images/logo/favicon.png" type="image/x-icon">
    <title>Ludopaisa </title>

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

</head>

<body>
    <!-- header starts -->
    <header id="header" class="main-header inner-page-header">
        <div class="custom-container">
            <div class="header-panel">
                <a href="#offcanvasLeft" data-bs-toggle="offcanvas">
                    <i class="iconsax icon-btn" data-icon="text-align-left"> </i>
                </a>
                <h3>All Bids</h3>
            </div>
        </div>
    </header>
    <!-- header end -->

    <!-- note section starts -->
    <section class="pt-3">
        <div class="custom-container">
            <div class="poster-part">
                <p class="fw-normal text-white">Success is not just about winning, it's about learning from every result—whether you win or lose, the game continues.</p>
            </div>
        </div>
    </section>
    <!-- note section end -->

    <!-- finding driver list starts -->
    <section class="driver-request section-b-space">
        <div class="custom-container">
            <ul class="driver-list">
                <?php

                $sql = "SELECT * FROM game_record WHERE user_id = '$user_id' AND status != 'game_join' ORDER BY id DESC";
                $result = $con->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        // fetch battle id 
                        $sql = "SELECT game_id FROM games WHERE id = '" . $row['game_id'] . "'";
                        $result2 = $con->query($sql);
                        $row2 = $result2->fetch_assoc();
                        $gid = $row['game_id'];
                        $row['game_id'] = $row2['game_id'];
                        
                ?>
                        <li>
                            <div class="driver-box outstation-driver-box">
                                <div class="profile-head">
                                    <div class="d-flex align-items-center gap-2">
                                        <img class="img-fluid profile-img" src="https://cdn-icons-png.flaticon.com/512/10490/10490256.png" alt="profile">
                                        <h5>Ludo Classic</h5>
                                    </div>
                                    <?php
                                    if ($row['status'] == 'game_join') {
                                    ?>
                                        <h4 class="fw-semibold navbar-expand error-color">
                                            - ₹<?= $row['ProfitAmount'] ?>
                                        </h4>
                                    <?php
                                    } elseif ($row['status'] == 'won') {
                                    ?>
                                        <h4 class="fw-semibold navbar-expand success-color">
                                            + ₹<?= $row['ProfitAmount'] ?>
                                        </h4>
                                    <?php
                                    }elseif($row['status'] == 'lost'){
                                        ?>
                                        <h4 class="fw-semibold navbar-expand error-color">
                                            - ₹<?= $row['ProfitAmount'] ?>
                                        </h4>
                                    <?php
                                    }elseif($row['status'] == 'game_refund'){
                                        ?>
                                        <h4 class="fw-semibold navbar-expand error-color">
                                            - ₹<?= $row['amount'] ?>
                                        </h4>
                                    <?php
                                    }
                                    ?>

                                    <!-- <h4 class="fw-semibold navbar-expand secondary-color">
                                            - 100 (Pending)
                                        </h4>
                                   
                                        <h4 class="fw-semibold navbar-expand error-color">
                                           - 100
                                        </h4> -->


                                </div>

                                <div class="d-flex align-items-center justify-content-between flex-wrap gap-1 mt-2">
                                    <h5 class="fw-normal title-color">Battle ID : <span id="gameid" class="content-color fw-normal"><?= $row['game_id'] ?></span> <img onclick="copyb()" src="https://cdn-icons-png.flaticon.com/512/54/54702.png" alt="" width="15"> </h5>


                                    <div class="d-flex align-items-start gap-1">
                                        <img class="clock" src="https://themes.pixelstrap.com/pwa/taxify/assets/images/svg/clock-circle.svg" alt="clock">
                                        <h6 class="fw-normal lh-base content-color"><?= $row['created_at'] ?></h6>
                                    </div>
                                </div>

                                <div class="d-flex align-items-center justify-content-between mt-2">
                                    <div class="d-flex align-items-center gap-1">
                                        <h5 class="fw-normal title-color">Remark : </h5>
                                        <span class="content-color fw-normal">
                                            <?php
                                            if ($row['status'] == 'game_join') {
                                                echo 'Balance Deducted for Joining Game';
                                            } else {
                                                echo $row['status'];
                                            }
                                            ?>
                                        </span>
                                    </div>
                                    <div class="d-flex align-items-start gap-1">
                                        <img class="clock" src="https://cdn-icons-png.flaticon.com/128/17401/17401872.png" alt="roomcode">
                                        <h6 class="fw-normal lh-base content-color">
                                            <?php 
                                            $fetchRoom = "SELECT roomcode FROM games WHERE game_id = '".$row['game_id']."' ";
                                            $resultRoom = $con->query($fetchRoom);
                                            $room = $resultRoom->fetch_assoc();

                                            if($room['roomcode'] != '') {
                                                echo 'Room Code : '.$room['roomcode'];
                                            } else {
                                                echo 'Room Code : Not Available';
                                            }
                                            ?>
                                        </h6>
                                    </div>
                                </div>
                                <div class="grid-btn mt-2">
                                <!-- <a href="room?battle= -->
                                <?php 
                                // echo $gid;
                                 ?>
                                <!-- " class="btn theme-btn w-100 m-0">View Room</a> -->
                                    
                                </div>

                                <div class="grid-btn mt-2">
                                    <?php
                                    if ($row['status'] == 'game_join') {
                                    ?>
                                        <a href="#0" class="btn btn-danger w-100 m-0">Game Joined</a>
                                    <?php
                                    } elseif($row['status'] == 'won'){
                                    ?>
                                        <a href="#0" class="btn btn-success w-100 m-0">You Won</a>
                                    <?php
                                    } elseif($row['status'] == 'lost'){
                                    ?>
                                        <a href="#0" class="btn btn-danger w-100 m-0">You Lost</a>
                                    <?php
                                    }
                                    ?>
                                    <a href="room?battle=<?=$gid ?>" class="btn theme-btn w-100 m-0">View Room</a>
                                </div>
                                
                            </div>
                        </li>
                    <?php
                    }
                } else {
                    ?>
                    <section class="pt-0 section-b-space">
                        <div class="empty-images me-4">
                            <img class="img-fluid empty-icon" src="https://themes.pixelstrap.com/pwa/taxify/assets/images/notification.svg" alt="notification">
                        </div>

                        <div class="custom-container">
                            <div class="empty-page-content">
                                <h3>Nothing here !!</h3>
                                <p>Click the "Refresh" button down below to check again for something amazing.</p>
                            </div>
                        </div>
                        <div class="fixed-btn">
                            <div class="custom-container">
                                <a href="notification" class="btn theme-btn w-100">Refresh</a>
                            </div>
                        </div>
                    </section>
                <?php
                }
                ?>





            </ul>
        </div>
    </section>

    <!-- panel-space start -->
    <section class="panel-space"></section>
    <!-- panel-space end -->

    <!-- bottom navbar start -->
    <div class="navbar-menu">
        <ul>
            <li>
                <a href="home">
                    <div class="icon">
                        <img class="unactive" src="https://themes.pixelstrap.com/pwa/taxify/assets/images/svg/home.svg" alt="home">
                        <img class="active" src="https://themes.pixelstrap.com/pwa/taxify/assets/images/svg/home-fill.svg" alt="home">
                    </div>
                    <span class="active">Home</span>
                </a>
            </li>

            <li>
                <a href="wallet">
                    <div class="icon">
                        <img style="width:25px" class="unactive" src="https://cdn-icons-png.flaticon.com/512/482/482541.png" alt="category">
                        <img style="width:25px" class="active" src="https://cdn-icons-png.flaticon.com/512/60/60484.png" alt="category">
                    </div>
                    <span>Wallet</span>
                </a>
            </li>

            <li>
                <a href="setting">
                    <div class="icon">
                        <img style="width:25px" class="unactive" src="https://cdn-icons-png.flaticon.com/512/2040/2040504.png" alt="car">
                        <img style="width:25px" class="active" src="https://cdn-icons-png.flaticon.com/512/3524/3524659.png" alt="car">
                    </div>
                    <span>Setting</span>
                </a>
            </li>

            <li class="active">
                <a href="bids">
                    <div class="icon">
                        <img style="width:25px" class="unactive" src="https://cdn-icons-png.flaticon.com/512/783/783196.png" alt="car">
                        <img style="width:25px" class="active" src="https://cdn-icons-png.flaticon.com/512/2639/2639683.png" alt="car">
                    </div>
                    <span>All Bids</span>
                </a>
            </li>


            <li>
                <a href="history">
                    <div class="icon">
                        <img style="width:25px" class="unactive" src="https://cdn-icons-png.flaticon.com/512/1157/1157077.png" alt="setting">
                        <img style="width:25px" class="active" src="https://cdn-icons-png.flaticon.com/128/149/149880.png" alt="setting">
                    </div>
                    <span>History</span>
                </a>
            </li>
        </ul>
    </div>
    <!-- bottom navbar end -->

    <!-- sidebar starts -->
    <?php include_once('includes/sidebar.php') ?>
    <!-- sidebar end -->

    <!-- finding driver list end -->

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

    <!-- swal fire js  -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
        function copyb() {
            // Get the text from the span element
            var gameID = document.getElementById("gameid").innerText;

            // Create a temporary input element to hold the text
            var tempInput = document.createElement("input");
            tempInput.value = gameID;
            document.body.appendChild(tempInput);

            // Select the text inside the input and copy it
            tempInput.select();
            tempInput.setSelectionRange(0, 99999); // For mobile devices
            document.execCommand("copy");

            // Remove the temporary input element
            document.body.removeChild(tempInput);

            // Optionally, show an alert or message to confirm copy
            swal.fire({
                title: 'Copied',
                text: 'Game ID copied to clipboard',
                icon: 'success',
                confirmButtonText: 'Ok'
            });
        }
    </script>
</body>


<!-- Mirrored from themes.pixelstrap.com/pwa/taxify/user-app/finding-driver by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 01 Sep 2024 04:37:12 GMT -->

</html>