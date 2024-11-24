<?php
include 'db.php';
include('includes/sessions.php');
?>

<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from themes.pixelstrap.com/pwa/taxify/user-app/empty-notification by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 01 Sep 2024 04:37:14 GMT -->

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
</head>

<body>
    <!-- header starts -->
    <header id="header" class="main-header me-4">
        <div class="custom-container">
            <div class="header-panel">
                <div class="d-flex align-items-center gap-2">
                    <a href="home">
                        <i class="iconsax icon-btn" data-icon="chevron-left"> </i>
                    </a>
                    <h3>Notifications</h3>
                </div>
            </div>
        </div>
    </header>
    <!-- header end -->

    <!-- empty image section starts -->
    <?php
    $query = "SELECT * FROM notifications";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
    ?>
        <section class="section-b-space">
        <div class="custom-container">
            <ul class="notification-list">
                <?php 
                while($row = mysqli_fetch_assoc($result)){
                    ?>
 <li>
                    <div class="notification-box unread">
                        <div>
                            <h5><?=$row['title'] ?></h5>
                            <p><?=$row['content'] ?></p>
                        </div>
                        <div class="notification-icon">
                            <i class="iconsax icon" data-icon="clock"> </i>
                        </div>
                    </div>
                </li>
                    <?php 
                }
                ?>
               
            </ul>
        </div>
    </section>
    <?php
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

    <!-- empty image section end -->

    <a href="https://api.whatsapp.com/send?phone=917042536431" class="Wfloat" target="_blank">
        <i class="fa fa-whatsapp myW-float" aria-hidden="true"></i>
    </a>

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
</body>


<!-- Mirrored from themes.pixelstrap.com/pwa/taxify/user-app/empty-notification by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 01 Sep 2024 04:37:14 GMT -->

</html>