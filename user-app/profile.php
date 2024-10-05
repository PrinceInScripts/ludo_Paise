<?php
include('db.php');
if (!isset($_SESSION['isLogin'])) {
    header('location:login');
}

$user_id = $_SESSION['id'];
$username = "";
$email = "";
$mobile = "";
$profile = "";

$sql = "SELECT * FROM users WHERE id='$user_id'";
$res = mysqli_query($con, $sql);

if (mysqli_num_rows($res) > 0) {
    $row = mysqli_fetch_assoc($res);
    $username = $row['username'];
    $email = $row['email'];
    $aadhar = $row['adhaar_no'];
    $kyc = $row['kyc_status'];
    $mobile = $row['mobile'];
    $profile = $row['profile_pic'];
}

$img_src_sql = "SELECT * FROM profile_pic WHERE id = '$profile'";
$img_src_run = mysqli_query($con, $img_src_sql);

$img_src_data = mysqli_fetch_assoc($img_src_run);
?>



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
                        <img id="output" class="img-fluid profile-pic" src="../assets/images/profile/<?php echo $img_src_data['profile'] ?>" alt="p8">
                        <input id="file" type="file" onchange="loadFile(event)">
                        <i class="iconsax upload-icon" data-icon="edit-2"> </i>
                    </div>
                </div>
                <br>
                <h3 class="text-center profile-name">KYC Status</h3>
                <div class="auth-form">
                    <?php
                    if ($kyc == 1) {
                    ?>
                        <div class="form-group mb-4">

                            <label class="form-label" for="Inputemail1">Aadhar No</label>
                            <input readonly type="email" class="form-control" id="Inputemail1" minlength="16" maxlength="16" onkeyup="this.value = this.value.replace(/[^0-9]/g, '')" placeholder="Enter your Aadhar" value="<?php echo $aadhar; ?>">
                        </div>
                        <button  class="btn btn-success w-100">Verified</button>
                    <?php
                    } else {
                    ?>
                        <div class="form-group mb-4">

                            <label class="form-label" for="aadhar">Aadhar No</label>
                            <input type="text" class="form-control" id="aadhar" name="aadhar" minlength="16" maxlength="16" onkeyup="this.value = this.value.replace(/[^0-9]/g, '')" placeholder="Enter your Aadhar" value="<?php echo $aadhar; ?>">
                        </div>

                        
                        <div id="otp-box" style="display:none" class="form-group mb-4">

                            <label class="form-label" for="aadhar-otp">Enter OTP</label>
                            <input type="text" class="form-control" id="aadhar-otp" name="aadhar-otp" minlength="16" maxlength="16" onkeyup="this.value = this.value.replace(/[^0-9]/g, '')" placeholder="Enter OTP">
                        </div>

                        <button id="sendOtpBtn" onclick="sendAadharOtp()" type="menu" class="btn theme-btn w-100">Verify</button>
                        <button id="verifyOtpButton" style="display: none;" onclick="verifyOtp()" type="menu" class="btn theme-btn w-100">Submit OTP</button>
                        
                    <?php
                    }
                    ?>


                </div>
                <hr>
                <br>
                <h3 class="text-center profile-name">Update Profile</h3>
                <form action="operations/update_profile.php" class="auth-form" method="post">
                    <div class="form-group mt-0">
                        <label class="form-label mb-2" for="Inputname">User Name</label>
                        <input type="text" class="form-control" id="Inputname" name="username" placeholder="Enter your name" value="<?php echo $username; ?>">
                    </div>

                    <div class="form-group">
                        <label class="form-label mb-2" for="Inputnumner">Mobile Number</label>
                        <input type="number" class="form-control" id="Inputnumner" name="mobile" placeholder="Enter your number" value="<?php echo $mobile; ?>" readonly="true">
                    </div>

                    <div class="form-group">
                        <label class="form-label mb-2" for="Inputemail">Email</label>
                        <input type="email" class="form-control" id="Inputemail" name="email" placeholder="Enter your email" value="<?php echo $email; ?>">
                    </div>




                    <button type="submit" name="submit" class="btn theme-btn w-100 auth-btn">Update</button>
                </form>
                <hr>

            </div>
        </div>
    </div>
    <!-- setting section starts -->

   <!-- Jquery Cdn Link  -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- swal fire  -->

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script> 
    function sendAadharOtp(){
        // using ajax 

        var aadhar = document.getElementById('aadhar').value;
        var data = {
            aadhar: aadhar,
        }
        
        $.ajax({
            url: 'operations/send_aadhar_otp.php',
            type: 'POST',
            data: data,
            success: function(response){
                console.log(response);
                var res = JSON.parse(response);
                if(res[0].status == 'success'){
                    document.getElementById('otp-box').style.display = 'block';
                    document.getElementById('sendOtpBtn').style.display = 'none';
                    document.getElementById('verifyOtpButton').style.display = 'block';

                   swal.fire({
                        title: 'Success',
                        text: res[0].message,
                        icon: 'success',
                        confirmButtonText: 'Ok'
                    });
                }else{
                    swal.fire({
                        title: 'Error',
                        text: res[0].message,
                        icon: 'error',
                        confirmButtonText: 'Ok'
                    });
                }
            }
        });

    }

    function verifyOtp(){
        var otp = document.getElementById('aadhar-otp').value;
        var data = {
            otp: otp,
        }
        
        $.ajax({
            url: 'operations/verify_aadhar_otp.php',
            type: 'POST',
            data: data,
            success: function(response){
                console.log(response);
                var res = JSON.parse(response);
                if(res[0].status == 'success'){
                    swal.fire({
                        title: 'Success',
                        text: res[0].message,
                        icon: 'success',
                        confirmButtonText: 'Ok'
                    });
                    // location.reload();
                }else{
                    swal.fire({
                        title: 'Error',
                        text: res[0].message,
                        icon: 'error',
                        confirmButtonText: 'Ok'
                    });
                }
            }
        });

    }
    </script>

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