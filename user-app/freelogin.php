
<?php 
include './db.php';
include './functions.php';


if(isset($_SESSION['id'])){
    header('location:home.php');
}

if(isset($_GET['code'])){
    $code = $_GET['code'];
    $query = "SELECT * FROM users WHERE referrer_id = '$code'";
    $result = mysqli_query($con,$query);
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        $_SESSION['referrer_id'] = $row['id'];
        $isReferrer = true;
    }else{
        $isReferrer = false;
    }
}


?>
<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from themes.pixelstrap.com/pwa/taxify/user-app/login by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 01 Sep 2024 04:36:53 GMT -->
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
    <!-- <meta name="apple-mobile-web-app-capable" content="yes"> -->
    <meta name="mobile-web-app-capable" content="yes">
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

    <!-- sweet alert  -->
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/sweetalert/dist/sweetalert.css">

    <!-- bootstrap css -->
    <link rel="stylesheet" id="rtl-link" type="text/css" href="../assets/css/vendors/bootstrap.css">

    <!-- Theme css -->
    <link rel="stylesheet" id="change-link" type="text/css" href="../assets/css/style.css">
    
            <!-- sweetalert  -->
            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
            <style>
                .auth-content-bg .auth-btn{
                    margin-top: 0;
                }
            </style>
</head>

<body>
<?php 

function generateUsername($length = 8) {
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $username = '';
    $charLength = strlen($characters);
    
    for ($i = 0; $i < $length; $i++) {
        $username .= $characters[rand(0, $charLength - 1)];
    }
    
    return $username;
}

if(isset($_POST['submit'])){
    $mobile = $_POST['mobile'];
    // $otp = 99999;
   
    // $otp = rand(10000,99999);
    $otp = 12345;

   $query = "SELECT * FROM users WHERE mobile = '$mobile'";
    $result = mysqli_query($con,$query);
    if(mysqli_num_rows($result) > 0){
        $query = "UPDATE users SET otp = '$otp' WHERE mobile = '$mobile'";
        $result = mysqli_query($con,$query);
    }else{
        $username=generateUsername();
        $profile=rand(1, 22);
        $selfcode = generateCode();
        if(isset($_SESSION['referrer_id'])){
            $refid = $_SESSION['referrer_id'];
            $query = "SELECT * FROM users WHERE id = '$refid'";
            $result = mysqli_query($con,$query);
            $row = mysqli_fetch_assoc($result);
            $refCode = $row['referrer_id'];
        }else{
            $refCode = null;
        }
        $query = "INSERT INTO users (mobile,otp,username,profile_pic,referrer_id,level_1) VALUES ('$mobile','$otp','$username','$profile','$selfcode','$refCode')";
        $result = mysqli_query($con,$query);
    }
    $mobileNew = "91".$mobile;
    

    $otpStatus = array('status' => true);
    // $otpStatus = sendOTP2($mobile, $otp);
    // print_r($otpStatus);
    

    // Check if 'status' exists in the response
    if (isset($otpStatus['status']) && $otpStatus['status'] == false) {
        ?>
        <script>
            swal({
                title: "Error",
                text: "Try again later",
                icon: "error",
                button: "Ok",
            });
        </script>
        <?php 
    // } elseif (isset($otpStatus['status']) && $otpStatus['status'] == 1 && !isset($otpStatus['response']['error'])) {
    // } elseif (isset($otpStatus['status']) && $otpStatus['status'] == true && isset($otpStatus['response']['return']) && $otpStatus['response']['return'] == true) {
    } elseif (1) {
        $_SESSION['otp'] = $otp;
        $_SESSION['mobile'] = $mobile;
        ?>
        <script>
            swal({
                title: "Success",
                text: "OTP sent successfully",
                icon: "success",
                button: "Ok",
            }).then(function() {
                window.location = "otp.php";
            });
        </script>
        <?php 
    }elseif(isset($otpStatus['response']['error'])){
        ?>
        <script>
            swal({
                title: "Error",
                text: "<?php echo $otpStatus['response']['error']; ?>",
                icon: "error",
                button: "Ok",
            });
            </script>
        <?php 
    } else {

        $errormsg = "OTP not sent";
    }

    
}

?>
    <?php 
    if(isset($errormsg)){
        ?>

        <script>
            swal({
                title: "Error",
                text: "<?php echo $errormsg; ?>",
                icon: "error",
                button: "Ok",
            });
        </script>
        <?php 
    }
    ?>
    <!-- header starts -->
    <header id="header" class="main-header pt-5 pb-3">
        <div class="custom-container">
            <div class="header-panel pb-0">
                <img class="img-fluid logo" src="../assets/images/logo/logo.png" alt="logo">
                <img class="img-fluid logo-dark" src="../assets/images/logo/logo-dark.png" alt="logo">
            </div>
        </div>
    </header>
    <!-- header end -->

    <!-- login page start -->
    <div class="auth-content-bg pt-3">
        <div class="custom-container">
            <div class="auth-title mt-0">
                <div class="loader-line"></div>
                <h2>Let’s you in</h2>
                <h6>Hey, You have been missed !</h6>
            </div>

            <form class="auth-form" method="post">
                <div class="form-group mt-0">
                    <label class="form-label" for="validationDefault01">Mobile Number</label>
                    <div class="d-flex gap-2">
                        <div class="dropdown">
                            <a class="btn dropdown-toggle mt-0" href="#" role="button" data-bs-toggle="dropdown"> +91
                                <i class="iconsax dropdown-icon" data-icon="chevron-down"> </i>
                            </a>
                            <!-- <ul class="dropdown-menu">
                                <li><a href="#" class="dropdown-item">+92</a></li>
                            </ul> -->
                        </div>
                        <div class="form-input w-100">
                       

                            <input name="mobile" oninput="this.value = this.value.replace(/[^0-9]/g, '');" type="text" maxlength="10" class="form-control" id="validationDefault01"
                                placeholder="Enter your number" required>
                        </div>
                    </div>
                </div>
                <br>

                <?php 
                if(isset($isReferrer) && $isReferrer == true){
                    ?>

                    <!-- show msg here for refer code applied  -->

                    <div class="alert alert-success" role="alert">
                        Refer code applied successfully
                    </div>
                    <?php 
                }elseif(isset($isReferrer) && $isReferrer == false){
                    ?>
                    <div class="alert alert-danger" role="alert">
                        Invalid refer code
                    </div>
                    <?php 
                }
                ?>

                <input type="submit" name="submit" value="Get OTP" class="btn theme-btn w-100 auth-btn">
           
    
            </form>
        </div>
    </div>
    <!-- login page end -->


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


<!-- Mirrored from themes.pixelstrap.com/pwa/taxify/user-app/login by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 01 Sep 2024 04:36:54 GMT -->
</html>