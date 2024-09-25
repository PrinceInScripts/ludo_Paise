<?php
include('db.php');
if(!isset($_SESSION['isLogin'])){
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
        .flag{
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

        <!-- Change language offcanvas starts -->
        <div class="offcanvas ride-offcanvas p-0" tabindex="-1" id="language">
        <div class="offcanvas-header pb-0">
            <h3>Choose Chart</h3>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="option-listing">
                <li class="w-100">
                    <div class="form-check mt-0 pb-3">
                        <label class="form-check-label" for="jodichart"><img class="flag"
                                src="https://cdn-icons-png.flaticon.com/512/12907/12907880.png" alt="">Jodi Chart</label>
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="jodichart" checked>
                    </div>
                </li>
                <li class="w-100">
                    <div class="form-check mt-3 pb-3">
                        <label class="form-check-label" for="panachart"><img class="flag"
                                src="https://cdn-icons-png.flaticon.com/512/8176/8176145.png" alt="">Pana Chart</label>
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="panachart">
                    </div>
                </li>
            </ul>
        </div>
        <div class="offcanvas-footer border-0">
            <button onclick="viewChart()" class="btn theme-btn w-100 mt-0">View Chart</button>
        </div>
    </div>
    <!-- Change language offcanvas end -->

    <!-- search section starts -->
    <!-- <section class="search-section section-b-space pt-0">
        <div class="custom-container">
            <div class="form-input">
                <input type="search" class="form-control with-icon" id="inputusername"
                    placeholder="Search destinations">
                <i class="iconsax search-icon" data-icon="search-normal-2"> </i>
                <a href="date-time-schedule" class="date-time-picker">
                    <i class="iconsax icon" data-icon="calendar-1">
                    </i>
                </a>
            </div>
        </div>
    </section> -->
    <!-- search section end -->

    <!-- slider section starts -->
    <section>
        <div class="swiper banner1 home-banner">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                <div class="container">
                    <h1>Weekly</h1>
                    <table class="leaderboard">
                        <thead>
                            <tr>
                                <th>Rank</th>
                                <th>Name</th>
                                <th>Score</th>
                            </tr>
                        </thead>
                        <tbody>
                        <tr>
                                <td class="gold">1 🥇</td>
                                <td>John Doe</td>
                                <td>1500</td>
                            </tr>
                            <tr>
                                <td class="silver">2 🥈</td>
                                <td>Jane Smith</td>
                                <td>1400</td>
                            </tr>
                            <tr>
                                <td class="bronze">3 🥉</td>
                                <td>Emily Johnson</td>
                                <td>1300</td>
                            </tr>
                        </tbody>
                    </table>
               </div>
                </div>
                <div class="swiper-slide">
                <div class="container">
                    <h1>Monthly</h1>
                    <table class="leaderboard">
                        <thead>
                            <tr>
                                <th>Rank</th>
                                <th>Name</th>
                                <th>Score</th>
                            </tr>
                        </thead>
                        <tbody>
                        <tr>
                                <td class="gold">1 🥇</td>
                                <td>John Doe</td>
                                <td>1500</td>
                            </tr>
                            <tr>
                                <td class="silver">2 🥈</td>
                                <td>Jane Smith</td>
                                <td>1400</td>
                            </tr>
                            <tr>
                                <td class="bronze">3 🥉</td>
                                <td>Emily Johnson</td>
                                <td>1300</td>
                            </tr>
                        </tbody>
                    </table>
               </div>
                </div>
            </div>
        </div>
    </section>
    <!-- slider section end -->

    <!-- category section starts -->
    <!-- <section>
        <div class="custom-container">
            <div class="title">
                <h3>Top Games</h3>
            </div>

            <ul class="categories-list">
                <li>
                    <a href="search-location" class="categories-box">
                        <img class="img-fluid categories-img" src="https://themes.pixelstrap.com/pwa/taxify/assets/images/svg/c1.svg" alt="c1">
                        <h6>Ride</h6>
                    </a>
                </li>
                <li>
                    <a href="outstation" class="categories-box">
                        <img class="img-fluid categories-img" src="https://themes.pixelstrap.com/pwa/taxify/assets/images/svg/c2.svg" alt="c1">
                        <h6>Outstation</h6>
                    </a>
                </li>
                <li>
                    <a href="rental" class="categories-box">
                        <img class="img-fluid categories-img" src="https://themes.pixelstrap.com/pwa/taxify/assets/images/svg/c3.svg" alt="c1">
                        <h6>Rental</h6>
                    </a>
                </li>
            </ul>
        </div>
    </section> -->
    <!-- category section end -->

    <!-- offer section starts -->
    <section class="section-b-space">
        <div class="custom-container">
            <div class="title">
                <h3>Play Game</h3>
            </div>
 <!--
            <div class="row gy-3">
                <?php
                $query = "SELECT * FROM `gamelist`";
                $result = mysqli_query($con, $query);
                while ($row = mysqli_fetch_array($result)) {
                ?>
                    <div class="col-12">
                        <div class="coupon-box">
                            <div style="text-transform: uppercase;" class="coupon-discount"><?= $row['title'] ?></div>
                            <?php
                            if ($row['game_status'] == 'open') {
                            ?>
                                <div class="coupon-details">
                                    <div class="coupon-content">
                                        <a href="#language" data-bs-toggle="offcanvas" class="coupon-name">
                                            <img class="img-fluid coupon-img" style="border-radius:0" src="https://cdn-icons-png.flaticon.com/512/1234/1234189.png" alt="c1">

                                            <div>
                                                <h5 class="fw-normal title-color">
                                                    <?php
                                                    $arr = json_decode($row['game_data'], true);
                                                    echo $arr['result'][0] . "-" . $arr['result'][1] . "-" . $arr['result'][2];
                                                    ?>
                                                </h5>
                                            </div>
                                        </a>
                                        <div onclick="window.location.href='select?id=<?=$row['id'] ?>'" class="rating">
                                            <img style="width: 26px;height:26px" class="img-fluid star" src="https://cdn-icons-png.flaticon.com/512/5690/5690573.png" alt="star">
                                         <h6>4.5</h6>
                                        </div>
                                    </div>
                                    <p style="color:green">Betting is open for Today</p>


                                    <ul class="content-list">
                                        <li><i class="iconsax icon" data-icon="calendar-1"></i>Chart Info</li>
                                        <li><i class="iconsax icon" data-icon="user-1"></i>Place Bet</li>
                                    </ul>
                                    <div class="d-flex align-items-center justify-content-between mt-3">
                                        <h6 class="content-color fw-normal">Last Bid Time Open <span style="color:blue">11:37 AM</span></h6>
                                        <h6 class="content-color fw-normal">Last Bid Time Close <span style="color:blue">11:37 AM</span></h6>
                                    </div>
                                </div>
                            <?php
                            } else {
                                ?>
                                <div class="coupon-details">
                                    <div class="coupon-content">
                                        <a href="jodichart" class="coupon-name">
                                            <img class="img-fluid coupon-img" style="border-radius:0" src="https://cdn-icons-png.flaticon.com/512/1234/1234190.png" alt="c1">

                                            <div>
                                                <h5 class="fw-normal title-color">
                                                    <?php
                                                    $arr = json_decode($row['game_data'], true);
                                                    echo $arr['result'][0] . "-" . $arr['result'][1] . "-" . $arr['result'][2];;
                                                    ?>
                                                </h5>
                                            </div>
                                        </a>
                                        <div onclick="window.location.href='select?id=<?=$row['id'] ?>'" class="rating">
                                            <img style="width: 26px;height:26px" class="img-fluid star" src="https://cdn-icons-png.flaticon.com/512/5690/5690573.png" alt="star">
                                            <h6>4.5</h6> 
                                        </div>
                                    </div>
                                    <p style="color:red">Betting is closed for Today</p>


                                    <ul class="content-list">
                                        <li><i class="iconsax icon" data-icon="calendar-1"></i>Chart Info</li>
                                        <li><i class="iconsax icon" data-icon="user-1"></i>Place Bet</li>
                                    </ul>
                                    <div class="d-flex align-items-center justify-content-between mt-3">
                                        <h6 class="content-color fw-normal">Last Bid Time Open <span style="color:blue">11:37 AM</span></h6>
                                        <h6 class="content-color fw-normal">Last Bid Time Close <span style="color:blue">11:37 AM</span></h6>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>

                        </div>
                    </div>
                <?php
                }
                ?>

            </div>
            -->

            <div class="games-window">
  <a class="gameCard-container" href="#">
    <span class="blink text-primary d-block text-right">◉ LIVE</span>
    <picture class="gameCard-image">
      <img width="100%" src="../assets/images/slider/slider4.png" alt="Classic Ludo">
    </picture>
    <div class="gameCard-title">
      <span class="text-dark d-block text-right">◉ CLASSIC LUDO</span>
    </div>
 
  </a>

  <a class="gameCard-container" href="/Homepage/Ludo Popular">
    <span class="blink text-PRIMARY d-block text-right">◉ LIVE</span>
    <picture class="gameCard-image">
      <img width="100%" height="100%" src="../assets/images/slider/slider4.png" alt="Popular Ludo">
    </picture>
    <div class="gameCard-title">
      <span class="text-dark d-block text-right">◉ POPULAR LUDO</span>
    </div>
  </a>

  <a class="gameCard-container" href="/Homepage/Ludo 1 Goti">
    <span class="blink text-Live d-block text-right">◉ LIVE</span>
    <picture class="gameCard-image">
      <img width="100%" src="../assets/images/slider/slider4.png" alt="Ludo No Cut">
    </picture>
    <div class="gameCard-title">
      <span class="blink text-success d-block text-right">◉ LUDO NO CUT</span>
    </div>
   
  </a>

  <a class="gameCard-container" href="/Homepage/Ludo Ulta">
    <span class="blink text-primary d-block text-right">◉ LIVE</span>
    <picture class="gameCard-image">
      <img width="100%" src="../assets/images/slider/slider4.png" alt="Ludo Ulta">
    </picture>
    <div class="gameCard-title">
      <span class="blink text-success d-block text-right">◉ LUDO ULTA</span>
    </div>
  
  </a>
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

            <li >
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