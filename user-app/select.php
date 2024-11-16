<?php
include 'db.php';
include('includes/sessions.php');
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM `gamelists` WHERE `id` = $id";
    $result = mysqli_query($con, $sql);
    $gamedata = mysqli_fetch_assoc($result);
} else {
    header('location:home');
}
?>
<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from themes.pixelstrap.com/pwa/taxify/user-app/rental-vehicle-details by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 01 Sep 2024 04:37:14 GMT -->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="ludopaisa">
    <meta name="keywords" content="ludopaisa">
    <meta name="author" content="ludopaisa">
    <link rel="manifest" href="manifest.json">
    <link rel="icon" href="../assets/images/logo/favicon.png" type="image/x-icon">
    <title>Ludopaisa </title>

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
    <style>
        .wallet-amount {
            font-size: 2.5rem;
            text-align: center;
            padding: 14px;
        }

        .card {
            display: block;
            margin: auto;
            width: 45%;
            /* height: 100px; */
            aspect-ratio: 1/1;
            border-radius: 10px;
            background: #e0e0e0;
            box-shadow: 15px 15px 30px #bebebe,
                -15px -15px 30px #ffffff;
        }

        .card img{
            width: 60%;
            display: block;
            margin: 9% auto;
        }

        .card p {
            text-align: center;
            font-size: 1rem;
            font-weight: 600;
        }

        .game-container {
            display: flex;
            justify-content: space-around;
            margin-top: 30px;
        }


    </style>
</head>

<body>
    <!-- header starts -->
    <header id="header" class="main-header inner-page-header">
        <div class="custom-container">
            <div class="header-panel">
                <a href="home">
                    <i class="iconsax icon-btn" data-icon="chevron-left"> </i>
                </a>

                <h3 class="fw-semibold title-color"><?= $gamedata['title'] ?></h3>
            </div>
        </div>
    </header>
    <!-- header end -->
    <section class="driver-request section-b-space">
        <div class="game-container">
            <div class="card">
                <img src="https://cdn-icons-png.flaticon.com/512/12907/12907708.png" alt="">
                <p>Single Digit</p>
            </div>
            <div class="card">
                <img src="https://cdn-icons-png.flaticon.com/512/12907/12907880.png" alt="">
                <p>Jodi Digit</p>
            </div>
        </div>
        <div class="game-container">
            <div class="card">
                <img src="https://cdn-icons-png.flaticon.com/512/8176/8176145.png" alt="">
                <p>Single Pana</p>
            </div>
            <div class="card">
                <img src="https://cdn-icons-png.flaticon.com/512/5537/5537635.png" alt="">
                <p>Double Pana</p>
            </div>
        </div>
        <div class="game-container">
            <div class="card">
                <img src="https://cdn-icons-png.flaticon.com/512/8027/8027940.png" alt="">
                <p>Triple Pana</p>
            </div>
        </div>
    </section>
    <!-- vehicle details section starts -->
    <section class="section-b-space">

        <div class="vehicle-content">
            <div class="content-title">
                <h4 class="fw-semibold title-color">Withdrawal Notice</h4>
                <div class="d-flex align-items-center gap-1">
                    <img class="img-fluid members" src="https://themes.pixelstrap.com/pwa/taxify/assets/images/svg/profile-fill.svg" alt="profile">
                    <h5 class="fw-medium title-color">8</h5>
                </div>
            </div>
            <ul class="details-list">
                <li>
                    <h5>9:00 am to 11:00 am</h5>
                    <h6>Withdraw within the time limit.</h6>
                </li>
                <li>
                    <h5>2 Withdrawal per day</h5>
                    <h6>You can only place 2 Withdrawal in a day</h6>
                </li>
            </ul>

        </div>
        <div class="condition-part">
            <h4 class="fw-semibold title-color">Policies & fees</h4>
            <ul class="condition-list">
                <li>
                    <h5>Tolls and surcharges</h5>
                    <p>Any additional charges will be billed after your deposit is completed.</p>
                </li>
                <li>
                    <h5>Non refundable fare</h5>
                    <p>You’ll be charged the full upfront amount even if your bids is against the result</p>
                </li>
            </ul>
        </div>
    </section>
    <!-- vehicle details section end -->



  
    <!-- sidebar end -->

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
</body>


<!-- Mirrored from themes.pixelstrap.com/pwa/taxify/user-app/rental-vehicle-details by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 01 Sep 2024 04:37:14 GMT -->

</html>