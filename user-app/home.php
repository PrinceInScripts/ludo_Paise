<?php
include('db.php');
include('includes/sessions.php');
$userid = $_SESSION['id'];

?>
<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from themes.pixelstrap.com/pwa/taxify/user-app/home by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 01 Sep 2024 04:36:56 GMT -->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

<script src="https://kit.fontawesome.com/e8623f4723.js" crossorigin="anonymous"></script>
       

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
                    <!-- <a href="chatting">
                        <i class="iconsax icon-btn" data-icon="messages-2"> </i>
                    </a> -->
                    <a href="notification">
                        <i class="iconsax icon-btn" data-icon="bell-2"> </i>
                    </a>
                </div>
            </div>
        </div>
    </header>
    <!-- header end -->

    <!-- Change language offcanvas starts -->
    <div class="offcanvas ride-offcanvas p-0" tabindex="-1" id="ludo-classic">
        <div class="offcanvas-header pb-0">
            <h3>Choose Game</h3>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="option-listing">
                <li class="w-100" onclick="selectRadio('ludoclassic')">
                    <div class="form-check mt-0 pb-3">
                        <label class="form-check-label" for="jodichart"><img class="flag"
                                src="https://cdn-icons-png.flaticon.com/512/12907/12907880.png" alt="">Ludo Normal</label>
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="ludoclassic" checked>
                    </div>
                </li>
                <li class="w-100" onclick="selectRadio('ludocondition')">
                    <div class="form-check mt-3 pb-3">
                        <label class="form-check-label" for="panachart"><img class="flag"
                                src="https://cdn-icons-png.flaticon.com/512/8176/8176145.png" alt="">Ludo Condition</label>
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="ludocondition">
                    </div>
                </li>
                <li class="w-100" onclick="selectRadio('ludoclassictournament')">
                    <div class="form-check mt-3 pb-3">
                        <label class="form-check-label" for="panachart"><img class="flag"
                                src="https://cdn-icons-png.flaticon.com/512/8176/8176145.png" alt="">Ludo Tournament</label>
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="ludoclassictournament">
                    </div>
                </li>
            </ul>
        </div>
        <div class="offcanvas-footer border-0">
            <button onclick="viewChart()" class="btn theme-btn w-100 mt-0">Play</button>
        </div>
    </div>
    <!-- Change language offcanvas end -->





    <!-- slider section starts -->
    <section>
        <div class="swiper banner1 home-banner">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img class="img-fluid slider-img w-100" src="../assets/images/slider/slider.gif" alt="slider">
                </div>
                <div class="swiper-slide">
                    <img class="img-fluid slider-img w-100" src="../assets/images/slider/slider.gif" alt="slider">
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
                    $query = "SELECT * FROM `gamelists`";
                    $result = mysqli_query($con, $query);
                    while ($row = mysqli_fetch_array($result)) {
                    ?>
                        
                        <a style="opacity:<?=$row['opacity'] ?>" class="gameCard-container" href='<?php if($row['status'] == 1){
                            echo "newbattle.php?id=".$row['id'];
                        }else{
                            echo "#";
                        } ?>'>
                            <span class="py-1 blink text-primary d-block text-right">◉ LIVE</span>
                            <picture class="gameCard-image">
                                <img width="100%" src="../assets/images/games/<?= $row['image'] ?>" alt="<?= $row['title'] ?>">
                            </picture>
                            <div class="gameCard-title">
                                <span class="text-dark d-block text-right">◉ <?= $row['title'] ?></span>
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
    <?php include_once('includes/sidebar.php') ?>
    <!-- sidebar end -->

    <a href="https://api.whatsapp.com/send?phone=917042536431" class="Wfloat" target="_blank">
        <i class="fa fa-whatsapp myW-float" aria-hidden="true"></i>
    </a>

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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>

// Function to select the corresponding radio button
function selectRadio(id) {
    document.getElementById(id).checked = true;
}


        function viewChart() {
           

            var ele = document.getElementsByName('flexRadioDefault');

            
            for (i = 0; i < ele.length; i++) {
                if (ele[i].checked) {

                    if (ele[i].id == 'ludoclassic') {
                        window.location.href = 'newbattle.php?id=1';
                    }else if (ele[i].id == 'ludoclassictournament'){
                        swal.fire({
                            title: 'Coming Soon',
                            text: 'This feature is coming soon',
                            icon: 'info',
                            confirmButtonText: 'OK'
                        });
                    }else if (ele[i].id == 'ludocondition'){
                        swal.fire({
                            title: 'Coming Soon',
                            text: 'This feature is coming soon',
                            icon: 'info',
                            confirmButtonText: 'OK'
                        });
                    }

                    

                }


            }
        }
    </script>
</body>



</html>