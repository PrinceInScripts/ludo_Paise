<?php
include './db.php';
include('includes/sessions.php');
$userid = $_SESSION['id'];
$query = "SELECT * FROM users WHERE id = '$userid'";
$run = mysqli_query($con, $query);
$data = mysqli_fetch_assoc($run);
$wallet = $data['deposit_wallet'] + $data['withdraw_wallet'];

?>

<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from themes.pixelstrap.com/pwa/taxify/user-app/rental-vehicle-details by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 01 Sep 2024 04:37:14 GMT -->

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
    <style>
        .wallet-amount {
            font-size: 2.5rem;
            text-align: center;
            padding: 14px;
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
                <h3>Wallet</h3>
            </div>
        </div>
    </header>
    <!-- header end -->
    <section class="driver-request section-b-space">
        <div class="custom-container">
            <ul class="driver-list">
                <li>
                    <div class="driver-box outstation-driver-box">
                        <div class="profile-head">
                            <div class="d-flex align-items-center gap-2">
                                <img class="img-fluid profile-img" src="https://cdn-icons-png.flaticon.com/512/1041/1041888.png" alt="profile">
                                <h5>Deposit Balance</h5>
                            </div>

                        </div>
                        <h4 class="wallet-amount fw-semibold success-color navbar-expand">₹ <?= $data['deposit_wallet'] ?></h4>
                        <div class="grid-btn mt-2">

                            <a href="payment" class="btn theme-btn w-100 m-0">Recharge</a>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="driver-box outstation-driver-box">
                        <div class="profile-head">
                            <div class="d-flex align-items-center gap-2">
                                <img class="img-fluid profile-img" src="https://cdn-icons-png.flaticon.com/512/1041/1041888.png" alt="profile">
                                <h5>Withdrawal Balance</h5>
                            </div>

                        </div>
                        <h4 class="wallet-amount fw-semibold success-color navbar-expand">₹ <?= $data['withdraw_wallet'] ?></h4>
                        <div class="grid-btn mt-2">
                            <a href="withdraw" class="btn gray-btn w-100 m-0">Withdraw</a>
                            <button onclick="convert()" class="btn theme-btn w-100 m-0">Convert</button>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </section>
    <!-- vehicle details section starts -->
    <section class="section-b-space">

        <div class="vehicle-content">
            <div class="content-title">
                <h4 class="fw-semibold title-color">Withdrawal Notice</h4>
                <div class="d-flex align-items-center gap-1">
                    <img class="img-fluid members" src="https://themes.pixelstrap.com/pwa/taxify/assets/images/svg/profile-fill.svg" alt="profile">
                    <h5 class="fw-medium title-color">8</h5>
                </div>
            </div>
            <ul class="details-list">
                <li>
                    <h5>9:00 am to 11:00 am</h5>
                    <h6>Withdraw within the time limit.</h6>
                </li>
                <li>
                    <h5>2 Withdrawal per day</h5>
                    <h6>You can only place 2 Withdrawal in a day</h6>
                </li>
            </ul>

        </div>
        <div class="condition-part">
            <h4 class="fw-semibold title-color">Policies & fees</h4>
            <ul class="condition-list">
                <li>
                    <h5>Tolls and surcharges</h5>
                    <p>Any additional charges will be billed after your deposit is completed.</p>
                </li>
                <li>
                    <h5>Non refundable fare</h5>
                    <p>You’ll be charged the full upfront amount even if your bids is against the result</p>
                </li>
            </ul>
        </div>
    </section>
    <!-- vehicle details section end -->



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

            <li class="active">
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

    <!-- sweetalert js -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
        function convert() {
            Swal.fire({
                title: 'Convert Withdrawal Money to Deposit Money',
                input: 'text',
                inputLabel: 'Enter Amount',
                inputAttributes: {
                    autocapitalize: 'off'
                },
                showCancelButton: true,
                confirmButtonText: 'Convert',
                showLoaderOnConfirm: true,
                preConfirm: (amount) => {
                    return fetch(`convert.php?amount=${amount}`)
                        .then(response => {
                            if (!response.ok) {
                                throw new Error(response.statusText)
                            }
                            return response.json()
                        })
                        .catch(error => {
                            Swal.showValidationMessage(
                                `Request failed: ${error}`
                            )
                        })
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
    if (result.isConfirmed) {
        const response = result.value; // Get the response from the fetch call
        if (response.success) {
            Swal.fire({
                title: response.message, // Use the success message from the response
                icon: 'success'
            });
        } else {
            Swal.fire({
                title: 'Error',
                text: response.message, // Show error message if conversion fails
                icon: 'error'
            });
        }
    }
});







        }
    </script>

</body>


<!-- Mirrored from themes.pixelstrap.com/pwa/taxify/user-app/rental-vehicle-details by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 01 Sep 2024 04:37:14 GMT -->

</html>