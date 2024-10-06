<?php
include 'db.php';

if (!isset($_SESSION['id'])) {
    header('Location: login');
    exit();
}

$user_id = $_SESSION['id'];

$sql = "SELECT * FROM users WHERE id = '$user_id'";
$result = mysqli_query($con, $sql);
$user = mysqli_fetch_assoc($result);

$withdrawable_balance = $user['withdraw_wallet'];

?>
<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from themes.pixelstrap.com/pwa/taxify/user-app/finding-driver by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 01 Sep 2024 04:37:12 GMT -->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="taxify">
    <meta name="referrer" content="no-referrer">
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">


    <!-- Theme css -->
    <link rel="stylesheet" id="change-link" type="text/css" href="../assets/css/style.css">
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

        .buttons {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            margin-top: 20px;
        }

        .buttons .single-button {
            display: flex;
            justify-content: space-between;
            width: 100%;
        }

        .buttons .single-button button {
            width: 100%;
            margin: 5px;
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

                <h3 class="fw-semibold title-color">Withdraw Funds</h3>
            </div>
        </div>
    </header>
    <!-- header end -->

    <!-- finding driver list starts -->
    <section class="driver-request section-b-space">
        <?php
        $sql = "SELECT * FROM withdraw_modes WHERE status = 1";
        $check = mysqli_query($con, $sql);
        ?>
        <div class="custom-container">
            <ul class="driver-list">
                <li>
                    <div class="form-group mt-0">
                        <label class="form-label mb-2" for="upiId">Withdrawal Amount :</label>
                        <div class="form-control"><?= $withdrawable_balance ?></div>
                    </div>
                    <br>
                    <form action="" class="auth-form">
                        <div class="form-group mt-0">
                            <label class="form-label mb-2" for="upiId">Amount :</label>
                            <input type="number" class="form-control" id="amount" placeholder="Enter Amount">
                        </div>
                    </form>


                </li>

            </ul>

            <br>
            <h3 class="fw-semibold title-color text-center">Choose Method</h3>
            <br>
            <ul class="payment-method-list pt-0">
                <?php


                    while ($row = mysqli_fetch_assoc($check)) {
                    ?>
                        <li class="w-100">
                            <div class="payment-list-box">
                                <label class="form-check-label" for="flexRadioDefault"> <img class="img-fluid img"
                                        src="<?= $row['icon'] ?>" alt="mastercard"> <?= $row['pay_name'] ?></label>
                                <input class="form-check-input" id="<?= $row['slug'] ?>" type="radio" name="flexRadioDefault" id="flexRadioDefault">
                            </div>
                        </li>
                <?php
                    }
              


                ?>
            </ul>


            <?php
            if (mysqli_num_rows($check) == 0) {
            ?>
            <div class="grid-btn mt-2">
                <button style="cursor:not-allowed;opacity:0.5" onclick="this.onclick=null" class="btn btn-secondary w-100 m-0">Not Payment Method Available</button>
            </div>
            <?php
            } else {
            ?>
                <div class="grid-btn mt-4">
                    <button onclick="initiateWithdraw()" class="btn btn-primary w-100 m-0">Withdraw</button>
                </div>
            <?php
            }
            ?>

            <div class="condition-part">
                <h4 class="fw-semibold title-color">Notice :</h4>
                <ul class="condition-list">
                    <li>
                        <h5>Minimum Withdraw</h5>
                        <p>Minimum Withdraw is 1000 INR</p>
                    </li>
                    <li>
                        <h5>Withdraw Frequency </h5>
                        <p>You can place only 3 Withdraw in a day.</p>
                    </li>
                </ul>
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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        function setAmount(value) {
            document.getElementById("amount").value = value;
        }

        function initiateWithdraw() {
            var amount = document.getElementById("amount").value;
            var payment_mode = document.querySelector('input[name="flexRadioDefault"]:checked').id;
            if (amount == "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Please enter amount',
                });
                return;
            }
            if (payment_mode == "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Please select payment mode',
                });
                return;
            }

            // Ajax Payment Link Generation and Redirect to Payment Gateway Page 

            $.ajax({
                url: 'gateway/withdraw', // Ensure this URL is correct and accessible
                type: 'POST', // Use uppercase for HTTP methods (optional but recommended)
                data: {
                    amount: amount,
                    payment_mode: payment_mode
                },
                dataType: 'json', // Expecting JSON response from the server
                beforeSend: function() {
                    // Show SweetAlert2 loading modal
                    Swal.fire({
                        title: 'Processing Payment...',
                        text: 'Please wait while we process your payment.',
                        allowOutsideClick: false, // Prevent closing by clicking outside
                        didOpen: () => {
                            Swal.showLoading(); // Show the loading spinner
                        }
                    });
                },
                success: function(response) {
                    // Close the loading modal
                    Swal.close();

                    // Check the response status
                    if (response.status === 'success') {
                        // Optionally, you can show a success message before redirecting
                        Swal.fire({
                            icon: 'success',
                            title: 'Withdraw Initiated',
                            text: 'Redirecting to history page...',
                            timer: 2000, // Close after 2 seconds
                            showConfirmButton: false
                        }).then(() => {
                            // Redirect to the payment link
                            window.location.href = response.url;
                        });
                    } else {
                        // Show error message returned from the server
                        Swal.fire({
                            icon: 'error',
                            title: 'Payment Failed',
                            text: response.message || 'An unknown error occurred.',
                        }).then(() => {
                            // Redirect to the payment link
                            window.location.href = response.url;
                        });
                    }
                },
                error: function(xhr, status, error) {
                    // Close the loading modal
                    Swal.close();

                    // Log the error for debugging (optional)
                    console.error('AJAX Error:', status, error);

                    // Show a generic error message
                    Swal.fire({
                        icon: 'error',
                        title: 'Request Failed',
                        text: 'There was a problem processing your payment. Please try again later.',
                    });
                }
            });

        }
    </script>
</body>


<!-- Mirrored from themes.pixelstrap.com/pwa/taxify/user-app/finding-driver by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 01 Sep 2024 04:37:12 GMT -->

</html>