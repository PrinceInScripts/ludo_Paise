<?php
include './db.php';
include('includes/sessions.php');
$userid = $_SESSION['id'];
$query = "SELECT * FROM users WHERE id = '$userid'";
$run = mysqli_query($con, $query);
$data = mysqli_fetch_assoc($run);

$name = $data['username'];
$email = $data['email'];
$wallet = $data['deposit_wallet'] + $data['withdraw_wallet'];
$user_role = $data['role'];

$img_src_sql = "SELECT * FROM profile_pic WHERE id = '$data[profile_pic]'";
$img_src_run = mysqli_query($con, $img_src_sql);

$img_src_data = mysqli_fetch_assoc($img_src_run);
?>

<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from themes.pixelstrap.com/pwa/taxify/user-app/setting by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 01 Sep 2024 04:37:05 GMT -->

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
    <header id="header" class="main-header inner-page-header">
        <div class="custom-container">
            <div class="header-panel">
                <a href="#offcanvasLeft" data-bs-toggle="offcanvas">
                    <i class="iconsax icon-btn" data-icon="text-align-left"> </i>
                </a>
                <h3>Setting</h3>
            </div>
        </div>
    </header>
    <!-- header end -->

    <div class="setting-bg"></div>

    <!-- profile section starts -->
    <section class="setting-section pt-0">
        <div class="profile-section">
            <div class="profile-image">
                <img class="img-fluid profile-pic" src="../assets/images/profile/<?php echo $img_src_data['profile'] ?>" alt="p8">
            </div>
            <h3 class="profile-name">
                <?php
                if ($name == '') {
                    echo "No Name";
                } else {
                    echo $name;
                    // echo $name .' <img src="https://cdn-icons-png.flaticon.com/512/7641/7641727.png" alt="Verified" srcset="" title="Verified" width="20">';
                }

                ?>
            </h3>
            <h6 class="fw-normal content-color mt-1 text-center">
                <?php
                if ($email == '') {
                    echo "<a href='profile.php' class=' color-palette'>add email</a>";
                } else {
                    echo $email;
                }
                ?>

            </h6>
        </div>

        <div onclick="window.location.href='wallet'" class="wallet-part">
            <h6>My Wallet Balance</h6>
            <div class="d-flex align-content-center justify-content-center gap-1">
                <h5>₹ <?= $wallet ?> </h5>
                <img class="img-fluid arrow-img" src="https://themes.pixelstrap.com/pwa/taxify/assets/images/svg/side-arrow.svg" alt="side-arrow">
            </div>
        </div>


        <div class="custom-container">
            <div class="profile-list mt-4">
                <h5 class="fw-normal content-color mb-3">General</h5>
                <ul class="setting-listing">

                <?php 
                if($user_role == 'admin'){
                    ?>
                    <li class="w-100">
                        <a href="../admin/index.php" class="setting-box">
                            <div class="setting-icon">
                                <i class="iconsax icon" data-icon="user-1"> </i>
                            </div>
                            <div class="setting-content">
                                <h5>Admin Panel</h5>
                                <i class="iconsax icon" data-icon="chevron-right"> </i>
                            </div>
                        </a>
                    </li>
                    <?php
                }
                ?>



                    <li class="w-100">
                        <a href="profile" class="setting-box">
                            <div class="setting-icon">
                                <i class="iconsax icon" data-icon="user-1"> </i>
                            </div>
                            <div class="setting-content">
                                <h5>Profile settings</h5>
                                <i class="iconsax icon" data-icon="chevron-right"> </i>
                            </div>
                        </a>
                    </li>

                    <li class="w-100">
                        <a href="bank" class="setting-box">
                            <div class="setting-icon">
                                <i class="iconsax icon" data-icon="bank"> </i>
                            </div>
                            <div class="setting-content">
                                <h5>Bank details</h5>
                                <i class="iconsax icon" data-icon="chevron-right"> </i>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="profile-list mt-4">
                <h5 class="fw-normal content-color mb-3">App details</h5>
                <ul class="setting-listing">
                    <li class="w-100">
                        <a href="app-setting" class="setting-box">
                            <div class="setting-icon">
                                <i class="iconsax icon" data-icon="password-check"> </i>
                            </div>
                            <div class="setting-content">
                                <h5>App Setting </h5>
                                <i class="iconsax icon" data-icon="chevron-right"> </i>
                            </div>
                        </a>
                    </li>

                    <li class="w-100">
                        <a href="#share" class="setting-box" data-bs-toggle="modal">
                            <div class="setting-icon">
                                <i class="iconsax icon" data-icon="send-2"> </i>
                            </div>
                            <div class="setting-content">
                                <h5>Share App</h5>
                                <i class="iconsax icon" data-icon="chevron-right"> </i>
                            </div>
                        </a>
                    </li>

                    <li class="w-100">
                        <a href="#0" class="setting-box">
                            <div class="setting-icon">
                                <i class="iconsax icon" data-icon="message-dots-notif"> </i>
                            </div>
                            <div class="setting-content">
                                <h5>Chat Support</h5>
                                <i class="iconsax icon" data-icon="chevron-right"> </i>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="profile-list alert-list mt-4">
                <h5 class="fw-normal error-color mb-3">Alert zone</h5>
                <ul class="setting-listing">
                    <!-- <li class="w-100">
                        <a href="#delete" class="setting-box" data-bs-toggle="modal">
                            <div class="setting-icon">
                                <i class="iconsax icon" data-icon="user-2-remove"> </i>
                            </div>
                            <div class="setting-content">
                                <h5 class="error-color">Delete Account</h5>
                            </div>
                        </a>
                    </li> -->

                    <li class="w-100">
                        <a href="#logout" class="setting-box" data-bs-toggle="modal">
                            <div class="setting-icon">
                                <i class="iconsax icon" data-icon="logout-2"> </i>
                            </div>
                            <div class="setting-content">
                                <h5 class="error-color">Logout</h5>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </section>
    <!-- profile section starts -->



    <!-- add modal starts -->
    <div class="modal fade add-modal" id="share" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3>Share App</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <ul class="media-list">
                        <li>
                            <a href="https://api.whatsapp.com/send?text=Join%20Ludopaisa%20Today%20%F0%9F%98%8E%F0%9F%98%8E%0A%0A2%25%20direct%20commission%0AInstant%20Deposit%0AInstant%20Withdrawal%0A%0A%0A%0A*Join%20Now%20by%20clicking%20the%20link%20below*%20%F0%9F%91%89%20https%3A%2F%2Fludopaisa.com%0A%0A" class="media-box">
                                <div class="media-image mx-auto">
                                    <img class="img-fluid icon" src="https://themes.pixelstrap.com/pwa/taxify/assets/images/svg/whatsapp.svg" alt="whatsapp">
                                </div>
                                <h5>Whatsapp</h5>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.facebook.com/sharer/sharer.php?u=https://ludopaisa.com&quote=Join%20Ludopaisa%20Today%20%F0%9F%98%8E%F0%9F%98%8E%0A%0A2%25%20direct%20commission%0AInstant%20Deposit%0AInstant%20Withdrawal%0A%0AGame%20Link%20%3A%20https%3A%2F%2Fludopaisa.com%0A%F0%9F%8E%B0%F0%9F%8E%B0%F0%9F%8E%B0" class="media-box">
                                <div class="media-image mx-auto">
                                    <img class="img-fluid icon" src="https://themes.pixelstrap.com/pwa/taxify/assets/images/svg/facebook.svg" alt="facebook">
                                </div>
                                <h5>Facebook</h5>
                            </a>
                        </li>

                        <li>
                            <a href="https://instagram.com/" class="media-box">
                                <div class="media-image mx-auto">
                                    <img class="img-fluid icon" src="https://themes.pixelstrap.com/pwa/taxify/assets/images/svg/instagram.svg"
                                        alt="instagram">
                                </div>
                                <h5>Instagram</h5>
                            </a>
                        </li>

                        <li>
                            <a href="https://twitter.com/intent/tweet?url=https://ludopaisa.com&text=Join%20Ludopaisa%20Today%20%F0%9F%98%8E%F0%9F%98%8E%0A%0A2%25%20direct%20commission%0AInstant%20Deposit%0AInstant%20Withdrawal%0A%0AGame%20Link%20%3A%20https%3A%2F%2Fludopaisa.com%0A%F0%9F%8E%B0%F0%9F%8E%B0%F0%9F%8E%B0" class="media-box">
                                <div class="media-image mx-auto">
                                    <img class="img-fluid icon" src="https://themes.pixelstrap.com/pwa/taxify/assets/images/svg/twitter.svg" alt="twitter">
                                </div>
                                <h5>Twitter</h5>
                            </a>
                        </li>
                        <li>
                            <a href="mailto:?subject=Join%20Ludopaisa%20Today%20%F0%9F%98%8E%F0%9F%98%8E&body=Join%20Ludopaisa%20Today%20%F0%9F%98%8E%F0%9F%98%8E%0A%0A2%25%20direct%20commission%0AInstant%20Deposit%0AInstant%20Withdrawal%0A%0AGame%20Link%20%3A%20https%3A%2F%2Fludopaisa.com%0A%F0%9F%8E%B0%F0%9F%8E%B0%F0%9F%8E%B0" class="media-box">
                                <div class="media-image mx-auto">
                                    <img class="img-fluid icon" src="https://themes.pixelstrap.com/pwa/taxify/assets/images/svg/gmail.svg" alt="gmail">
                                </div>
                                <h5>Email</h5>
                            </a>
                        </li>
                        <li>
                            <a href="https://t.me/share/url?url=https://ludopaisa.com&text=Join%20Ludopaisa%20Today%20%F0%9F%98%8E%F0%9F%98%8E%0A%0A2%25%20direct%20commission%0AInstant%20Deposit%0AInstant%20Withdrawal%0A%0AGame%20Link%20%3A%20https%3A%2F%2Fludopaisa.com%0A%F0%9F%8E%B0%F0%9F%8E%B0%F0%9F%8E%B0" class="media-box">
                                <div class="media-image mx-auto">
                                    <img class="img-fluid icon" src="https://themes.pixelstrap.com/pwa/taxify/assets/images/svg/telegram.svg" alt="telegram">
                                </div>
                                <h5>Telegram</h5>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- add modal end -->

    <!-- delete account modal starts -->
    <div class="modal delete-modal fade" id="delete" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <img class="img-fluid icon" src="https://themes.pixelstrap.com/pwa/taxify/assets/images/svg/alert.svg" alt="alert">
                    <h4>Delete Your Account</h4>
                    <p>You will lost your data By delete your account.</p>
                </div>
                <div class="modal-footer">
                    <a href="setting" class="btn gray-btn w-50 m-0" data-bs-dismiss="modal">No, Keep it</a>
                    <a href="login" class="btn theme-btn w-50 m-0">Yes, Delete</a>
                </div>
            </div>
        </div>
    </div>
    <!-- delete account modal end -->

    <!-- logout modal starts -->
    <div class="modal delete-modal fade" id="logout" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <img class="img-fluid icon" src="https://themes.pixelstrap.com/pwa/taxify/assets/images/svg/logout.svg" alt="alert">
                    <h4>Come Back Soon</h4>
                    <p>Are you sure You want to Logout?</p>
                </div>
                <div class="modal-footer">
                    <a href="setting" class="btn gray-btn w-50 m-0" data-bs-dismiss="modal">Stay, logged in</a>
                    <a href="login" class="btn theme-btn w-50 m-0">Yes, Logout </a>
                </div>
            </div>
        </div>
    </div>
    <!-- logout modal end -->

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

            <li class="active">
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

    <!-- template-setting js -->
    <script src="../assets/js/template-setting.js"></script>

    <!-- script js -->
    <script src="../assets/js/script.js"></script>
</body>


<!-- Mirrored from themes.pixelstrap.com/pwa/taxify/user-app/setting by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 01 Sep 2024 04:37:06 GMT -->

</html>