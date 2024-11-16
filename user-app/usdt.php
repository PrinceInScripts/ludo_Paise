<?php
include 'db.php';
include('includes/sessions.php');


?>
<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from themes.pixelstrap.com/pwa/taxify/user-app/finding-driver by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 01 Sep 2024 04:37:12 GMT -->

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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">


    <!-- Theme css -->
    <link rel="stylesheet" id="change-link" type="text/css" href="../assets/css/style.css">

    <!-- Swal Fire CDN  -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        .driver-list {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin-top: 20px;
        }

        .driver-box {
            width: 100%;
            background: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .driver-box table {
            width: 100%;
            border-collapse: collapse;
        }

        .driver-box table th {
            background: #f9f9f9;
            color: #292d32;
            font-weight: 500;
            padding: 10px 0;
            text-align: center;
        }

        .driver-box table td {
            padding: 10px 0;
            text-align: center;
            border-bottom: 1px solid #f9f9f9;
        }

        .driver-box table td:last-child {
            border-bottom: none;
        }

        .driver-box table th:last-child {
            border-bottom: none;
        }

        .driver-box table tr:last-child td {
            border-bottom: none;
        }

        .driver-box table tr:last-child th {
            border-bottom: none;
        }

        .driver-box table tr td {
            border-right: 1px solid #f9f9f9;
        }

        .driver-box table tr td:last-child {
            border-right: none;
        }

        .driver-box table tr th {
            border-right: 1px solid #f9f9f9;
        }

        .driver-box table tr th:last-child {
            border-right: none;
        }

        .driver-box table tr td:first-child {
            border-left: 1px solid #f9f9f9;
        }

        .driver-box table tr th:first-child {
            border-left: 1px solid #f9f9f9;
        }

        .driver-box table tr td:last-child {
            border-right: 1px solid #f9f9f9;
        }

        .driver-box table tr th:last-child {
            border-right: 1px solid #f9f9f9;
        }

        .driver-box table tr td:first-child {
            border-left: 1px solid;
        }

        .card {
            display: block;
            margin: auto;
            width: 90%;
            /* height: 100px; */
            aspect-ratio: 1/1;
            border-radius: 10px;
            background: #e0e0e0;
            box-shadow: 15px 15px 30px #bebebe,
                -15px -15px 30px #ffffff;
        }

        .card img {
            width: 90%;
            display: block;
            margin: 5% auto;
        }

        .card p {
            text-align: center;
            font-size: 1rem;
            font-weight: 600;
        }

        .game-container {
            display: flex;
            justify-content: space-around;
            margin-top: 30px;
        }

        .driver-list {
            margin-top: 0;
        }

        .driver-request .driver-list {
            padding-top: 0;
        }

        .driver-request .driver-list li {
            padding-top: 0;
        }
    </style>

</head>

<body>
    <div id="top"></div>
    <!-- header starts -->
    <header id="header" class="main-header inner-page-header">
        <div class="custom-container">
            <div class="header-panel">
                <a href="home">
                    <i class="iconsax icon-btn" data-icon="chevron-left"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15.0013 20.6695C14.8113 20.6695 14.6213 20.5995 14.4713 20.4495L7.95125 13.9295C6.89125 12.8695 6.89125 11.1295 7.95125 10.0695L14.4713 3.54953C14.7613 3.25953 15.2413 3.25953 15.5312 3.54953C15.8212 3.83953 15.8212 4.31953 15.5312 4.60953L9.01125 11.1295C8.53125 11.6095 8.53125 12.3895 9.01125 12.8695L15.5312 19.3895C15.8212 19.6795 15.8212 20.1595 15.5312 20.4495C15.3813 20.5895 15.1912 20.6695 15.0013 20.6695Z" fill="#292D32"></path>
                        </svg>
                    </i>
                </a>

                <h3 class="fw-semibold title-color">Add Funds</h3>
            </div>
        </div>
    </header>
    <!-- header end -->

    <?php

    $user_id = $_SESSION['id'];
    if (isset($_GET['txn_id'])) {
        $txn_id = $_GET['txn_id'];
        $sql = "SELECT * FROM paymenthistory WHERE order_id = '$txn_id' AND userid = '$user_id' AND utr is null AND payment_ss is null ";
        $result = mysqli_query($con, $sql);
        $payment = mysqli_fetch_assoc($result);
        $count = mysqli_num_rows($result);
        if ($count == 0) {
            // swal alert and redirect to payment page
    ?>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Payment Not Found',
                    text: 'Payment not found. Please make payment first!',
                    showConfirmButton: false,
                    timer: 1500
                }).then(function() {
                    window.location.href = './payment';
                });
            </script>
            <?php
        } else {
            if ($payment['status'] == 1) {
                // swal alert and redirect to payment page
            ?>
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Payment Success',
                        text: 'Payment Already Received!',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function() {
                        window.location.href = './payment';
                    });
                </script>
            <?php
            } elseif ($payment['status'] == 2) {
                // swal alert and redirect to payment page
            ?>
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Payment Failed',
                        text: 'Payment has been failed. Please try again!',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function() {
                        window.location.href = './payment';
                    });
                </script>
            
    <?php
            } else {
                $usdt = $payment['upi'];
                $amount = $payment['amount'];
                $upi_data = urlencode("TF3seZLkjNnHBWGPCTKyDPmD7ZTUfzmKeQ");
                $qr_img = "https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=" . $upi_data;
            }
        }
    } else {
        header('Location: ./payment');
    }

    ?>

    <!-- finding driver list starts -->
    <section class="driver-request section-b-space">
        <div class="custom-container">

            <div class="condition-part">
                <h4 class="fw-semibold title-color">Step 1 :</h4>
                <ul class="condition-list">
                    <li>
                        <h5>Scan QR</h5>
                        <p>Scan qr code or copy upi id on clicking on below button</p>
                    </li>
                    <li>
                        <h5>Pay Amount</h5>
                        <p>Pay the requested amount</p>
                    </li>
                </ul>
            </div>

            <ul class="driver-list">
                <li>
                    <div class="game-container">
                        <div class="card">
                            <img src="<?= $qr_img ?>" alt="">
                        </div>
                    </div>
                </li>
            </ul>
            <br>
            <div class="form-group mt-0">
                <label class="form-label mb-2" for="upiId">USDT Address :</label>
                <input type="text" class="form-control" id="upiId" value="<?= $usdt ?>" disabled>
            </div>

            <div class="grid-btn mt-4">
                <button onclick="copyUPI()" class="btn btn-primary w-100 m-0">Copy USDT Address</button>
            </div>
            <div class="condition-part">
                <h4 class="fw-semibold title-color">Step 2 :</h4>
                <ul class="condition-list">
                    <li>
                        <h5>Upload Payment Proof</h5>
                        <p>Upload your payment Screenshot</p>
                    </li>
                    <li>
                        <h5>Match Blockchain Network </h5>
                        <p>TRC 20 (Tron)</p>
                    </li>
                </ul>
            </div>
            <div>
                <form class="auth-form" enctype="multipart/form-data">
                    <div class="form-group mt-0">
                        <label class="form-label mb-2" for="ss">Upload Screenshot : <span style="color:red">* <sup>(Required)</sup></span></label>
                        <input type="file" class="form-control" name="ss" id="ss">
                        <input type="hidden" class="form-control" name="txn_id" id="txn_id" value="<?= $_GET['txn_id'] ?>">
                    </div>
                    <br>
                  
                    <br>

                    <div onclick="uploadRef()" name="submit" class="btn theme-btn w-100 auth-btn">UPLOAD</div>
                </form>
            </div>
        </div>
    </section>



    <!-- finding driver list end -->

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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        function uploadRef() {
            // submit form with upload screenshot and reference no using ajax

          

            // Get the uploaded screenshot file
            var ss = document.getElementById("ss").files[0];

            // Check if screenshot is empty
            if (ss == undefined) {
                // Show SweetAlert error message
                Swal.fire({
                    icon: 'error',
                    title: 'Screenshot Required',
                    text: 'Please upload the payment screenshot!',
                    showConfirmButton: false,
                    timer: 1500
                });
                return;
            }

            // submit form using ajax to upload screenshot and reference no to gateway/upload_ref.php $.ajax 

            $.ajax({
                url: './gateway/upload_ref.php',
                type: 'POST',
                data: new FormData($('.auth-form')[0]),
                contentType: false,
                cache: false,
                processData: false,
                success: function(response) {
                    // Check if response is success
                    if (response == 'success') {
                        // Show SweetAlert success message
                        Swal.fire({
                            icon: 'success',
                            title: 'Payment Proof Uploaded',
                            text: 'Payment proof has been uploaded successfully!',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(function() {
                            // Redirect to payment page
                            window.location.href = './payment';
                        });
                    } else {
                        // Show SweetAlert error message
                        Swal.fire({
                            icon: 'error',
                            title: 'Error in Uploading',
                            text: 'Error in uploading payment proof. Please try again!',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                }
            });






        }

        function copyUPI() {
            // Get the UPI ID value from the disabled input field
            var upiId = document.getElementById("upiId").value;

            // Create a temporary input element to copy the text
            var tempInput = document.createElement("input");
            tempInput.value = upiId;
            document.body.appendChild(tempInput);
            tempInput.select();
            document.execCommand("copy");
            document.body.removeChild(tempInput);

            // Show SweetAlert success message
            Swal.fire({
                icon: 'success',
                title: 'UPI ID Copied',
                text: 'UPI ID has been copied successfully!',
                showConfirmButton: false,
                timer: 1500
            });
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>


<!-- Mirrored from themes.pixelstrap.com/pwa/taxify/user-app/finding-driver by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 01 Sep 2024 04:37:12 GMT -->

</html>