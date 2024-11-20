<?php
include ('db.php');
$rule_sql = "SELECT * FROM settings WHERE id='1'";
$rule_run = mysqli_query($con, $rule_sql);

$existing_rule = '';
if ($rule_run && mysqli_num_rows($rule_run) > 0) {
    $row = mysqli_fetch_assoc($rule_run);
    $existing_rule = $row['game_rules'];
}

?>


<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from themes.pixelstrap.com/pwa/taxify/user-app/finding-driveralf  by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 01 Sep 2024 04:37:12 GMT -->
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
                <a href="home">
                    <i class="iconsax icon-btn" data-icon="chevron-left"> </i>
                </a>

                <h3 class="fw-semibold title-color">Game Rule</h3>
            </div>
        </div>
    </header>
    <!-- header end -->

    <!-- note section starts -->
    <section class="pt-3">
        <div class="custom-container">
            <div class="poster-part">
                <p class="fw-normal text-white">Game Rule</p>
            </div>
        </div>
    </section>
    <!-- note section end -->

    <!-- finding driver list starts -->
    <section class="driver-request section-b-space">
        <div class="custom-container">
            <ul class="driver-list">
                <li>
                    <?php if (!empty($existing_rule)): ?>
                        <div class="driver-box outstation-driver-box">
                            <?php
                            echo $existing_rule;
                            ?>
                        </div>
                    <?php else: ?>
                        <p>No game rules have been set yet.</p>
                    <?php endif; ?>
                </li>
            </ul>
        </div>
    </section>
    <!-- finding driver list end -->

    <a href="https://api.whatsapp.com/send?phone=917042536431" class="Wfloat" target="_blank">
        <i class="fa fa-whatsapp myW-float" aria-hidden="true"></i>
    </a>

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


<!-- Mirrored from themes.pixelstrap.com/pwa/taxify/user-app/finding-driveralf  by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 01 Sep 2024 04:37:12 GMT -->
</html>