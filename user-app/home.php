<?php
include('db.php');
if (!isset($_SESSION['isLogin'])) {
    header('location:login');
}


?>
<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from themes.pixelstrap.com/pwa/taxify/user-app/home by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 01 Sep 2024 04:36:56 GMT -->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="taxify">
    <meta name="keywords" content="taxify">
    <meta name="author" content="taxify">
    <link rel="manifest" href="manifest.json">
    <link rel="icon" href="../assets/images/logo/favicon.png" type="image/x-icon">
    <title>Ludo Paisa </title>

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


    <!-- swiper css -->
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/swiper-bundle.min.css">

    <!-- Theme css -->
    <link rel="stylesheet" id="change-link" type="text/css" href="../assets/css/style.css">
    <link rel="stylesheet" id="change-link" type="text/css" href="../assets/css/style1.css">
    <style>
        .flag {
            width: 30px;
            height: 30px;
            margin-right: 10px;
        }
    </style>
</head>

<body>
    <!-- header starts -->
    <header id="header" class="main-header">
        <div class="custom-container">
            <div class="header-panel">
                <div class="d-flex align-items-center gap-2">
                    <a href="#offcanvasLeft" data-bs-toggle="offcanvas">
                        <i class="iconsax icon-btn" data-icon="text-align-left"> </i>
                    </a>
                    <img class="img-fluid logo" src="../assets/images/logo/logo.png" alt="logo">
                    <!-- <img class="img-fluid logo-dark" src="../assets/images/logo/logo-dark.png" alt="logo"> -->
                </div>

                <div class="d-flex align-items-center gap-sm-3 gap-2">
                    <a href="chatting">
                        <i class="iconsax icon-btn" data-icon="messages-2"> </i>
                    </a>
                    <a href="notification">
                        <i class="iconsax icon-btn" data-icon="bell-2"> </i>
                    </a>
                </div>
            </div>
        </div>
    </header>
    <!-- header end -->

   

   

    <!-- slider section starts -->
    <section>
        <div class="swiper banner1 home-banner">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img class="img-fluid slider-img w-100" src="../assets/images/slider/slider4.png" alt="slider">
                </div>
                <div class="swiper-slide">
                    <img class="img-fluid slider-img w-100" src="../assets/images/slider/slider4.png" alt="slider">
                </div>
            </div>
        </div>
    </section>
    <!-- slider section ends -->
   

    <!-- offer section starts -->
    <section class="section-b-space">
        <div class="custom-container">
            <div class="title">
                <h3>Play Game</h3>
            </div>
            
            <div class="row gy-3">
            <div class="games-window">
                <?php
                $query = "SELECT * FROM `gamelist`";
                $result = mysqli_query($con, $query);
                while ($row = mysqli_fetch_array($result)) {
                ?>
                   <a class="gameCard-container" href="#">
                    <span class="blink text-primary d-block text-right">◉ LIVE</span>
                    <picture class="gameCard-image">
                        <img width="100%" src="../assets/images/games/firstLudo.png" alt="Classic Ludo">
                    </picture>
                    <div class="gameCard-title">
                        <span class="text-dark d-block text-right">◉ CLASSIC LUDO</span>
                    </div>

                </a>
                <?php
                }
                ?>
                </div>

            </div>
          

        </div>
    </section>
    <!-- offer section end -->

    <!-- panel-space start -->
    <section class="panel-space"></section>
    <!-- panel-space end -->

    <!-- bottom navbar start -->
    <div class="navbar-menu">
        <ul>
            <li class="active">
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

            <li>
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
    <div class="offcanvas sidebar-offcanvas offcanvas-start" tabindex="-1" id="offcanvasLeft">
        <div class="offcanvas-header sidebar-header">
            <div class="sidebar-logo">
                <img class="img-fluid logo" src="../assets/images/logo/logo.png" alt="logo">
                <img class="img-fluid logo-dark" src="../assets/images/logo/logo-dark.png" alt="logo">
            </div>
        </div>
        <div class="offcanvas-body">
            <a href="profile" class="profile-part d-flex align-items-center gap-2">
                <img class="img-fluid profile-pic" src="../assets/images/profile/p8.png" alt="p8">
                <div>
                    <h3>Ashok Matkaplay</h3>
                    <span>Edit Account</span>
                </div>
            </a>

            <a href="#">
                wallet
            </a>
            <ul class="link-section switch-section">
                <li class="active">
                    <a href="home" class="pages">
                        <i class="iconsax sidebar-icon" data-icon="home-2"> </i>
                        <h3>Home</h3>
                    </a>
                </li>
                <li>
                    <a href="history" class="pages">
                        <i class="iconsax sidebar-icon" data-icon="car"> </i>
                        <h3>Account Statement</h3>
                    </a>
                </li>
                <li>
                    <a href="notification" class="pages">
                        <i class="iconsax sidebar-icon" data-icon="bell-2"> </i>
                        <h3>Notification</h3>
                    </a>
                </li>
                <li>
                    <a href="ranking" class="pages">
                        <i class="iconsax sidebar-icon" data-icon="trophy"></i>
                        <h3>Leaderboard</h3>
                    </a>
                </li>

                <li>
                    <a href="setting" class="pages">
                        <i class="iconsax sidebar-icon" data-icon="trophy"></i>
                        <h3>Setting</h3>
                    </a>
                </li>
                <li>
                    <a href="#0" class="pages">
                        <i class="iconsax sidebar-icon" data-icon="book-closed"> </i>
                        <h3>Terms & Condition</h3>
                    </a>
                </li>

                <li>
                    <a href="rates" class="pages">
                        <i class="iconsax sidebar-icon" data-icon="document-text-1"> </i>
                        <h3> Game Rates</h3>
                    </a>
                </li>

                <!-- <li>
                    <div class="pages">
                        <i class="iconsax sidebar-icon" data-icon="brush-3"> </i>
                        <h3>Dark</h3>
                    </div>
                    <div class="switch-btn">
                        <input id="dark-switch" type="checkbox">
                    </div>
                </li> -->

            </ul>

            <div class="bottom-sidebar">
                <a href="login" class="pages">
                    <i class="iconsax sidebar-icon" data-icon="logout-2"> </i>
                    <h3>Logout</h3>
                </a>
            </div>
        </div>
    </div>
    <!-- sidebar end -->

    <!-- iconsax js -->
    <script src="../assets/js/iconsax.js"></script>

    <!-- bootstrap js -->
    <script src="../assets/js/bootstrap.bundle.min.js"></script>

    <!-- sticky-header js -->
    <script src="../assets/js/sticky-header.js"></script>

    <!-- swiper js -->
    <script src="../assets/js/swiper-bundle.min.js"></script>
    <script src="../assets/js/custom-swiper.js"></script>

    <!-- template-setting js -->
    <script src="../assets/js/template-setting.js"></script>

    <!-- script js -->
    <script src="../assets/js/script.js"></script>

    <script>
        function viewChart() {
            var ele = document.getElementsByName('flexRadioDefault');
            for (i = 0; i < ele.length; i++) {
                if (ele[i].checked)
                    window.location.href = ele[i].id;
            }
        }
    </script>
</body>


<!-- Mirrored from themes.pixelstrap.com/pwa/taxify/user-app/home by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 01 Sep 2024 04:37:00 GMT -->

</html>