<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from themes.pixelstrap.com/pwa/taxify/user-app/add-new-rider.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 01 Sep 2024 04:37:14 GMT -->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
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

    <style>
        .challenges-container {
            display: flex;
            justify-content: space-around;
            align-items: center;
            padding: 40px 20px;
            margin: 10px 0;
        }

        .challenges {
            display: flex;
            flex-direction: column;
            justify-content: center;
            gap: 5px;
            margin-bottom: 20px;
        }

        .finding-player {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .timer-container {
            display: flex;
            flex-direction: column;
            font-size: 1em;
            margin-bottom: 20px;
            gap: 10px;
        }

        .loading-spinner {
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-top-color: #000;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin-right: 10px;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .driver-request .driver-list{
            padding: 0;
        }

        .driver-request .driver-list li {
            padding-top: 8px;
        }
    </style>
</head>

<body>
    <!-- header starts -->
    <header id="header" class="main-header inner-page-header">
        <div class="custom-container">
            <div class="header-panel">
                <a href="home.php">
                    <i class="iconsax icon-btn" data-icon="chevron-left"> </i>
                </a>

                <h3 class="fw-semibold title-color">Ludo Classic</h3>
            </div>
        </div>
    </header>
    <!-- header end -->

    <!-- new rider section start -->
    <section class="section-b-space">
        <div class="custom-container">
            <div class="theme-form ">
                <div class="grid-btn mt-4">
                    <a href="#0" class="btn theme-btn w-100 m-0">Create New Battle</a>
                </div>
                <!-- <p class="fw-normal content-color">Your device's address book will not contain this contact. </p> -->

                <div>
                    <div class="form-group">
                        <label class="form-label mb-2" for="Inputfirstname">Enter Amount</label>
                        <input type="text" class="form-control" id="Inputfirstname" placeholder="Amount should be multiple of 10">

                    </div>
                    <div class="grid-btn mt-4 col-6 mx-auto">
                        <a href="#0" class="btn btn-success w-100 m-0">Create Battle</a>
                    </div>
                </div>
                <hr>
                <div>

                </div>
            </div>
            <div class="theme-form ">
                <div class="grid-btn mt-4">
                    <a href="#0" class="btn theme-btn w-100 m-0">Open Battle</a>
                </div>
                <!-- <p class="fw-normal content-color">Your device's address book will not contain this contact. </p> -->

                <section class="pt-0 driver-request">
                    <div class="">
                        <ul class="driver-list">
                            <li>
                                <div class="driver-box">
                                    <div class="profile-head">
                                        <div class="d-flex align-items-center gap-2">
                                            <img class="img-fluid profile-img" src="../assets/images/profile/p8.png" alt="profile">
                                            <h5>Time Remaining : <span style="color:red"><span id="timer">89</span> Second</span></h5>
                                        </div>
                                        <h4 class="fw-semibold theme-color">
                                            <div class="spinner-border" role="status"></div>
                                        </h4>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mt-2">
                                        <h5 class="fw-normal title-color"><span><img src="https://cdn-icons-png.flaticon.com/512/6828/6828650.png" width="22" alt=""> </span> Entry Fee : </h5>

                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mt-2">
                                        <h5 class="fw-normal title-color"><span><img src="https://cdn-icons-png.flaticon.com/512/5984/5984518.png" width="20" alt=""> </span> Prize : </h5>

                                    </div>

                                    <div class="grid-btn mt-2">
                                        <a href="accept-ride-details.html" class="btn btn-danger w-100 m-0">Reject</a>
                                        <a href="accept-ride-details.html" class="btn btn-success w-100 m-0">Accept</a>
                                    </div>
                                    <div class="progress mt-2" role="progressbar">
                                        <div class="progress-bar w-25"></div>
                                    </div>
                                </div>
                            </li>
                            <hr>
                        </ul>

                        <ul class="driver-list">
                            <li>
                                <div class="driver-box">
                                    <div class="profile-head">
                                        <div class="d-flex align-items-center gap-2">
                                            <img class="img-fluid profile-img" src="../assets/images/profile/p8.png" alt="profile">
                                            <h5>Challange From <span style="color:red">xgTDD</span></h5>
                                        </div>
                                        <h4 class="fw-semibold theme-color">

                                        </h4>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mt-2">
                                        <h5 class="fw-normal title-color"><span><img src="https://cdn-icons-png.flaticon.com/512/6828/6828650.png" width="22" alt=""> </span> Entry Fee : </h5>

                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mt-2">
                                        <h5 class="fw-normal title-color"><span><img src="https://cdn-icons-png.flaticon.com/512/5984/5984518.png" width="20" alt=""> </span> Prize : </h5>

                                    </div>

                                    <div class="grid-btn mt-2">
                                        <a href="accept-ride-details.html" class="btn btn-secondary w-100 m-0">Play</a>
                                    </div>
                                    <div class="progress mt-2" role="progressbar">
                                        <div class="progress-bar w-25"></div>
                                    </div>
                                </div>
                            </li>
                            <hr>
                            <li>
                                <div class="driver-box">
                                    <div class="profile-head">
                                        <div class="d-flex align-items-center gap-2">
                                            <img class="img-fluid profile-img" src="../assets/images/profile/p8.png" alt="profile">
                                            <h5>Challange From <span style="color:red">xgTDD</span></h5>
                                        </div>
                                        <h4 class="fw-semibold theme-color">

                                        </h4>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mt-2">
                                        <h5 class="fw-normal title-color"><span><img src="https://cdn-icons-png.flaticon.com/512/6828/6828650.png" width="22" alt=""> </span> Entry Fee : </h5>

                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mt-2">
                                        <h5 class="fw-normal title-color"><span><img src="https://cdn-icons-png.flaticon.com/512/5984/5984518.png" width="20" alt=""> </span> Prize : </h5>

                                    </div>

                                    <div class="grid-btn mt-2">
                                        <a href="accept-ride-details.html" class="btn btn-secondary w-100 m-0">Play</a>
                                    </div>
                                    <div class="progress mt-2" role="progressbar">
                                        <div class="progress-bar w-25"></div>
                                    </div>
                                </div>
                            </li>
                            <hr>
                            <li>
                                <div class="driver-box">
                                    <div class="profile-head">
                                        <div class="d-flex align-items-center gap-2">
                                            <img class="img-fluid profile-img" src="../assets/images/profile/p8.png" alt="profile">
                                            <h5>Challange From <span style="color:red">xgTDD</span></h5>
                                        </div>
                                        <h4 class="fw-semibold theme-color">

                                        </h4>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mt-2">
                                        <h5 class="fw-normal title-color"><span><img src="https://cdn-icons-png.flaticon.com/512/6828/6828650.png" width="22" alt=""> </span> Entry Fee : </h5>

                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mt-2">
                                        <h5 class="fw-normal title-color"><span><img src="https://cdn-icons-png.flaticon.com/512/5984/5984518.png" width="20" alt=""> </span> Prize : </h5>

                                    </div>

                                    <div class="grid-btn mt-2">
                                        <a href="accept-ride-details.html" class="btn btn-secondary w-100 m-0">Play</a>
                                    </div>
                                    <div class="progress mt-2" role="progressbar">
                                        <div class="progress-bar w-25"></div>
                                    </div>
                                </div>
                            </li>
                            <hr>
                            <li>
                                <div class="driver-box">
                                    <div class="profile-head">
                                        <div class="d-flex align-items-center gap-2">
                                            <img class="img-fluid profile-img" src="../assets/images/profile/p8.png" alt="profile">
                                            <h5>Challange From <span style="color:red">xgTDD</span></h5>
                                        </div>
                                        <h4 class="fw-semibold theme-color">

                                        </h4>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mt-2">
                                        <h5 class="fw-normal title-color"><span><img src="https://cdn-icons-png.flaticon.com/512/6828/6828650.png" width="22" alt=""> </span> Entry Fee : </h5>

                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mt-2">
                                        <h5 class="fw-normal title-color"><span><img src="https://cdn-icons-png.flaticon.com/512/5984/5984518.png" width="20" alt=""> </span> Prize : </h5>

                                    </div>

                                    <div class="grid-btn mt-2">
                                        <a href="accept-ride-details.html" class="btn btn-secondary w-100 m-0">Play</a>
                                    </div>
                                    <div class="progress mt-2" role="progressbar">
                                        <div class="progress-bar w-25"></div>
                                    </div>
                                </div>
                            </li>
                            <hr>
                            <li>
                                <div class="driver-box">
                                    <div class="profile-head">
                                        <div class="d-flex align-items-center gap-2">
                                            <img class="img-fluid profile-img" src="../assets/images/profile/p8.png" alt="profile">
                                            <h5>Challange From <span style="color:red">xgTDD</span></h5>
                                        </div>
                                        <h4 class="fw-semibold theme-color">

                                        </h4>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mt-2">
                                        <h5 class="fw-normal title-color"><span><img src="https://cdn-icons-png.flaticon.com/512/6828/6828650.png" width="22" alt=""> </span> Entry Fee : </h5>

                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mt-2">
                                        <h5 class="fw-normal title-color"><span><img src="https://cdn-icons-png.flaticon.com/512/5984/5984518.png" width="20" alt=""> </span> Prize : </h5>

                                    </div>

                                    <div class="grid-btn mt-2">
                                        <a href="accept-ride-details.html" class="btn btn-secondary w-100 m-0">Play</a>
                                    </div>
                                    <div class="progress mt-2" role="progressbar">
                                        <div class="progress-bar w-25"></div>
                                    </div>
                                </div>
                            </li>
                            <hr>
                        </ul>
                    </div>
                </section>

              
                <div>

                </div>
            </div>

             <!-- Running Battle  -->

             <div class="theme-form ">
                <div class="grid-btn mt-4">
                    <a href="#0" class="btn theme-btn w-100 m-0">Running Battle</a>
                </div>
                <!-- <p class="fw-normal content-color">Your device's address book will not contain this contact. </p> -->

                <section class="pt-0 driver-request">
                    <div class="">
                        <ul class="driver-list">
                            <li>
                                <div class="driver-box">
                                    <div class="profile-head">
                                        <div class="d-flex align-items-center gap-2">
                                            <img class="img-fluid profile-img" src="../assets/images/profile/p8.png" alt="profile">
                                            <h5>Challange From <span style="color:red">xgTDD</span></h5>
                                        </div>
                                        <h4 class="fw-semibold theme-color">

                                        </h4>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mt-2">
                                        <h5 class="fw-normal title-color"><span><img src="https://cdn-icons-png.flaticon.com/512/6828/6828650.png" width="22" alt=""> </span> Entry Fee : </h5>

                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mt-2">
                                        <h5 class="fw-normal title-color"><span><img src="https://cdn-icons-png.flaticon.com/512/5984/5984518.png" width="20" alt=""> </span> Prize : </h5>

                                    </div>

                                    <div class="grid-btn mt-2">
                                        <a href="accept-ride-details.html" class="btn btn-secondary w-100 m-0">Play</a>
                                    </div>
                                    <div class="progress mt-2" role="progressbar">
                                        <div class="progress-bar w-25"></div>
                                    </div>
                                </div>
                            </li>
                            <hr>
                        </ul>
                    </div>
                </section>

                <hr>
                <div>

                </div>
            </div>


        </div>





    </section>
    <!-- new rider section end -->

    <!-- panel-space start -->
    <section class="panel-space"></section>
    <!-- panel-space end -->

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


<!-- Mirrored from themes.pixelstrap.com/pwa/taxify/user-app/add-new-rider.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 01 Sep 2024 04:37:14 GMT -->

</html>