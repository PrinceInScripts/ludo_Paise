<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from themes.pixelstrap.com/pwa/taxify/user-app/profile-setting.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 01 Sep 2024 04:37:06 GMT -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
</head>

<body>
    <!-- header starts -->
    <header id="header" class="main-header">
        <div class="custom-container">
            <div class="header-panel">
                <a href="setting">
                    <i class="iconsax icon-btn" data-icon="chevron-left"> </i>
                </a>
                <h3>Profile setting</h3>
            </div>
        </div>
    </header>
    <!-- header end -->

    <!-- setting section starts -->
    <div class="setting-section profile-setting-section mt-0">
        <div class="auth-content-bg pt-0">
            <div class="custom-container">
                <div class="profile-section">
                    <div class="profile-image mt-0">
                        <img id="output" class="img-fluid profile-pic" src="../assets/images/profile/p8.png" alt="p8">
                        <input id="file" type="file" onchange="loadFile(event)">
                        <i class="iconsax upload-icon" data-icon="edit-2"> </i>
                    </div>
                </div>
                <form class="auth-form">
                    <div class="form-group mt-0">
                        <label class="form-label mb-2" for="Inputname">User Name</label>
                        <input type="text" class="form-control" id="Inputname" placeholder="Enter your name">
                    </div>

                    <div class="form-group">
                        <label class="form-label mb-2" for="Inputnumner">Mobile Number</label>
                        <input type="number" class="form-control" id="Inputnumner" placeholder="Enter your number">
                    </div>

                    <div class="form-group">
                        <label class="form-label mb-2" for="Inputemail">Email</label>
                        <input type="email" class="form-control" id="Inputemail" placeholder="Enter your email">
                    </div>

                    <a href="home" class="btn theme-btn w-100 auth-btn">Update</a>
                </form>
            </div>
        </div>
    </div>
    <!-- setting section starts -->

    <!-- panel-space start -->
    <section class="panel-space"></section>
    <!-- panel-space end -->

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


<!-- Mirrored from themes.pixelstrap.com/pwa/taxify/user-app/profile-setting.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 01 Sep 2024 04:37:06 GMT -->
</html>