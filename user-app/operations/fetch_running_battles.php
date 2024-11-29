<?php 
require_once '../db.php';
// Asia/Kolkata timezone 
date_default_timezone_set('Asia/Kolkata');

$user_id = $_SESSION['id'];
?>
<div id="running-battle" class="pt-2">
                        <ul class="driver-list">

                            <?php

                            $query2 = "SELECT * FROM games WHERE status = 'running'";
                            $result2 = mysqli_query($con, $query2);
                            while ($row2 = mysqli_fetch_assoc($result2)) {
                            ?>
                                <li>
                                    <div class="driver-box">
                                        <?php
                                        $challenger_username = $row2['created_by'];
                                        $getName  = "SELECT * FROM users WHERE id = '$challenger_username'";
                                        $resultName = mysqli_query($con, $getName);
                                        $rowName = mysqli_fetch_assoc($resultName);
                                        ?>
                                        <div class="profile-head">
                                            <div class="d-flex align-items-center gap-2">
                                                <img class="img-fluid profile-img" src="https://cdn-icons-png.flaticon.com/512/3637/3637532.png" alt="profile">
                                                <h5>Challange From <span style="color:green"><?= $rowName['username'] ?></span></h5>
                                            </div>
                                            <h4 class="fw-semibold theme-color">

                                            </h4>
                                        </div>
                                        <section class="challenge-section">
                                            <div class="challenges-container">
                                                <div class="challenges ">

                                                    <img id="output" width="40px" class="profile-pic" src="../assets/images/profile/p<?= $rowName['profile_pic'] ?>.png" alt="p<?= $rowName['profile_pic'] ?>">
                                                    <p>
                                                        <?php

                                                        echo $rowName['username'];
                                                        ?>
                                                    </p>

                                                </div>
                                                <div class="timer-container">
                                                    <img id="output" width="60px" class="profile-pic" src="../assets/images/product/vs.png" alt="p8">
                                                    <p>Prize : <?= $row2['winAmount'] ?></p>
                                                </div>

                                                <div class="challenges ">
                                                    <?php
                                                    $acceptor_username = $row2['accepted_by'];
                                                    $getName  = "SELECT * FROM users WHERE id = '$acceptor_username'";
                                                    $resultName = mysqli_query($con, $getName);
                                                    $rowName = mysqli_fetch_assoc($resultName);
                                                    ?>
                                                    <img id="output" width="40px" class="profile-pic" src="../assets/images/profile/p<?= $rowName['profile_pic'] ?>.png" alt="p<?= $rowName['profile_pic'] ?>">
                                                    <p>
                                                        <?php

                                                        echo $rowName['username'];
                                                        ?>
                                                    </p>

                                                </div>
                                            </div>
                                        </section>
                                    </div>
                                </li>
                                <hr>
                            <?php
                            }

                            ?>


                        </ul>
                    </div>