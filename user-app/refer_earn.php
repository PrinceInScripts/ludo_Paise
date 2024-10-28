<?php
include('db.php');
include('includes/sessions.php');
$userid = $_SESSION['id'];

// get user data 
$user = mysqli_query($con, "SELECT * FROM users WHERE id = '$userid'");
$user = mysqli_fetch_assoc($user);

$fetchReferrals = mysqli_query($con, "SELECT * FROM users WHERE level_1 = '$user[referrer_id]'");
$referralCount = mysqli_num_rows($fetchReferrals);

?>
<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from themes.pixelstrap.com/pwa/taxify/user-app/home by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 01 Sep 2024 04:36:56 GMT -->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="taxify">
    <meta name="keywords" content="taxify">
    <meta name="author" content="taxify">
    <link rel="manifest" href="manifest.json">
    <link rel="icon" href="../assets/images/logo/favicon.png" type="image/x-icon">
    <title>Ludo Paisa </title>

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


    <!-- swiper css -->
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/swiper-bundle.min.css">

    <!-- Theme css -->
    <link rel="stylesheet" id="change-link" type="text/css" href="../assets/css/style.css">
    <link rel="stylesheet" id="change-link" type="text/css" href="../assets/css/style1.css">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
    <style>
        /* Tabs */
        .tabs {
            display: flex;
            justify-content: space-around;
            padding: 10px;
            background: #ffffff;
            border-bottom: 1px solid #ddd;
        }

        .tab-item {
            flex: 1;
            text-align: center;
            padding: 10px;
            cursor: pointer;
            color: #555;
            transition: color 0.3s ease;
        }

        .tab-item:hover {
            color: #01AA85;
        }

        .tab-item.active {
            border-bottom: 2px solid #01AA85;
            font-weight: bold;
            color: #01AA85;
        }

        /* Section styles */
        .invite-section,
        .referral-section,
        .faq-section {
            display: none;
        }

        .invite-section.active,
        .referral-section.active,
        .faq-section.active {
            display: block;
        }

        /* Info card styles */
        .info-card {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            background-color: white;
            border-radius: 5px;
            padding: 15px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .invite-now {
            background-color: #f8f9fa;
            /* padding: 20px; */
            /* border-radius: 10px; */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            /* margin: 20px 0; */
        }

        .invite-now h2 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .referral-tiers {
            margin-top: 20px;
        }

        .tier {
            background-color: #ffffff;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            padding: 15px;
            margin: 10px 0;
        }

        .tier h4 {
            font-size: 20px;
            color: #007bff;
        }

        .tier p {
            font-size: 16px;
            color: #6c757d;
        }

        .invite-button {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .invite-button:hover {
            background-color: #218838;
        }

        /* Invite code styles */
        .invite-code {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-top: 15px;
            background-color: #ffffff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* Leaderboard styles */
        .top-leaderboard {
            display: flex;
            justify-content: center;
            gap: 13%;
            align-items: center;
            margin-bottom: 20px;
        }

        .rank {
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .winner {
            transform: scale(1.1);
        }

        .avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .avatar img{
            width: 50px;
            height: 50px;
            border-radius: 50%;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: bold;
            margin-bottom: 5px;
        }

        h3 {
            font-size: 1.5em;
            margin-bottom: 10px;
            color: #6200ea;
        }

        .leaderboard-list {
            border-top: 1px solid #ddd;
        }

        .leaderboard-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #ddd;
            background-color: #ffffff;
            margin-bottom: 10px;
            border-radius: 5px;
        }

        .points {
            color: green;
            font-weight: bold;
        }

        /* FAQ styles */
        .faq-item {
            margin-bottom: 10px;
            background-color: #f8f8f8;
            padding: 10px;
            border-radius: 5px;
        }

        .faq-item h5 {
            margin: 0;
            color: #01AA85;
        }

        .input-group .btn {
            z-index: 0;
        }

        /* Responsive adjustments */
        @media (max-width: 600px) {
            .tabs {
                flex-direction: column;
            }

            .tab-item {
                padding: 10px 0;
            }

            .invite-options {
                flex-direction: column;
            }

            .invite-options button {
                margin-bottom: 10px;
            }
        }
    </style>
</head>

<body>
    <!-- header starts -->
    <header id="header" class="main-header">
        <div class="custom-container">
            <div class="header-panel">
                <div class="d-flex align-items-center gap-2">
                    <a href="#offcanvasLeft" data-bs-toggle="offcanvas">
                        <i class="iconsax icon-btn" data-icon="text-align-left"> </i>
                    </a>
                    <img class="img-fluid logo" src="../assets/images/logo/logo.png" alt="logo">
                    <!-- <img class="img-fluid logo-dark" src="../assets/images/logo/logo-dark.png" alt="logo"> -->
                </div>

                <div class="d-flex align-items-center gap-sm-3 gap-2">
                    <a href="chatting">
                        <i class="iconsax icon-btn" data-icon="messages-2"> </i>
                    </a>
                    <a href="notification">
                        <i class="iconsax icon-btn" data-icon="bell-2"> </i>
                    </a>
                </div>
            </div>
        </div>
    </header>
    <!-- header end -->


    <div class="card">
        <div class="card-header p-2">
            <ul class="nav nav-pills d-flex flex-row justify-content-between">
                <li class="nav-item">
                    <a class="nav-link active" href="#invite" data-toggle="tab">Invite Now</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#myreferral" data-toggle="tab">My Referrals</a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link" href="#referral" data-toggle="tab">Leatherboard</a>
                </li> -->
                <li class="nav-item">
                    <a class="nav-link" href="#faqs" data-toggle="tab">FAQs</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content">
                <div class="active tab-pane" id="invite">
                    <!-- Content Sections -->

                    <div class="faq-item">
                        <h5>What is the referral program?</h5>
                        <p>Our referral program lets you earn cash back by inviting friends.</p>
                    </div>
                    <div class="faq-item">
                        <h5>How can I invite friends?</h5>
                        <p>Use the Invite Now tab to share the referral link via various platforms.</p>
                    </div>
                    <div class="faq-item">
                        <h5>What rewards do I get?</h5>
                        <p>You earn INR 25 when your friend signs up and shops, plus 20% of their earnings.</p>
                    </div>
                    <div class="invite-now">
                        <h2>Invite Now</h2>
                        <p>Share your referral link with friends and earn rewards based on their activity!</p>


                        <!-- Referral Link Section -->
                        <div class="referral-link mb-4">
                            <h4>Your Referral Link:</h4>
                            <div class="input-group">
                                <?php
                                // Get protocol
                                $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";

                                // Get the domain
                                $domain = $_SERVER['HTTP_HOST'];

                                // Full URL
                                $currentUrl = $protocol . $domain;

                                ?>
                                <input type="text" id="referralLink" value="<?= $currentUrl ?>/user-app/login?code=<?= $user['referrer_id'] ?>" class="form-control" readonly>
                                <button class="btn btn-primary" id="copyLinkButton">Copy Link</button>
                            </div>
                        </div>

                        <!-- Social Share Buttons -->
                        <div class="social-share mb-4">
                            <h4>Share on:</h4> <br>
                            <div class="btn-group col-10">
                                <button class="btn btn-outline-success" onclick="shareOn('whatsapp')">
                                    <img src="https://img.icons8.com/color/48/000000/whatsapp.png" style="width: 30px; height: 30px;" alt="whatsapp">
                                </button>
                                <button class="btn btn-outline-primary" onclick="shareOn('facebook')">
                                    <img src="https://img.icons8.com/color/48/000000/facebook-new.png" style="width: 30px; height: 30px;" alt="facebook">
                                </button>
                                <button class="btn btn-outline-info" onclick="shareOn('twitter')">
                                    <img src="https://img.icons8.com/color/48/000000/twitter--v1.png" style="width: 30px; height: 30px;" alt="twitter">
                                </button>
                                <button class="btn btn-outline-danger" onclick="shareOn('telegram')">
                                    <img src="https://img.icons8.com/color/48/000000/telegram-app.png" style="width: 30px; height: 30px;" alt="telegram">
                                </button>
                            </div>
                        </div>

                        <div class="referral-tiers mb-4">
                            <div class="tier" id="tier1">
                                <h4>Tier 1</h4>
                                <p>Earn 10% on every referral's first purchase!</p>
                            </div>
                            <div class="tier" id="tier2">
                                <h4>Tier 2</h4>
                                <p>Earn 15% on every referral's first purchase after 5 successful invites!</p>
                            </div>
                            <div class="tier" id="tier3">
                                <h4>Tier 3</h4>
                                <p>Earn 20% on every referral's first purchase after 10 successful invites!</p>
                            </div>
                            <div class="tier" id="tier4">
                                <h4>Tier 4</h4>
                                <p>Earn 25% on every referral's first purchase after 20 successful invites!</p>
                            </div>
                            <div class="tier" id="tier5">
                                <h4>Tier 5</h4>
                                <p>Earn 30% on every referral's first purchase after 50 successful invites!</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div style="display: none;" class="tab-pane" id="referral">
                    <!-- Referrals Section -->
                    <div class="referral-section active">
                        <!-- Top 3 Leaderboard -->
                        <div class="top-leaderboard">
                            <div class="rank">
                                <div class="avatar" style="background-color: #FFD700;">VD</div>
                                <p>Vaibhav Dua</p>
                                <p>₹180</p>
                            </div>
                            <div class="rank winner">
                                <div class="avatar" style="background-color: #6A0DAD;">KK</div>
                                <p>Kritika Kamra</p>
                                <p>₹200</p>
                            </div>
                            <div class="rank">
                                <div class="avatar" style="background-color: #FF1493;">HS</div>
                                <p>Harpreet Singh</p>
                                <p>₹170</p>
                            </div>
                        </div>

                        <!-- Current Leaderboards -->
                        <h3>Current Leaderboards</h3>
                        <div class="leaderboard-list">
                            <div class="leaderboard-item">
                                <div class="avatar" style="background-color: #6A0DAD;">KK</div>
                                <p>Kritika Kamra</p>
                                <p class="points">₹200</p>
                            </div>
                            <div class="leaderboard-item">
                                <div class="avatar" style="background-color: #FFD700;">VD</div>
                                <p>Vaibhav Dua</p>
                                <p class="points">₹180</p>
                            </div>
                            <div class="leaderboard-item">
                                <div class="avatar" style="background-color: #FF1493;">HS</div>
                                <p>Harpreet Singh</p>
                                <p class="points">₹170</p>
                            </div>
                            <div class="leaderboard-item">
                                <div class="avatar" style="background-color: #708090;">SS</div>
                                <p>Sudhanshu Shukla</p>
                                <p class="points">₹120</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="myreferral">
                    <!-- Referrals Section -->
                    <div class="referral-section active">

                        <div class="top-leaderboard">
                            <div class="rank">
                                <div class="avatar theme-btn">
                                    <?php 
                                    if($referralCount == 0){
                                        echo "0";   
                                    }else{
                                        echo $referralCount;
                                    }

                                    ?>
                                </div>
                                <p>Total Referals</p>
                            </div>
                            <div class="rank winner">
                                <div class="avatar theme-btn">
                                <?php 
                                    if($referralCount == 0){
                                        echo "0";   
                                    }else{
                                        echo $referralCount;
                                    }
                                    
                                    ?>
                                </div>
                                <p>Active Referals</p>
                            </div>
                            <div class="rank">
                                <div class="avatar theme-btn">200</div>
                                <p>Total Earned</p>
                            </div>
                        </div>


                        <!-- Current Leaderboards -->
                        <h3>My Referals</h3>
                        <div class="leaderboard-list">
                            <div class="leaderboard-item">

                                <p>Profile</p>
                                <p>Player Name</p>
                                <p>Mobile Number</p>
                                <p>Amount</p>
                            </div>
                            <?php
                            
                            while ($referral = mysqli_fetch_assoc($fetchReferrals)) {
                            ?>
                                <div class="leaderboard-item">
                                    <div class="avatar" ><img src="../assets/images/profile/p<?=$referral['profile_pic']?>.png" alt=""> </div>
                                    <p>
                                        <?php 
                                        if($referral['fname'] == '' ){
                                            echo "No Name";
                                        }else{
                                            echo $referral['fname'];
                                        }
                                        ?>
                                    </p>
                                    <p>
                                        <?php 
                                        echo "+91 ".substr($referral['mobile'], 0, 2) . '*****' . substr($referral['mobile'], -2);
                                        ?>
                                    </p>
                                    <p class="points">₹200</p>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="faqs">
                    <section class="content">
                        <div class="row">
                            <div class="col-12" id="accordion">
                                <div class="card card-primary card-outline">
                                    <a class="d-block w-100" data-toggle="collapse" href="#collapseOne">
                                        <div class="card-header">
                                            <h4 class="card-title w-100">
                                                1. Lorem ipsum dolor sit amet
                                            </h4>
                                        </div>
                                    </a>
                                    <div id="collapseOne" class="collapse show" data-parent="#accordion">
                                        <div class="card-body">
                                            Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.
                                        </div>
                                    </div>
                                </div>
                                <div class="card card-primary card-outline">
                                    <a class="d-block w-100" data-toggle="collapse" href="#collapseTwo">
                                        <div class="card-header">
                                            <h4 class="card-title w-100">
                                                2. Aenean massa
                                            </h4>
                                        </div>
                                    </a>
                                    <div id="collapseTwo" class="collapse" data-parent="#accordion">
                                        <div class="card-body">
                                            Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.
                                        </div>
                                    </div>
                                </div>
                                <div class="card card-primary card-outline">
                                    <a class="d-block w-100" data-toggle="collapse" href="#collapseThree">
                                        <div class="card-header">
                                            <h4 class="card-title w-100">
                                                3. Donec quam felis
                                            </h4>
                                        </div>
                                    </a>
                                    <div id="collapseThree" class="collapse" data-parent="#accordion">
                                        <div class="card-body">
                                            Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.
                                        </div>
                                    </div>
                                </div>
                                <div class="card card-warning card-outline">
                                    <a class="d-block w-100" data-toggle="collapse" href="#collapseFour">
                                        <div class="card-header">
                                            <h4 class="card-title w-100">
                                                4. Donec pede justo
                                            </h4>
                                        </div>
                                    </a>
                                    <div id="collapseFour" class="collapse" data-parent="#accordion">
                                        <div class="card-body">
                                            Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu.
                                        </div>
                                    </div>
                                </div>
                                <div class="card card-warning card-outline">
                                    <a class="d-block w-100" data-toggle="collapse" href="#collapseFive">
                                        <div class="card-header">
                                            <h4 class="card-title w-100">
                                                5. In enim justo
                                            </h4>
                                        </div>
                                    </a>
                                    <div id="collapseFive" class="collapse" data-parent="#accordion">
                                        <div class="card-body">
                                            In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium.
                                        </div>
                                    </div>
                                </div>
                                <div class="card card-warning card-outline">
                                    <a class="d-block w-100" data-toggle="collapse" href="#collapseSix">
                                        <div class="card-header">
                                            <h4 class="card-title w-100">
                                                6. Integer tincidunt
                                            </h4>
                                        </div>
                                    </a>
                                    <div id="collapseSix" class="collapse" data-parent="#accordion">
                                        <div class="card-body">
                                            Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus.
                                        </div>
                                    </div>
                                </div>
                                <div class="card card-danger card-outline">
                                    <a class="d-block w-100" data-toggle="collapse" href="#collapseSeven">
                                        <div class="card-header">
                                            <h4 class="card-title w-100">
                                                7. Aenean leo ligula
                                            </h4>
                                        </div>
                                    </a>
                                    <div id="collapseSeven" class="collapse" data-parent="#accordion">
                                        <div class="card-body">
                                            Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim.
                                        </div>
                                    </div>
                                </div>
                                <div class="card card-danger card-outline">
                                    <a class="d-block w-100" data-toggle="collapse" href="#collapseEight">
                                        <div class="card-header">
                                            <h4 class="card-title w-100">
                                                8. Aliquam lorem ante
                                            </h4>
                                        </div>
                                    </a>
                                    <div id="collapseEight" class="collapse" data-parent="#accordion">
                                        <div class="card-body">
                                            Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet.
                                        </div>
                                    </div>
                                </div>
                                <div class="card card-danger card-outline">
                                    <a class="d-block w-100" data-toggle="collapse" href="#collapseNine">
                                        <div class="card-header">
                                            <h4 class="card-title w-100">
                                                9. Quisque rutrum
                                            </h4>
                                        </div>
                                    </a>
                                    <div id="collapseNine" class="collapse" data-parent="#accordion">
                                        <div class="card-body">
                                            Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 mt-3 text-center">
                                <p class="lead">
                                    <a href="contact-us.html">Contact us</a>,
                                    if you found not the right anwser or you have a other question?<br />
                                </p>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>


    <!-- panel-space start -->
    <section class="panel-space"></section>
    <!-- panel-space end -->

    <!-- bottom navbar start -->
    <div class="navbar-menu">
        <ul>
            <li class="active">
                <a href="home">
                    <div class="icon">
                        <img class="unactive" src="https://themes.pixelstrap.com/pwa/taxify/assets/images/svg/home.svg" alt="home">
                        <img class="active" src="https://themes.pixelstrap.com/pwa/taxify/assets/images/svg/home-fill.svg" alt="home">
                    </div>
                    <span class="active">Home</span>
                </a>
            </li>

            <li>
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

    <!-- bootstrap js -->
    <script src="../assets/js/bootstrap.bundle.min.js"></script>

    <!-- sticky-header js -->
    <script src="../assets/js/sticky-header.js"></script>

    <!-- swiper js -->
    <script src="../assets/js/swiper-bundle.min.js"></script>
    <script src="../assets/js/custom-swiper.js"></script>

    <!-- template-setting js -->
    <script src="../assets/js/template-setting.js"></script>

    <!-- script js -->
    <script src="../assets/js/script.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <!-- jQuery -->
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../dist/js/demo.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

    <script>
        // Function to select the corresponding radio button
        function selectRadio(id) {
            document.getElementById(id).checked = true;
        }


        function viewChart() {


            var ele = document.getElementsByName('flexRadioDefault');


            for (i = 0; i < ele.length; i++) {
                if (ele[i].checked) {

                    if (ele[i].id == 'ludoclassic') {
                        window.location.href = 'newbattle.php?id=1';
                    } else if (ele[i].id == 'ludoclassictournament') {
                        swal.fire({
                            title: 'Coming Soon',
                            text: 'This feature is coming soon',
                            icon: 'info',
                            confirmButtonText: 'OK'
                        });
                    }


                }


            }
        }

        document.getElementById('copyLinkButton').addEventListener('click', function() {
            const referralLinkInput = document.getElementById('referralLink');
            referralLinkInput.select(); // Select the input text
            document.execCommand('copy'); // Copy the selected text

            // Show success message using SweetAlert
            Swal.fire({
                icon: 'success',
                title: 'Copied!',
                text: 'Your referral link has been copied to the clipboard.',
                confirmButtonText: 'OK'
            });
        });

        // Function to share on social media
        function shareOn(platform) {
            const referralLink = document.getElementById('referralLink').value;

            if (!referralLink) {
                alert("Referral link is empty!");
                return;
            }

            const message = `Join Ludopaisa Today 😎😎\n\n5% direct commission\nInstant Deposit\nInstant Withdrawal\n\nJoin Now by clicking the link below 👉 ${referralLink}`;
            let shareUrl = '';

            switch (platform) {
                case 'whatsapp':
                    shareUrl = `https://api.whatsapp.com/send?text=${encodeURIComponent(message)}`;
                    break;
                case 'facebook':
                    shareUrl = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(referralLink)}&quote=${encodeURIComponent(message)}`;
                    break;
                case 'twitter':
                    shareUrl = `https://twitter.com/intent/tweet?text=${encodeURIComponent(message)}`;
                    break;
                case 'telegram':
                    shareUrl = `https://telegram.me/share/url?url=${encodeURIComponent(referralLink)}&text=${encodeURIComponent(message)}`;
                    break;
                default:
                    return;
            }

            // Open the share URL in a popup window
            window.open(shareUrl, '_blank', 'width=600,height=400');
        }
    </script>
</body>


<!-- Mirrored from themes.pixelstrap.com/pwa/taxify/user-app/home by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 01 Sep 2024 04:37:00 GMT -->

</html>