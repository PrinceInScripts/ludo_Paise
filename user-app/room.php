<?php
include('db.php');
include('includes/sessions.php');

$user_id = $_SESSION['id'];
$query = "SELECT * FROM users WHERE id = '$user_id'";
$run = mysqli_query($con, $query);
$data = mysqli_fetch_assoc($run);
$wallet = $data['deposit_wallet'] + $data['withdraw_wallet'];

$battle_id = '';
if (isset($_GET['battle'])) {
    $battle_id = $_GET['battle'];
    $battleQuery = "SELECT * FROM games WHERE id = '$battle_id' AND (created_by = '$user_id' OR accepted_by = '$user_id') ";
    $battleRun = mysqli_query($con, $battleQuery);
    $battleData = mysqli_fetch_assoc($battleRun);
    if ($battleData == '') {
        header('location:home');
    } else {
        $created_by = $battleData['created_by'];
        $accepted_by = $battleData['accepted_by'];
        $isJoined = $battleData['isJoined'];
        $status = $battleData['status'];
        $game_id = $battleData['game_id'];
        $winAmount = $battleData['winAmount'];
        $roomcode = $battleData['roomcode'];
        $creator_ss = $battleData['creator_ss'];
        $acceptor_ss = $battleData['acceptor_ss'];
        $creator_join_ss = $battleData['creator_join_ss'];
        $acceptor_join_ss = $battleData['acceptor_join_ss'];
        $is_complete = $battleData['is_complete'];
        $winner = $battleData['winner'];
    }
} else {
    header('location:home');
}

if ($created_by != '' && $accepted_by != '') {
    $cratorSql = "SELECT * FROM users WHERE id = '$created_by'";
    $creatorRun = mysqli_query($con, $cratorSql);
    $creatorData = mysqli_fetch_assoc($creatorRun);

    $acceptorSql = "SELECT * FROM users WHERE id = '$accepted_by'";
    $acceptorRun = mysqli_query($con, $acceptorSql);
    $acceptorData = mysqli_fetch_assoc($acceptorRun);
}




?>
<!DOCTYPE html>
<html lang="en">



