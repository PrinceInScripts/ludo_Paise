<?php
include 'db.php';
include('includes/sessions.php');
// fetch back details from db
$user_id = $_SESSION['id'];
$sql = "SELECT * FROM bankdetails WHERE userid = '$user_id'";
$run = mysqli_query($con, $sql);
$fetch = mysqli_fetch_assoc($run);

$checkKycStatus = "SELECT * FROM users WHERE id = '$user_id'";
$runCheck = mysqli_query($con, $checkKycStatus);
$fetchCheck = mysqli_fetch_assoc($runCheck);

?>

<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from themes.pixelstrap.com/pwa/taxify/user-app/bank-registration-details.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 01 Sep 2024 04:37:14 GMT -->

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
    <header id="header" class="main-header">
        <div class="custom-container">
            <div class="header-panel">
                <a onclick="history.back()">
                    <i class="iconsax icon-btn" data-icon="chevron-left"> </i>
                </a>
                <img class="img-fluid logo" src="../assets/images/logo/logo.png" alt="logo">
                <img class="img-fluid logo-dark" src="../assets/images/logo/logo-dark.png" alt="logo">
            </div>
        </div>
    </header>
    <!-- header end -->

    <!-- bank details section starts -->
    <section class="section-b-space pt-0">
        <div class="auth-content-bg">
            <div class="custom-container">
                <form class="auth-form mt-0 pt-2">
                    <?php
                    if (mysqli_num_rows($run) > 0) {
                    ?>
                        <div class="form-group mt-0">
                            <label class="form-label mb-2" for="Inputname">Bank Name</label>
                            <input type="text" class="form-control" id="Inputname" value="<?= $fetch['bank_name'] ?>"
                                placeholder="Enter bank name">
                        </div>
                        <div class="form-group ">
                            <label class="form-label mb-2" for="Inputholder">Bank Holder Name</label>
                            <input type="text" class="form-control" id="Inputholder" value="<?= $fetch['bank_holder'] ?>"
                                placeholder="Enter holder name">
                        </div>
                        <div class="form-group">
                            <label class="form-label mb-2" for="Inputnumner">Account No.</label>
                            <input type="number" class="form-control text-start" id="Inputnumner" value="<?= $fetch['bank_acc'] ?>"
                                placeholder="Enter your account no">
                        </div>

                        <div class="form-group">
                            <label class="form-label mb-2" for="Inputbranch">Branch Name</label>
                            <input type="text" class="form-control" id="Inputbranch" value="<?= $fetch['bank_branch'] ?>"
                                placeholder="Enter branch name">
                        </div>

                        <div class="form-group">
                            <label class="form-label mb-2" for="Inputcode">IFSC Code</label>
                            <input type="email" class="form-control text-start" id="Inputcode" value="<?= $fetch['bank_ifsc'] ?>"
                                placeholder="Enter ifsc code">
                        </div>
                        <div class="form-group">
                            <label class="form-label mb-2" for="Inputswift">UPI ID</label>
                            <input type="email" class="form-control text-start" id="Inputswift" value="<?= $fetch['upi'] ?>"
                                placeholder="Enter UPI">
                        </div>
                        <div class="fixed-btn">
                            <div class="custom-container">
                                <div onclick="bankUpdate()" class="btn theme-btn w-100 mt-0 auth-btn">Update</div>
                            </div>
                        </div>
                        <?php
                    } else {

                        if ($fetchCheck['kyc_status'] == 0) {
                        ?>
                            <div class="alert alert-danger" role="alert">
                                <strong>Alert!</strong> Please complete your KYC first.
                            </div>
                            <!-- complete kyc button  -->
                            <a href="profile" class="btn theme-btn w-100 mt-0 auth-btn">Complete KYC</a>
                        <?php

                        } else {

                        ?>
                            <div class="form-group mt-0">
                                <label class="form-label mb-2" for="Inputname">Bank Name</label>
                                <input type="text" class="form-control" id="Inputname"
                                    placeholder="Enter bank name">
                            </div>
                            <div class="form-group ">
                                <label class="form-label mb-2" for="Inputholder">Bank Holder Name</label>
                                <input type="text" class="form-control" id="Inputholder"
                                    placeholder="Enter holder name">
                            </div>
                            <div class="form-group">
                                <label class="form-label mb-2" for="Inputnumner">Account No.</label>
                                <input type="number" class="form-control text-start" id="Inputnumner"
                                    placeholder="Enter your account no">
                            </div>

                            <div class="form-group">
                                <label class="form-label mb-2" for="Inputbranch">Branch Name</label>
                                <input type="text" class="form-control" id="Inputbranch"
                                    placeholder="Enter branch name">
                            </div>

                            <div class="form-group">
                                <label class="form-label mb-2" for="Inputcode">IFSC Code</label>
                                <input type="email" class="form-control text-start" id="Inputcode"
                                    placeholder="Enter ifsc code">
                            </div>
                            <div class="form-group">
                                <label class="form-label mb-2" for="Inputswift">UPI ID</label>
                                <input type="email" class="form-control text-start" id="Inputswift"
                                    placeholder="Enter UPI">
                            </div>
                            <div class="fixed-btn">
                                <div class="custom-container">
                                    <div onclick="bankUpdate()" class="btn theme-btn w-100 mt-0 auth-btn">Update</div>
                                </div>
                            </div>
                    <?php
                        }
                    }
                    ?>

                </form>


            </div>
        </div>
    </section>
    <!-- bank details section end -->

    <!-- panel-space start -->
    <section class="panel-space"></section>
    <!-- panel-space end -->


    <!-- iconsax js -->
    <script src="../assets/js/iconsax.js"></script>

    <a href="https://api.whatsapp.com/send?phone=917042536431" class="Wfloat" target="_blank">
        <i class="fa fa-whatsapp myW-float" aria-hidden="true"></i>
    </a>

    <!-- bootstrap js -->
    <script src="../assets/js/bootstrap.bundle.min.js"></script>

    <!-- sticky-header js -->
    <script src="../assets/js/sticky-header.js"></script>

    <!-- template-setting js -->
    <script src="../assets/js/template-setting.js"></script>

    <!-- script js -->
    <script src="../assets/js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        function bankUpdate() {
            var bank_name = document.getElementById('Inputname').value;
            var bank_holder = document.getElementById('Inputholder').value;
            var bank_acc = document.getElementById('Inputnumner').value;
            var bank_branch = document.getElementById('Inputbranch').value;
            var bank_ifsc = document.getElementById('Inputcode').value;
            var upi = document.getElementById('Inputswift').value;

            var data = {
                bank_name: bank_name,
                bank_holder: bank_holder,
                bank_acc: bank_acc,
                bank_branch: bank_branch,
                bank_ifsc: bank_ifsc,
                upi: upi
            }

            $.ajax({
                url: 'operations/bank-update.php',
                method: 'post',
                data: data,
                success: function(response) {

                    // json parse 
                    var res = JSON.parse(response);
                    // swal.fire 
                    res = res[0];

                    if (res.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: res.message,
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        })
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: res.message,
                        })
                    }


                }
            })
        }
    </script>
</body>


<!-- Mirrored from themes.pixelstrap.com/pwa/taxify/user-app/bank-registration-details.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 01 Sep 2024 04:37:14 GMT -->

</html>