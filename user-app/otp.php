<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from themes.pixelstrap.com/pwa/taxify/user-app/otp by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 01 Sep 2024 04:36:54 GMT -->
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

    <!-- sweet alert  -->
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/sweetalert/dist/sweetalert.css">

    <!-- sweetalert  -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>

<?php 
include './db.php';

$mobile = $_SESSION['mobile'];
if(isset($_POST['submit'])){
    
$otp = $_SESSION['otp'];

$otp1 = $_POST['otp1'];
$otp2 = $_POST['otp2'];
$otp3 = $_POST['otp3'];
$otp4 = $_POST['otp4'];
$otp5 = $_POST['otp5'];

$otpR = $otp1.$otp2.$otp3.$otp4.$otp5;



$query = "SELECT * FROM users WHERE mobile = '$mobile' AND otp = '$otpR'";
$run = mysqli_query($con,$query);
if(mysqli_num_rows($run) > 0){
    $data = mysqli_fetch_assoc($run);
    $_SESSION['id'] = $data['id'];
    $_SESSION['email'] = $data['email'];
    $_SESSION['mobile'] = $data['mobile'];
    $_SESSION['otp'] = $data['otp'];
    $_SESSION['status'] = $data['status'];
    $_SESSION['isLogin'] = true;


    $token = bin2hex(random_bytes(16));

    setcookie('login_token', $token, time() + (30 * 24 * 60 * 60), "/");

    $updateToken = "UPDATE users SET login_token = '$token' WHERE mobile = '$mobile'";
    $run = mysqli_query($con,$updateToken);
    if($run){
        $_SESSION['session_token'] = $token;
    }

    ?>
    <script>
        swal("Verified", {
            icon: "success",
        }).then((value) => {
            window.location = 'home.php';
        });
    </script>
    <?php 
}else{
    ?>
    <script>
        swal("OTP not matched", {
            icon: "error",
        }).then((value) => {
            window.location = 'otp.php';
        });
    </script>
    <?php 
}
}

?>
    <!-- header starts -->
    <header id="header" class="main-header">
        <div class="custom-container">
            <div class="header-panel">
                <a href="login">
                    <i class="iconsax icon-btn" data-icon="chevron-left"> </i>
                </a>
                <img class="img-fluid logo" src="../assets/images/logo/logo.png" alt="logo">
                <img class="img-fluid logo-dark" src="../assets/images/logo/logo-dark.png" alt="logo">
            </div>
        </div>
    </header>
    <!-- header end -->

    <!-- otp page starts -->
    <div class="auth-content-bg">
        <div class="custom-container">
            <div class="auth-title pt-3">
                <div class="loader-line"></div>
                <h2>OTP verification</h2>
                <h6>Enter OTP sent to +91 <?=$mobile?></h6>
            </div>

            <h4 class="title-color fw-medium otp-name">OTP</h4>
            <form  method="post">
                <div class="otp-form">
                <div class="form-input dark-border-gradient">
                    <input type="number" name="otp1" class="form-control active" placeholder="0" id="five1"
                        onkeyup="onKeyUpEvent(1, event)" onfocus="onFocusEvent(1)">
                </div>
                <div class="form-input dark-border-gradient">
                    <input type="number" name="otp2" class="form-control" placeholder="0" id="five2"
                        onkeyup="onKeyUpEvent(2, event)" onfocus="onFocusEvent(2)">
                </div>
                <div class="form-input dark-border-gradient">
                    <input type="number" name="otp3" class="form-control" placeholder="0" id="five3"
                        onkeyup="onKeyUpEvent(3, event)" onfocus="onFocusEvent(3)">
                </div>
                <div class="form-input dark-border-gradient">
                    <input type="number" name="otp4" class="form-control" placeholder="0" id="five4"
                        onkeyup="onKeyUpEvent(4, event)" onfocus="onFocusEvent(4)">
                </div>
                <div class="form-input dark-border-gradient">
                    <input type="number" name="otp5" class="form-control" placeholder="0" id="five5"
                        onkeyup="onKeyUpEvent(5, event)" onfocus="onFocusEvent(5)">
                </div>
                </div>
                <input type="submit" name="submit" value="Verify" class="btn theme-btn w-100 auth-btn">
            </form>
            
            <h6 class="title-color fw-semibold mt-3 text-center"> <span class="content-color fw-medium">Not Received Yet
                    ? </span> <a href="otp" class="title-color fw-semibold">Resend it</a> </h6>
        </div>
    </div>
    <!-- otp page end -->

    <!-- iconsax js -->
    <script src="../assets/js/iconsax.js"></script>

    <!-- sticky-header js -->
    <script src="../assets/js/sticky-header.js"></script>

    <!-- bootstrap js -->
    <script src="../assets/js/bootstrap.bundle.min.js"></script>

    <!-- otp js -->
    <script src="../assets/js/otp.js"></script>

    <!-- template-setting js -->
    <script src="../assets/js/template-setting.js"></script>

    <!-- script js -->
    <script src="../assets/js/script.js"></script>
</body>


<!-- Mirrored from themes.pixelstrap.com/pwa/taxify/user-app/otp by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 01 Sep 2024 04:36:55 GMT -->
</html>