<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="ludopaisa">
    <meta name="keywords" content="ludopaisa">
    <meta name="author" content="ludopaisa">
    <link rel="manifest" href="manifest.json">
    <link rel="icon" href="../assets/images/logo/favicon.png" type="image/x-icon">
    <title>Ludo Paisa </title>

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


    <!-- swiper css -->
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/swiper-bundle.min.css">



    <!-- Theme css -->
    <link rel="stylesheet" id="change-link" type="text/css" href="../assets/css/style.css">
    <link rel="stylesheet" id="change-link" type="text/css" href="../assets/css/style2.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
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

        .rules {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            padding: 2% 8%;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }




        .challenge-section {
            background-color: white;
            margin: 20px auto;
            text-align: center;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .challenge-heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .profile-pic {
            width: 60px;
            height: 60px;
            border-radius: 50%;
        }

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


        .room-code-section {
            background-color: #fff;
            padding: 20px;
            text-align: center;
            border-radius: 10px;
            margin: 20px auto;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            max-width: 100%;
        }

        .room-code-heading {
            font-size: 24px;
            color: #4a4a4a;
            margin-bottom: 10px;
        }



        .room-code {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            border-radius: 10px;
            display: inline-block;
            margin: 10px 0;
        }

        .btn-copy {

            background-color: #4B0082;
            color: white;
            padding: 10px 20px;
            border-radius: 10px;
            cursor: pointer;
        }

        .btn-copy:hover {
            background-color: #5d00b8;
        }

        .game-result-section {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            margin: 20px auto;
            text-align: center;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            max-width: 100%;
        }

        .game-result-heading {

            font-size: 24px;
            font-weight: bold;
            color: #444;
            margin-bottom: 10px;

        }

        .game-result-description {
            font-size: 1em;
            margin-bottom: 20px;
            color: #666;
        }



        .btn-won {
            background-color: #28a745;
            color: white;
        }

        .btn-lost {
            background-color: #dc3545;
            color: white;
        }

        .btn-cancel {
            background-color: #fff;
            color: #333;
            border: 1px solid #ccc;
        }

        .popup-modal {
            display: none;
            position: fixed;
            z-index: 999;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .popup-content {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            width: 90%;
            max-width: 400px;
        }

        .close-popup {
            position: relative;
            left: 190px;
            bottom: 30px;
            font-size: 1.5em;
            cursor: pointer;
        }

        .btn-upload {
            background-color: #007bff;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            margin-top: 15px;
            cursor: pointer;
        }

        #screenshot-upload {
            margin-top: 10px;
            width: 100%;
        }

        .game-result {
            background-color: #fff3f3;
            /* Light red background */
            border: 2px solid #ff4d4d;
            /* Red border */
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            /* Slight shadow for depth */
            text-align: center;
            width: 80%;
            margin: 0 auto;
            font-family: 'Arial', sans-serif;
        }

        .game-result h2 {
            color: #333;
            /* Dark color for contrast */
            font-size: 24px;
            font-weight: 700;
        }

        .game-result p {
            color: #ff4d4d;
            /* Red text for "lost" message */
            font-size: 18px;
            font-weight: 600;
            margin-top: 10px;
        }

        .game-result-win {
            background-color: #f3fff3;
            /* Light green background */
            border: 2px solid #198754;
            /* Green border */
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            /* Slight shadow for depth */
            text-align: center;
            width: 80%;
            margin: 0 auto;
            font-family: 'Arial', sans-serif;
        }

        .game-result-win h2 {
            color: #333;
            /* Dark color for contrast */
            font-size: 24px;
            font-weight: 700;
        }

        .game-result-win p {
            color: #198754;
            /* Green text for "won" message */
            font-size: 18px;
            font-weight: 600;
            margin-top: 10px;
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

                </div>
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



    <section class="rules">
        <button class="btn btn-primary" onclick="history.back()"> Go Back</button>
        <button class="btn btn-danger"> Rules</button>
    </section>

    <?php
    $img_src1 = $creatorData['profile_pic'];
    $img_src2 = $acceptorData['profile_pic'];
    $img_src1_sql = "SELECT * FROM profile_pic WHERE id = '$img_src1'";
    $img_src2_sql = "SELECT * FROM profile_pic WHERE id = '$img_src2'";
    $img_src1_run = mysqli_query($con, $img_src1_sql);
    $img_src2_run = mysqli_query($con, $img_src2_sql);

    $img_src1_data = mysqli_fetch_assoc($img_src1_run);
    $img_src2_data = mysqli_fetch_assoc($img_src2_run);





    ?>
    <section class="challenge-section">
        <div class="challenges-container">
            <div class="challenges ">
                <img id="output" width="40px" class="profile-pic" src="../assets/images/profile/<?php echo $img_src1_data['profile']; ?>" alt="p8">
                <p><?php echo $creatorData['username'] ?></p>

            </div>
            <div class="timer-container">
                <img id="output" width="40px" class="profile-pic" src="../assets/images/product/vs.png" alt="p8">
                <p><?php echo $winAmount ?></p>
            </div>

            <div class="challenges ">
                <img id="output" width="40px" class="profile-pic" src="../assets/images/profile/<?php echo $img_src2_data['profile']; ?>" alt="p8">
                <p><?php echo $acceptorData['username'] ?></p>

            </div>
        </div>
    </section>

    <?php
    if (isset($_GET['error'])) {
    ?>

        <script>
            swal.fire({
                title: "Error",
                text: "<?php echo $_GET['error'] ?>",
                icon: "error",
                button: "Ok",
            });
        </script>
    <?php
    }
    ?>

    <?php
    if ($roomcode == null && $created_by == $user_id) {
    ?>
        <!-- Enter Roomcode for creator with Bootstrap CSS-->
        <section class="room-code-section">
            <h1 class="room-code-heading">Enter Room Code</h1>
            <form action="operations/enter_room.php" method="POST">
                <input onkeyup="this.value = this.value.replace(/[^0-9]/g, '');" type="text" minlength="10" maxlength="10" name="roomcode" class="form-control" placeholder="Enter Room Code" required>
                <input type="hidden" name="battle_id" class="form-control" value="<?= $battle_id ?>" required>

                <button type="submit" name="submit" class="btn btn-primary mt-2">Submit</button>
            </form>
        </section>
    <?php
    } elseif ($roomcode == null && $accepted_by == $user_id) {
    ?>
        <!-- Waiting for roomcode -->

        <section class="room-code-section">
            <h1 id="room-code-heading" class="room-code-heading">Waiting for Room Code</h1>
            <p id="room-code" style="display: none;" class="room-code"></p>
            <br>
            <button id="room-code-copybutton" style="display: none;" class="btn btn-success" onclick="copyToClipboard()">Copy Code</button>
            <!--  Loading Icon  -->
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </section>

    <?php

    } else {
    ?>
        <section class="room-code-section">
            <h1 class="room-code-heading">Room Code</h1>
            <p id="room-code" class="room-code"><?= $roomcode ?></p>
            <br>
            <button class="btn btn-success" onclick="copyToClipboard()">Copy Code</button>
        </section>
    <?php
    }
    ?>

    <?php
    if ($is_complete == 0) {
        if ($created_by == $user_id && $creator_join_ss == null) {
    ?>
            <section class="game-result-section">
                <h1 class="game-result-heading">Room Join Screenshot</h1>
                <p class="game-result-description">Before joining the game, take screenshot and upload here</p>
                <button class="btn-primary btn" onclick="seeExample()">See Example</button>
                <button class="btn-warning btn" onclick="openUploadPopup('proof')">Upload Screenshot</button>

            </section>
        <?php
        } elseif ($accepted_by == $user_id && $acceptor_join_ss == null) {
        ?>
            <section class="game-result-section">
                <h1 class="game-result-heading">Room Join Screenshot</h1>
                <p class="game-result-description">Before joining the game, take screenshot and upload here</p>
                <button class="btn-primary btn" onclick="seeExample()">See Example</button>
                <button class="btn-warning btn" onclick="openUploadPopup('proof')">Upload Screenshot</button>

            </section>
        <?php
        } elseif ($accepted_by == $user_id && $acceptor_join_ss != null) {
        ?>
            <section class="game-result-section">
                <h1 class="game-result-heading">Room Join Screenshot</h1>
                <p class="game-result-description">Before joining the game, take screenshot and upload here</p>
                <button class="btn-success btn" onclick="viewJoinSSA()">View Screenshot</button>

            </section>
        <?php
        } else {
        ?>
            <section class="game-result-section">
                <h1 class="game-result-heading">Room Join Screenshot</h1>
                <p class="game-result-description">Before joining the game, take screenshot and upload here</p>
                <button class="btn-success btn" onclick="viewJoinSSC()">View Screenshot</button>

            </section>
    <?php
        }
    }
    ?>



    <hr>
    <section class="game-result-section">
        <h1 class="game-result-heading">Game Result</h1>
        <?php

        if ($created_by == $user_id && $isJoined == 1 && $is_complete == 0) {

            if ($creator_ss == null) {
        ?>
                <p class="game-result-description">After completion of your game, select the status of the game and post your screenshot below</p>
                <button class="btn btn-won" onclick="openUploadPopup('won')">I Won</button>
                <button class="btn btn-lost" onclick="lost()">I Lost</button>
                <button class="btn btn-cancel" onclick="cancel()">Cancel</button>
            <?php
            } elseif ($creator_ss != null && $acceptor_ss == null) {
            ?>
                <p>Game Result Uploaded and waiting for opponent</p> <br>
                <button class="btn btn-secondary" onclick="winSSC()">View Screenshot</button>
            <?php
            } elseif ($creator_ss != null && $acceptor_ss != null && $acceptor_ss != 'lost') {
            ?>
                <div class="game-result">
                    <p>Game Conflicted</p>

                </div> <br>
                <button class="btn btn-secondary" onclick="winSSC()">View Screenshot</button>
            <?php
            } else {
            ?>
                <p>Game Result Uploaded by both players</p>
            <?php
            }
        } elseif ($accepted_by == $user_id && $isJoined == 1  && $is_complete == 0) {
            if ($acceptor_ss == null) {
            ?>
                <p class="game-result-description">After completion of your game, select the status of the game and post your screenshot below</p>
                <button class="btn btn-success" onclick="openUploadPopup('won')">I Won</button>
                <button class="btn btn-danger" onclick="lost()">I Lost</button>
                <button class="btn btn-secondary" onclick="cancel()">Cancel</button>
            <?php
            } elseif ($acceptor_ss != null && $creator_ss == null) {
            ?>
                <p>Game Result Uploaded and waiting for opponent</p> <br>
                <!-- view ss button  -->

                <button class="btn btn-secondary" onclick="winSSA()">View Screenshot</button>


            <?php
            } elseif ($acceptor_ss != null && $creator_ss != null && $creator_ss != 'lost') {
            ?>
                <div class="game-result">
                    <p>Game Conflicted</p>

                </div> <br>
                <button class="btn btn-secondary" onclick="winSSA()">View Screenshot</button>
            <?php
            } else {
            ?>
                <p>Game Result Uploaded by both players</p>
            <?php
            }
        } elseif ($created_by == $user_id && $isJoined == 1 && $is_complete == 1 && $winner == $user_id) {
            ?>
            <div class="game-result-win">
                <p>Congratulations! You won the game</p>
                <button class="btn btn-secondary" onclick="winSSC()">View Screenshot</button>
            </div>

        <?php
        } elseif ($accepted_by == $user_id && $isJoined == 1 && $is_complete == 1 && $winner == $user_id) {
        ?>
            <div class="game-result-win">
                <p>Congratulations! You won the game</p>
            </div>
            <button class="btn btn-secondary" onclick="winSSA()">View Screenshot</button>
        <?php
        } elseif ($accepted_by == $user_id && $isJoined == 1 && $is_complete == 1 && $status == 'cancel') {
        ?>
            <div class="game-result">
                <p>Game Cancelled</p>
            </div>
            <button class="btn btn-secondary" onclick="winSSA()">View Screenshot</button>


        <?php
        } elseif ($created_by == $user_id && $isJoined == 1 && $is_complete == 1 && $status == 'cancel') {
        ?>
            <div class="game-result">
                <p>Game Cancelled</p>

            </div>
        <?php
        } elseif ($created_by == $user_id && $isJoined == 1 && $is_complete == 1 && $winner != $user_id) {
        ?>
            <div class="game-result">
                <p>Sorry! You lost the game</p>
                <button class="btn btn-secondary" onclick="winSSC()">View Screenshot</button>
            </div>
        <?php
        } elseif ($accepted_by == $user_id && $isJoined == 1 && $is_complete == 1 && $winner != $user_id) {
        ?>
            <div class="game-result">
                <p>Sorry! You lost the game</p>
                <?php
                if ($acceptor_ss != 'lost') {
                ?>
                    <button class="btn btn-secondary" onclick="winSSA()">View Screenshot</button>
                <?php
                }
                ?>
            </div>

        <?php
        }


        ?>

    </section>



    <div id="upload-popup" class="popup-modal">
        <div class="popup-content">
            <span class="close-popup" onclick="closePopup()">
                <img src="https://cdn-icons-png.flaticon.com/512/9068/9068699.png" width="40" alt="">
            </span>
            <h2 id="popup-title">Upload Screenshot</h2>
            <p>Please upload the screenshot of your game result.</p>
            <form id="uploadForm" method="POST" enctype="multipart/form-data">
                <input class="form-control" type="file" name="file" id="screenshot-upload" accept="image/*">
                <input type="hidden" name="battle_id" class="form-control" value="<?= $battle_id ?>" required>
                <input type="hidden" id="screenshotType" name="screenshotType" value="" required>
                <button class="btn-upload" type="submit" name="submit" onClick="closePopup()">Upload</button>
            </form>
        </div>
    </div>



    <!-- offer section end -->

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

    <a href="https://api.whatsapp.com/send?phone=917042536431&amp;text=Hi..Sir, I have issue with my Battle ID *<?= $game_id ?>*" class="Wfloat" target="_blank">

        <i class="fa fa-whatsapp myW-float" aria-hidden="true"></i>

    </a>

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



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
        function lost() {
            // swal fire warning to lost the game .. if yes use ajax to update the database

            swal.fire({
                title: 'Are you sure you lost the game?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, I lost!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Use ajax to update the database
                    $.ajax({
                        url: 'operations/lost.php',
                        type: 'POST',
                        data: {
                            battle_id: '<?= $battle_id ?>',
                            user_id: '<?= $user_id ?>'
                        },
                        success: function(response) {
                            response = JSON.parse(response);
                            if (response.error) {
                                // reload after response message
                                swal.fire({
                                    title: 'Error',
                                    text: response.message,
                                    icon: 'error',
                                    confirmButtonText: 'Ok'
                                }).then(() => {
                                    location.reload();
                                });
                            } else {
                                // reload after response message
                                swal.fire({
                                    title: 'Success',
                                    text: response.message,
                                    icon: 'success',
                                    confirmButtonText: 'Ok'
                                }).then(() => {
                                    location.reload();
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            console.log('Error: ' + error);
                        }
                    });
                }
            });

        }

        function cancel() {

            swal.fire({
                title: 'Are you sure you want to cancel the game?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, Cancel!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Use ajax to update the database
                    $.ajax({
                        url: 'operations/cancel.php',
                        type: 'POST',
                        data: {
                            battle_id: '<?= $battle_id ?>',
                            user_id: '<?= $user_id ?>'
                        },
                        success: function(response) {
                            response = JSON.parse(response);
                            if (response.error) {
                                // reload after response message
                                swal.fire({
                                    title: 'Error',
                                    text: response.message,
                                    icon: 'error',
                                    confirmButtonText: 'Ok'
                                }).then(() => {
                                    location.reload();
                                });
                            } else {
                                // reload after response message
                                swal.fire({
                                    title: 'Success',
                                    text: response.message,
                                    icon: 'success',
                                    confirmButtonText: 'Ok'
                                }).then(() => {
                                    location.reload();
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            console.log('Error: ' + error);
                        }
                    });
                }
            });

        }



        function seeExample() {
            // swal fire two scroll mobile screenshot images 
            swal.fire({
                title: 'Example (Scroll down to see more)',
                html: `
                    <h1>Creator SS</h1>
                    <img src="../assets/images/examples/example1.jpg" width="100%" alt="example">
                    <h1>Acceptor SS</h1>
                    <img src="../assets/images/examples/example2.jpg" width="100%" alt="example">
                `,
                confirmButtonText: 'Close'
            });
        }

        function viewChart() {
            var ele = document.getElementsByName('flexRadioDefault');
            for (i = 0; i < ele.length; i++) {
                if (ele[i].checked)
                    window.location.href = ele[i].id;
            }
        }

        function copyToClipboard() {
            const roomCode = document.getElementById('room-code').innerText;
            const tempInput = document.createElement('input');
            document.body.appendChild(tempInput);
            tempInput.value = roomCode;
            tempInput.select();
            document.execCommand('copy');
            document.body.removeChild(tempInput);
            // swal file 
            swal.fire({
                title: 'Room Code Copied',
                text: 'You can now share the room code with your opponent',
                icon: 'success',
                confirmButtonText: 'Ok'
            });
        }

        function openUploadPopup(result) {
            var popup = document.getElementById("upload-popup");
            var title = document.getElementById("popup-title");
            var screenshotTypeInput = document.getElementById("screenshotType");

            if (!screenshotTypeInput) {
                console.error("screenshotType input element is not found");
                return;
            }

            // Set title based on the button clicked
            if (result === 'won') {
                title.textContent = "Upload Screenshot for Winning";
                screenshotTypeInput.value = "won";

            } else if (result === 'proof') {
                title.textContent = "Upload Screenshot";
                screenshotTypeInput.value = "proof";
            }

            popup.style.display = "flex"; // Display the popup
        }

        function closePopup() {
            var popup = document.getElementById("upload-popup");
            popup.style.display = "none"; // Hide the popup
        }

        $(document).ready(function() {
            $('#uploadForm').on('submit', function(e) {
                e.preventDefault(); // Prevent form from refreshing the page

                var formData = new FormData(this); // Create a new FormData object from the form

                $.ajax({
                    url: 'operations/upload.php', // The PHP script that handles the upload
                    type: 'POST',
                    data: formData, // Form data to be sent to the server
                    contentType: false, // Important for file uploads
                    processData: false, // Important for file uploads
                    success: function(response) {

                        response = JSON.parse(response);

                        response = response[0];

                        if (response.error) {
                            swal.fire({
                                title: 'Error',
                                text: response.message,
                                icon: 'error',
                                confirmButtonText: 'Ok'
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            swal.fire({
                                title: 'Success',
                                text: response.message,
                                icon: 'success',
                                confirmButtonText: 'Ok'
                            }).then(() => {
                                location.reload();
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log('Error: ' + error);
                    }
                });
            });
        });


        function viewJoinSSA() {
            // show acceptor join ss in swal.fire 
            swal.fire({
                title: 'Room Join Screenshot',
                html: `
                    <img src="../assets/games/<?= $battle_id ?>/<?= $acceptor_join_ss ?>" width="50%" alt="profile">
                `,
                confirmButtonText: 'Close'
            });
        }

        function viewJoinSSC() {
            // show acceptor join mobile width ss in swal.fire
            swal.fire({
                title: 'Room Join Screenshot',
                html: `
                    <img src="../assets/games/<?= $battle_id ?>/<?= $creator_join_ss ?>" width="50%" alt="profile">
                `,
                confirmButtonText: 'Close'
            });
        }

        function winSSA() {
            // show acceptor join ss in swal.fire 
            swal.fire({
                title: 'Win Screenshot',
                html: `
                    <img src="../assets/games/<?= $battle_id ?>/<?= $acceptor_ss ?>" width="50%" alt="profile">
                `,
                confirmButtonText: 'Close'
            });
        }

        function winSSC() {
            // show acceptor join mobile width ss in swal.fire
            swal.fire({
                title: 'Win Screenshot',
                html: `
                    <img src="../assets/games/<?= $battle_id ?>/<?= $creator_ss ?>" width="50%" alt="profile">
                `,
                confirmButtonText: 'Close'
            });
        }

        <?php
        if (isset($_GET['error'])) {
            if ($_GET['error'] == 'Roomcode error') {
        ?>
                swal.fire({
                    title: 'Error',
                    text: 'Roomcode must be 8 characters',
                    icon: 'error',
                    confirmButtonText: 'Ok'
                }).then(() => {
                    location.href = 'room?battle=<?= $battle_id ?>';
                });
        <?php
            }
        }
        ?>


        // const ws = new WebSocket('ws://localhost:8080');

        // ws.onopen = function() {
        //     console.log('Connected to WebSocket server');
        //     // Inform the server that the user is waiting for a room code
        //     ws.send(JSON.stringify({
        //         action: 'wait_for_room_code',
        //         battle: battle_id
        //     }));
        // };

        // ws.onmessage = function(event) {
        //     const data = JSON.parse(event.data);

        //     if (data.action === 'update_room_code' && data.room_code) {
        //         // Update the DOM with the new room code

        //         document.querySelector('.spinner-border').style.display = 'none';
        //         document.getElementById('room-code-heading').textContent = 'Room Code';
        //         document.getElementById('room-code-copybutton').style.display = 'inline';
        //         const roomCodeElement = document.getElementById('room-code');
        //         roomCodeElement.textContent = data.room_code;
        //         roomCodeElement.style.display = 'block';
        //     }
        // };

        // ws.onerror = function(error) {
        //     console.error('WebSocket error:', error);
        // };

        // refresh page after 5 seconds 
        setTimeout(() => {
            location.reload();
        }, 15000);
    </script>


</body>




</html>