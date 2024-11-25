<?php
include 'db.php';
include('includes/sessions.php');

if (!isset($_GET['txn_id'])) {
    header('location: payment');
} else {
    $txn_id = $_GET['txn_id'];
    $txn = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM paymenthistory WHERE order_id = '$txn_id'"));
}


$user_id = $_SESSION['id'];
$query = "SELECT * FROM users WHERE id = '$user_id'";
$run = mysqli_query($con, $query);
$data = mysqli_fetch_assoc($run);
$wallet = $data['deposit_wallet'] + $data['withdraw_wallet'];
$setting = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM settings WHERE id = 1"));

// deposit information 
$deposit = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM manual_deposit ORDER BY id DESC LIMIT 1"));
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

        .card p {
            font-size: 0.8rem;
            text-align: left;
            margin-left: 10px;
        }

        .badge-primary {
            color: #fff;
            background-color: #007bff;
        }

        .badge-dark {
            color: #fff;
            background-color: #343a40;
        }

        .badge-success {
            color: #fff;
            background-color: #28a745;
        }

        .badge-danger {
            color: #fff;
            background-color: #dc3545;
        }

        .badge-warning {
    color: #212529;
    background-color: #ffc107;
}
    </style>
<!-- swal fire cdn  -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>

    <?php
    if ($txn['status'] == 1) {
    ?>
        <script>
            Swal.fire({
                icon: "success",
                title: "Success",
                text: "Payment Successful",
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "history";
                }
            })
        </script>
    <?php
    } elseif ($txn['status'] == 2) {
    ?>
        <script>
            Swal.fire({
                icon: "error",
                title: "Failed",
                text: "Payment Failed",
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "payment";
                }
            })
        </script>
    <?php
    }
    ?>




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

    <div class="container mt-5">
        <!-- Withdraw Notice Alert Box -->
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Notice:</strong> कृपया सटीक राशि (<?=$txn['amount'] ?> INR) जमा करें। कोई भी अतिरिक्त राशि जमा न करें. आपका भुगतान 24 घंटों के भीतर स्वीकृत हो जाएगा और आसान अनुमोदन प्राप्त करने के लिए टिप्पणी (Remark) जोड़ना न भूलें।
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>



    <!-- finding driver list starts -->
    <section class="driver-request section-b-space">
        <div class="custom-container">
            <ul class="driver-list">
                <li>
                    <!-- bank deposit information with copy button indivisual  -->

                    <div class="card">
                        <img src="https://cdn-icons-png.flaticon.com/512/2830/2830289.png" style="width: 40%;" alt="bank">
                        <p>Bank Name: <span class="badge badge-primary"><?= $deposit['bank_name'] ?></span> </p>
                        <p>Ac Holder Name: <span class="badge badge-dark"><?= $deposit['ac_holder'] ?></span> </p>
                        <p>Account No: <span class="badge badge-success"><?= $deposit['ac'] ?></span> </p>
                        <p>IFSC Code: <span class="badge badge-danger"><?= $deposit['ifsc'] ?></span> </p>
                        <p>Remark: <span class="badge badge-warning"><?= $txn['order_id'] ?></span> </p>
                        <br>
                        <h3 style="text-align: center;">Amount: <span class="badge badge-success"><?= $txn['amount'] ?> INR</span> </h3>
                        <div class="buttons">
                            <div class="single-button">
                                <button class="p-2 btn gray-btn" onclick="copyToClipboard('<?= $deposit['bank_name'] ?>')">Copy Bank Name</button>

                            </div>
                            <div class="single-button">
                                <button class="p-2 btn gray-btn" onclick="copyToClipboard('<?= $deposit['ac_holder'] ?>')">Copy Account Holder Name</button>
                            </div>
                            <div class="single-button">
                                <button class="p-2 btn gray-btn" onclick="copyToClipboard('<?= $deposit['ac'] ?>')">Copy Account No</button>

                            </div>
                            <div class="single-button">

                                <button class="p-2 btn gray-btn" onclick="copyToClipboard('<?= $deposit['ifsc'] ?>')">Copy IFSC Code</button>
                            </div>
                            <div class="single-button">

                                <button class="p-2 btn gray-btn" onclick="copyToClipboard('<?= $txn['order_id'] ?>')">Copy Remark</button>
                            </div>
                        </div>
                    </div>




                </li>

            </ul>

            <br>
            <br>
            <h3 class="fw-semibold title-color text-center">Submit UTR</h3>
            <br>

            <div>

                <?php
                if ($txn['status'] == 0 && $txn['utr'] == '') {
                ?>

                    <form class="auth-form" enctype="multipart/form-data">
                        <!-- <div class="form-group mt-0">
                        <label class="form-label mb-2" for="ss">Upload Screenshot : <span style="color:red">* <sup>(Required)</sup></span></label>
                        <input type="file" class="form-control" name="ss" id="ss">
                        <input type="hidden" class="form-control" name="txn_id" id="txn_id" value="">
                    </div>
                    <br> -->
                        <div class="form-group mt-0">
                            <label class="form-label mb-2" for="utr">Enter UTR : <span style="color:red">* <sup>(Required)</sup> </span></label>
                            <input type="number" class="form-control" name="utr" id="utr" placeholder="Enter Bank Reference Number">
                            <input type="hidden" class="form-control" name="txn_id" id="txn_id" value="<?= $_GET['txn_id'] ?>">
                        </div>
                        <br>

                        <div onclick="uploadRef()" name="submit" class="btn theme-btn w-100 auth-btn">UPLOAD</div>
                    </form>
                <?php
                } elseif ($txn['status'] == 0 && $txn['utr'] != '') {
                ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Notice:</strong> Your Payment is Pending. Please Wait for Admin Approval.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php
                }

                ?>


            </div>

        </div>
    </section>

    <script>
        function uploadRef() {
            var utr = $('#utr').val();
            var txn_id = $('#txn_id').val();
            if (utr == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Please Enter UTR',
                })
            } else {
                $.ajax({
                    url: 'operations/updateBankStatus.php',
                    type: 'POST',
                    data: {
                        utr: utr,
                        txn_id: txn_id
                    },
                    success: function(data) {
                        var response = JSON.parse(data);
                        if (response.status == 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: response.message,
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = 'payment';
                                }
                            })
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: response.message,
                            })
                        }
                    }
                })
            }
        }
    </script>



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
        function copyToClipboard(text) {
            var input = document.createElement('input');
            input.setAttribute('value', text);
            document.body.appendChild(input);
            input.select();
            var result = document.execCommand('copy');
            document.body.removeChild(input);
            if (result) {
                Swal.fire({
                    icon: 'success',
                    title: 'Copied',
                    text: 'Bank Details Copied Successfully',
                })
            }
        }
    </script>
</body>


<!-- Mirrored from themes.pixelstrap.com/pwa/taxify/user-app/finding-driver by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 01 Sep 2024 04:37:12 GMT -->

</html>