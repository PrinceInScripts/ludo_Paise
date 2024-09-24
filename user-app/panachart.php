<?php
include('db.php');
?>
<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from themes.pixelstrap.com/pwa/taxify/user-app/finding-driver by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 01 Sep 2024 04:37:12 GMT -->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

                <h3 class="fw-semibold title-color">Pana Chart</h3>
            </div>
        </div>
    </header>
    <!-- header end -->

    <!-- note section starts -->
    <section  class="pt-3">
        <div class="custom-container">
            <div class="poster-part">
                <p class="fw-normal text-white">Success is not just about winning, it's about learning from every result—whether you win or lose, the game continues.</p>
            </div>
        </div>
    </section>
    <!-- note section end -->

    <!-- finding driver list starts -->
    <section  class="driver-request section-b-space">
        <div class="custom-container">
            <div class="grid-btn mt-2">
                <a href="#bottom" class="btn btn-primary w-100 m-0">Go to Bottom</a>
            </div>
            <ul class="driver-list">
                <li>
                    <div class="driver-box outstation-driver-box">
                        <table>
                            <tr>
                                <th>Mon</th>
                                <th>Tue</th>
                                <th>Wed</th>
                                <th>Thu</th>
                                <th>Fri</th>
                                <th>Sat</th>
                                <th>Sun</th>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>45</td>
                                <td>67</td>
                                <td>12</td>
                                <td>34</td>
                                <td>56</td>
                                <td>78</td>
                                <td>90</td>
                            </tr>

                        </table>
                    </div>
                </li>
            </ul>
            <div id="bottom" class="grid-btn mt-2">
                <a href="#top" class="btn btn-primary w-100 m-0">Go to Top</a>
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
</body>


<!-- Mirrored from themes.pixelstrap.com/pwa/taxify/user-app/finding-driver by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 01 Sep 2024 04:37:12 GMT -->

</html>