<?php
include 'db.php';
include('includes/sessions.php');


$user_id = $_SESSION['id'];
$query = "SELECT * FROM users WHERE id = '$user_id'";
$run = mysqli_query($con, $query);
$data = mysqli_fetch_assoc($run);
$wallet = $data['deposit_wallet'] + $data['withdraw_wallet'];
$setting = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM settings WHERE id = 1"));
?>
<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from themes.pixelstrap.com/pwa/taxify/user-app/finding-driver by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 01 Sep 2024 04:37:12 GMT -->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="ludopaisa">
    <meta name="referrer" content="no-referrer">
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
    <link rel="stylesheet" id="change-link" type="text/css" href="../assets/css/style2.css">
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
                <a href="payment">
                    <div class="add-cash-button">
                        <div class="add-cash-content">
                            <p>Add cash</p>
                            <p>₹<?php echo $wallet ?> </p>
                        </div>
                        <div class="add-cash-circle">
                            +
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </header>
    <!-- header end -->

    <?php
    if ($setting['deposit_msg'] == '') {
    } else {
    ?>
        <div class="container mt-5">
            <!-- Withdraw Notice Alert Box -->
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Notice:</strong> <?= $setting['deposit_msg'] ?>.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    <?php
    }
    ?>



    <!-- finding driver list starts -->
    <section class="driver-request section-b-space">
        <div class="custom-container">
            <ul class="driver-list">
                <li>
                    <form action="" class="auth-form">
                        <div class="form-group mt-0">
                            <label class="form-label mb-2" for="upiId">Amount :</label>
                            <input type="number" class="form-control" id="amount" placeholder="Enter Amount">
                        </div>
                    </form>
                    <div class="buttons">
                        <div class="single-button">
                            <button type="button" class="p-2 btn gray-btn" onclick="setAmount(500)">500</button>
                            <button type="button" class="p-2 btn gray-btn" onclick="setAmount(1000)">1000</button>
                            <button type="button" class="p-2 btn gray-btn" onclick="setAmount(2500)">2500</button>
                            <button type="button" class="p-2 btn gray-btn" onclick="setAmount(5000)">5000</button>
                            <button type="button" class="p-2 btn gray-btn" onclick="setAmount(10000)">10000</button>
                        </div>
                        <div class="single-button">
                            <button type="button" class="p-2 btn gray-btn" onclick="setAmount(20000)">20000</button>
                            <button type="button" class="p-2 btn gray-btn" onclick="setAmount(25000)">25000</button>
                            <button type="button" class="p-2 btn gray-btn" onclick="setAmount(30000)">30000</button>
                            <button type="button" class="p-2 btn gray-btn" onclick="setAmount(50000)">50000</button>
                            <button type="button" class="p-2 btn gray-btn" onclick="setAmount(100000)">100000</button>
                        </div>
                    </div>


                </li>

            </ul>

            <br>
            <h3 class="fw-semibold title-color text-center">Choose Method</h3>
            <br>
            <ul class="payment-method-list pt-0">
                <?php
                $i = 1;
                $sql = "SELECT * FROM payment_modes WHERE status = 1";
                $result = mysqli_query($con, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                    <li class="w-100">
                        <div class="payment-list-box">
                            <label class="form-check-label" for="flexRadioDefault"> <img class="img-fluid img"
                                    src="<?= $row['icon'] ?>" alt="mastercard"> <?= $row['pay_name'] ?></label>
                            <input class="form-check-input" id="<?= $row['slug'] ?>" type="radio" name="flexRadioDefault">
                        </div>
                    </li>
                <?php
                $i++;
                }

                ?>
            </ul>


            <div class="grid-btn mt-4">
                <button onclick="initiatePayment()" class="btn btn-primary w-100 m-0">Proceed to Pay</button>
            </div>
            <div class="condition-part">
                <h4 class="fw-semibold title-color">Notice :</h4>
                <ul class="condition-list">
                    <li>
                        <h5>Minimum Recharge</h5>
                        <p>Minimum Recharge is <?= $setting['minRecharge'] ?> INR</p>
                    </li>
                    <li>
                        <h5>Fill UTR </h5>
                        <p>Enter your UTR no. After payment</p>
                    </li>
                </ul>
            </div>

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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        function setAmount(value) {
            console.log("Amount set to:");

            document.getElementById("amount").value = value;
        }

        function initiatePayment() {
            var amount = document.getElementById("amount").value;
            
            var payment_mode = document.querySelector('input[name="flexRadioDefault"]:checked');

            var kyc = <?= $data['kyc_status'] ?>;

            
          
          
         
            if (kyc == 0 && amount > 10000) {
           
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Please complete KYC first to make payment more than 500 INR',
                }).then(() => {
                    window.location.href = 'profile';
                });
                return;
          
            }

           
           

           
            if (amount == null || amount == "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Please enter amount',
                });
                return;
            }
            if (payment_mode) {
                payment_mode = payment_mode.id;
                
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Please select payment mode',
                });
                return;
            }

            // Ajax Payment Link Generation and Redirect to Payment Gateway Page 

            $.ajax({
                url: 'gateway/payment_link', // Ensure this URL is correct and accessible
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
                            title: 'Payment Initiated',
                            text: 'Redirecting to payment page...',
                            timer: 1000, // Close after 2 seconds
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