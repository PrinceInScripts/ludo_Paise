<?php
include("db.php");
include("top.php");

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($con, $_GET['id']);

    // Fetch user information from the 'users' table
    $sql = "SELECT * FROM users where id='$id'";
    $res = mysqli_query($con, $sql);

    // If the user exists, retrieve their data
    if (mysqli_num_rows($res) > 0) {
        $user = mysqli_fetch_assoc($res);
    }

    // Fetch profile picture data based on the 'profile_pic' column
    $img_src = $user['profile_pic'];
    $img_src_sql = "SELECT * FROM profile_pic WHERE id = '$img_src'";
    $img_src_run = mysqli_query($con, $img_src_sql);

    $img_src_data = mysqli_fetch_assoc($img_src_run);


    // Fetch user's personal details from the 'aadhaar_data' table
    $personal_sql = "SELECT * FROM aadhaar_data WHERE user_id='$id'";
    $personal_run = mysqli_query($con, $personal_sql);
    if (mysqli_num_rows($personal_run) > 0) {
        $personal_data = mysqli_fetch_assoc($personal_run);
    }

    // Fetch user's personal details from the 'aadhaar_data' table
    $bank_data = '';
    $bank_sql = "SELECT * FROM bankdetails where userid=$id";
    $bank_run = mysqli_query($con, $bank_sql);
    if (mysqli_num_rows($bank_run) > 0) {
        $bank_data = mysqli_fetch_assoc($bank_run);
    }
}


?>


<div class="content-wrapper">
    <!-- Profile Header -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Profile</h1>
                </div>

            </div>
        </div>
    </section>



    <!-- Main Profile Section -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <!-- Left Column: User Profile Information -->
                <div class="col-md-3">
                    <?php
                    if ($user['kyc_status'] == 1) {
                    ?>
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle"
                                        src="../assets/images/profile/<?php echo $img_src_data['profile'] ?>"
                                        alt="User profile picture">
                                </div>

                                <h3 class="profile-username text-center"><?php echo $personal_data['full_name'] ?></h3>
                                <p class="text-muted text-center"><?php echo $user['username'] ?></p>


                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>Wallet</b> <a class="float-right"><?php echo $user['deposit_wallet'] + $user['withdraw_wallet'] ?></a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>ID</b> <a class="float-right"><?php echo $user['id'] ?></a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Mobile</b> <a class="float-right"><?php echo $user['mobile'] ?></a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>D.O.B</b> <a class="float-right"><?php echo $personal_data['dob'] ?></a>
                                    </li>
                                    <?php
                                    if ($personal_data['gender'] == 'M') {
                                    ?>
                                        <li class="list-group-item">
                                            <b>Gender</b> <a class="float-right">Male</a>
                                        </li>
                                    <?php
                                    } else {
                                    ?>
                                        <li class="list-group-item">
                                            <b>Gender</b> <a class="float-right">Female</a>
                                        </li>
                                    <?php

                                    }
                                    ?>


                                    <?php
                                    if ($user['email']) {
                                    ?>
                                        <li class="list-group-item">
                                            <b>Email</b> <a class="float-right"><?php echo $user['email'] ?></a>
                                        </li>
                                    <?php
                                    }
                                    ?>
                                    <li class="list-group-item">
                                        <b>Wallet</b> <a class="float-right"><?php echo $user['deposit_wallet'] + $user['withdraw_wallet'] ?></a>
                                    </li>
                                    <?php
                                    if ($user['adhaar_no'] == '') {
                                    ?>
                                        <li class="list-group-item">
                                            <b>Adhaar No.</b> <a class="float-right">No Aadhar</a>
                                        </li>
                                    <?php
                                    } else {
                                    ?>
                                        <li class="list-group-item">
                                            <b>Adhaar No.</b> <a class="float-right"><?php echo $user['adhaar_no'] ?></a>
                                        </li>
                                    <?php
                                    }
                                    ?>
                                    <li class="list-group-item">
                                        <b>Account Create</b> <a class="float-right"><?php echo $user['created_at'] ?></a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Address</b> <a class="float-right"><?php echo $personal_data['state'] . "," . $personal_data['country'] . "(" . $personal_data['zip'] . ")" ?></a>
                                    </li>
                                    <?php
                                    if ($bank_data != '') {
                                        if ($bank_data['bank_status']) {
                                    ?>
                                            <li class="list-group-item">
                                                <b>Bank Status</b> <a class="float-right"> <button class="btn btn-success">Verified</button></a>
                                            </li>
                                        <?php
                                        } else {
                                        ?>
                                            <li class="list-group-item">
                                                <b>Adhaar No.</b> <a class="float-right"><?php echo $user['adhaar_no'] ?></a>
                                            </li>
                                    <?php
                                        }
                                    }
                                    ?>
                                </ul>


                            </div>

                        </div>
                    <?php

                    } else {
                    ?>
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle"
                                        src="../assets/images/profile/<?php echo $img_src_data['profile'] ?>"
                                        alt="User profile picture">
                                </div>


                                <p class="text-muted text-center"><?php echo $user['username'] ?></p>


                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>Wallet</b> <a class="float-right"><?php echo $user['deposit_wallet'] + $user['withdraw_wallet'] ?></a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>ID</b> <a class="float-right"><?php echo $user['id'] ?></a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Mobile</b> <a class="float-right"><?php echo $user['mobile'] ?></a>
                                    </li>
                                    <?php
                                    if ($user['email']) {
                                    ?>
                                        <li class="list-group-item">
                                            <b>Email</b> <a class="float-right"><?php echo $user['email'] ?></a>
                                        </li>
                                    <?php
                                    }
                                    ?>
                                    <li class="list-group-item">
                                        <b>Wallet</b> <a class="float-right"><?php echo $user['deposit_wallet'] + $user['withdraw_wallet'] ?></a>
                                    </li>
                                    <?php
                                    if ($user['adhaar_no'] == '') {
                                    ?>
                                        <li class="list-group-item">
                                            <b>Adhaar No.</b> <a class="float-right">No Aadhar</a>
                                        </li>
                                    <?php
                                    } else {
                                    ?>
                                        <li class="list-group-item">
                                            <b>Adhaar No.</b> <a class="float-right"><?php echo $user['adhaar_no'] ?></a>
                                        </li>
                                    <?php
                                    }
                                    ?>
                                    <li class="list-group-item">
                                        <b>Account Create</b> <a class="float-right"><?php echo $user['created_at'] ?></a>
                                    </li>

                                    <?php
                                    if ($bank_data != '') {
                                        if ($bank_data['bank_status']) {

                                            if ($bank_data['bank_status'] == 0) {
                                    ?>
                                                <li class="list-group-item">
                                                    <b>Bank Status</b> <a class="float-right"> <button class="btn btn-danger">Not Verified</button></a>
                                                </li>
                                            <?php
                                            } else {
                                            ?>
                                                <li class="list-group-item">
                                                    <b>Bank Status</b> <a class="float-right"> <button class="btn btn-success">Verified</button></a>
                                                </li>
                                            <?php
                                            }
                                        } else {
                                            ?>
                                            <li class="list-group-item">
                                                <b>Adhaar No.</b> <a class="float-right"><?php echo $user['adhaar_no'] ?></a>
                                            </li>
                                    <?php
                                        }
                                    }
                                    ?>
                                </ul>


                            </div>

                        </div>
                    <?php

                    }
                    ?>



                    <!-- Bonus Feature -->
                    <div class="card mt-3">
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0">Add Bonus</h5>
                        </div>
                        <div class="card-body">
                            <form action="update_wallet.php" method="post">
                                <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">₹</span>
                                    </div>
                                    <input type="number" class="form-control" name="bonus_amount" placeholder="Bonus Amount" required>
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Remark</span>
                                    </div>
                                    <input type="text" class="form-control" name="bonus_remark" placeholder="Bonus Remark">
                                </div>

                                <div class="text-right">
                                    <button type="submit" class="btn btn-success" name="action" value="bonus">Apply Bonus</button>
                                </div>


                            </form>
                        </div>
                    </div>

                    <!-- Penalty Feature -->
                    <div class="card mt-3">
                        <div class="card-header bg-danger text-white">
                            <h5 class="mb-0">Add Penalty</h5>
                        </div>
                        <div class="card-body">
                            <form action="update_wallet.php" method="post">
                                <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                                <div class="input-group mb-3">

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">₹</span>
                                        </div>
                                        <input type="number" class="form-control" name="penalty_amount" placeholder="Penalty Amount" required>
                                    </div>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Remark</span>
                                        </div>
                                        <input type="text" class="form-control" name="penalty_remark" placeholder="Penalty Remark">
                                    </div>

                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-danger" name="action" value="penalty">Apply Penalty</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>

                <!-- Right Column: User's History and All Details -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <!-- Navigation Tabs -->
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">History</a></li>
                                <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Deposit</a></li>
                                <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Withdraw</a></li>
                                <li class="nav-item"><a class="nav-link" href="#bank" data-toggle="tab">Bank Card</a></li>
                                <li class="nav-item"><a class="nav-link" href="#game_activity" data-toggle="tab">Games Record</a></li>
                                <li class="nav-item"><a class="nav-link" href="#action" data-toggle="tab">Take Action</a></li>
                                <li class="nav-item"><a class="nav-link" href="#bonus" data-toggle="tab">Bonus History</a></li>
                                <li class="nav-item"><a class="nav-link" href="#penalty" data-toggle="tab">Penalty History</a></li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <!-- User's Complete Transaction History -->
                                <div class="active tab-pane" id="activity">
                                    <div class="card">
                                        <table id="example1" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Order ID</th>
                                                    <th>Amount</th>
                                                    <th>Type</th>
                                                    <th>UPI</th>
                                                    <!-- <th>Remark</th> -->
                                                    <th>UTR</th>
                                                    <th>Time</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sql = "SELECT * FROM paymenthistory WHERE userid='$id'";
                                                $res = mysqli_query($con, $sql);
                                                $i=1;
                                                while ($row = mysqli_fetch_assoc($res)) {
                                                ?>

                                                    <tr>
                                                        <td><?php echo $i++; ?></td>
                                                        <td><?php echo $row['order_id']; ?></td>
                                                        <td><?php echo $row['amount']; ?></td>
                                                        <td><?php echo $row['type']; ?></td>
                                                        <td><?php echo $row['upi']; ?></td>
                                                        <!-- <td><?php echo $row['remark']; ?></td> -->
                                                        <td><?php echo $row['utr']; ?></td>
                                                        <td><?php echo $row['created_at']; ?></td>
                                                        <td> <?php
                                                                if ($row['status'] == 2) {
                                                                    echo "<button class='btn btn-primary'>Pending</button>";
                                                                } elseif ($row['status'] == 1) {
                                                                    echo "<button class='btn btn-success'>Success</button>";
                                                                } else {
                                                                    echo "<button class='btn btn-danger'>Failed</button>";
                                                                }
                                                                ?></td>
                                                    </tr>
                                                <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- Deposit-Specific Transactions -->
                                <div class="tab-pane" id="timeline">
                                    <div class="card">
                                        <table id="example2" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Order ID</th>
                                                    <th>Amount</th>
                                                    <th>Type</th>
                                                    <th>UPI</th>
                                                    <!-- <th>Remark</th> -->
                                                    <th>UTR</th>
                                                    <th>Time</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sql = "SELECT * FROM paymenthistory where type='deposit' AND userid='$id'";
                                                $res = mysqli_query($con, $sql);
                                                $i=1;
                                                while ($row = mysqli_fetch_assoc($res)) {
                                                   
                                                ?>

                                                    <tr>
                                                        <td><?php echo $i++; ?></td>
                                                        <td><?php echo $row['order_id']; ?></td>
                                                        <td><?php echo $row['amount']; ?></td>
                                                        <td><?php echo $row['type']; ?></td>
                                                        <td><?php echo $row['upi']; ?></td>
                                                        <!-- <td><?php echo $row['remark']; ?></td> -->
                                                        <td><?php echo $row['utr']; ?></td>
                                                        <td><?php echo $row['created_at']; ?></td>
                                                        <td> <?php
                                                               if ($row['status'] == 2) {
                                                                echo "<button class='btn btn-primary'>Pending</button>";
                                                            } elseif ($row['status'] == 1) {
                                                                echo "<button class='btn btn-success'>Success</button>";
                                                            } else {
                                                                echo "<button class='btn btn-danger'>Failed</button>";
                                                            }
                                                            ?></td>
                                                    </tr>
                                                <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>

                                <!-- Withdrawal-Specific Transactions -->
                                <div class="tab-pane" id="settings">
                                    <div class="card">
                                        <table id="example3" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Order ID</th>
                                                    <th>Amount</th>
                                                    <th>Type</th>
                                                    <th>UPI</th>
                                                    <th>UTR</th>
                                                    <th>Time</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sql = "SELECT * FROM paymenthistory where type='withdraw' AND userid='$id'";
                                                $res = mysqli_query($con, $sql);
                                                $i=1;
                                                while ($row = mysqli_fetch_assoc($res)) {
                                                ?>

                                                    <tr>
                                                        <td><?php echo $i++; ?></td>
                                                        <td><?php echo $row['order_id']; ?></td>
                                                        <td><?php echo $row['amount']; ?></td>
                                                        <td><?php echo $row['type']; ?></td>
                                                        <td><?php echo $row['upi']; ?></td>
                                                        <td><?php echo $row['utr']; ?></td>
                                                        <td><?php echo $row['created_at']; ?></td>
                                                        <td> <?php
                                                                if ($row['status'] == 2) {
                                                                    echo "<button class='btn btn-primary'>Pending</button>";
                                                                } elseif ($row['status'] == 1) {
                                                                    echo "<button class='btn btn-success'>Success</button>";
                                                                } else {
                                                                    echo "<button class='btn btn-danger'>Failed</button>";
                                                                }
                                                                ?></td>
                                                    </tr>
                                                <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- Bank-Details -->
                                <div class="tab-pane" id="bank">
                                    <div class="card mt-4">
                                        <div class="card-header bg-primary text-white">
                                            <h4 class="card-title mb-0">Bank Details</h4>
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title">User Information</h5>
                                            <p class="card-text"><strong>Full Name:</strong> <?php echo $personal_data['full_name'] ?? 'N/A'; ?></p>
                                            <p class="card-text"><strong>Username:</strong> <?php echo $user['username'] ?? 'N/A'; ?></p>
                                            <p class="card-text"><strong>Mobile No.:</strong> <?php echo $user['mobile'] ?? 'N/A'; ?></p>

                                            <hr>

                                            <h5 class="card-title">Bank Information</h5>
                                            <p class="card-text"><strong>Bank Name:</strong> <?php echo $bank_data['bank_name'] ?? 'N/A'; ?></p>
                                            <p class="card-text"><strong>Bank Account:</strong> <?php echo $bank_data['bank_acc'] ?? 'N/A'; ?></p>
                                            <p class="card-text"><strong>IFSC Code:</strong> <?php echo $bank_data['bank_ifsc'] ?? 'N/A'; ?></p>
                                            <p class="card-text"><strong>Account Holder Name:</strong> <?php echo $bank_data['bank_holder'] ?? 'N/A'; ?></p>
                                            <p class="card-text"><strong>Bank Branch:</strong> <?php echo $bank_data['bank_branch'] ?? 'N/A'; ?></p>

                                            <hr>

                                            <h5 class="card-title">UPI & Status</h5>
                                            <p class="card-text"><strong>UPI:</strong> <?php echo $bank_data['upi'] ?? 'N/A'; ?></p>
                                            <p class="card-text"><strong>Bank Status:</strong>
                                                <?php echo ($bank_data['bank_status'] ?? 0) ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-secondary">Inactive</span>'; ?>
                                            </p>
                                            <p class="card-text"><strong>UPI Status:</strong>
                                                <?php echo ($bank_data['upi_status'] ?? 0) ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-secondary">Inactive</span>'; ?>
                                            </p>
                                            <p class="card-text"><strong>Created At:</strong> <?php echo $user['created_at'] ?? 'N/A'; ?></p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Game Activity -->
                                <div class="tab-pane" id="game_activity">
                                <div class="card">
                                        <table id="example5" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Game ID</th>
                                                    <th>Roomcode</th>
                                                    <th>Amount</th>
                                                    <th>Profit Amount</th>
                                                    <th>Remark</th>
                                                    <th>Created At</th>
                                                    <th>Status</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sql = "SELECT * FROM game_record where user_id='$id'";
                                                $res = mysqli_query($con, $sql);
                                                $i=1;

                                                while ($row = mysqli_fetch_assoc($res)) {
                                                    
                                                ?>

                                                    <tr>
                                                        <td><?php echo $i++; ?></td>
                                                        <td><?php echo $row['game_id']; ?></td>
                                                        <td>
                                                            <?php 
                                                            $room = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM games WHERE id='" . $row['game_id'] . "'"));
                                                            echo $room['roomcode'];
                                                            ?>
                                                        </td>
                                                        <td><?php echo $row['amount']; ?></td>
                                                        <td><?php echo $row['ProfitAmount']; ?></td>
                                                        <td><?php echo $row['remark']; ?></td>
                                                        <td><?php echo $row['created_at']; ?></td>
                                                        <td>
                                                            <?php
                                                            if ($row['status'] == 'won') {
                                                                echo "<button class='btn btn-success'>Won</button>";
                                                            } elseif ($row['status'] == 'lost') {
                                                                echo "<button class='btn btn-danger'>Lose</button>";
                                                            } elseif($row['status'] == 'game_refund') {
                                                                echo "<button class='btn btn-secondary'>Cancel</button>";

                                                            }elseif($row['status'] == 'game_win') {
                                                                echo "<button class='btn btn-success'>Won By Admin</button>";

                                                            } else {
                                                                echo "<button class='btn btn-primary'>Join</button>";
                                                            }
                                                            ?>
                                                        </td>
                                                    </tr>
                                                <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>

                                <!-- Action -->
                                <div class="tab-pane" id="action">
                                    <?php
                                    if (isset($_GET['id'])) {
                                        $id = mysqli_real_escape_string($con, $_GET['id']);

                                        // Fetch user status from the 'users' table
                                        $status_query = "SELECT status FROM users WHERE id='$id'";
                                        $status_result = mysqli_query($con, $status_query);
                                        $user = mysqli_fetch_assoc($status_result);

                                        if ($user) {
                                            $status = $user['status'];
                                        }
                                    }
                                    ?>
                                    <div class="card mt-4">
                                        <div class="card-header bg-primary text-white">
                                            <h4 class="card-title mb-0">User Management</h4>
                                        </div>
                                        <div class="card-body">
                                            <p class="card-text"><strong>User Status:</strong>
                                                <?php
                                                if ($status == 1) {
                                                    echo "Active";
                                                } elseif ($status == 0) {
                                                    echo "Temporarily Banned";
                                                } elseif ($status == 2) {
                                                    echo "Permanently Banned";
                                                } else {
                                                    echo "Unknown";
                                                }
                                                ?>
                                            </p>

                                            <?php if ($status == 1): ?>
                                                <form method="get" action="user_management.php">
                                                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                                                    <button type="submit" name="status" value="0" class="btn btn-warning">Temporary Ban</button>
                                                    <button type="submit" name="status" value="2" class="btn btn-danger">Permanent Ban</button>
                                                </form>
                                            <?php elseif ($status == 0): ?>
                                                <form method="get" action="user_management.php">
                                                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                                                    <button type="submit" name="status" value="1" class="btn btn-success">Re-Activate</button>
                                                    <button type="submit" name="status" value="2" class="btn btn-danger">Permanent Ban</button>
                                                </form>
                                            <?php elseif ($status == 2): ?>
                                                <p>User is permanently banned and cannot be re-activated.</p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <!-- Bonus History -->
                                <div class="tab-pane" id="bonus">
                                    <div class="card">
                                        <table id="example6" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>User ID</th>
                                                    <th>Amount</th>
                                                    <th>Given By</th>
                                                    <th>Created At</th>
                                                    <th>Remark</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (isset($_GET['id'])) {
                                                    $id = mysqli_real_escape_string($con, $_GET['id']);

                                                    // $userQuery = "SELECT mobile FROM users WHERE id='$id'";
                                                    // $userResult = mysqli_query($con, $userQuery);
                                                    // $user = mysqli_fetch_assoc($userResult);

                                                    // Fetch user status from the 'users' table
                                                    $bonus_query = "SELECT * FROM paymenthistory WHERE type = 'bonus' AND userid='$id'";
                                                    $bonus_result = mysqli_query($con, $bonus_query);



                                                    while ($row = mysqli_fetch_assoc($bonus_result)) {
                                                        $user = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM users WHERE id='" . $row['userid'] . "'"));
                                                ?>
                                                        <tr>
                                                            <td><?php echo $row['id']; ?></td>
                                                            <td><?php echo $user['mobile']; ?></td>
                                                            <td><?php echo $row['amount']; ?></td>
                                                            <td><?php echo $row['upi']; ?></td>
                                                            <td><?php echo $row['created_at']; ?></td>
                                                            <td><?php echo $row['remark']; ?></td>
                                                        </tr>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>


                                <!-- Penalty History -->
                                <div class="tab-pane" id="penalty">
                                    <div class="card">
                                        <table id="example1" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>User</th>
                                                    <th>Amount</th>
                                                    <th>Admin ID</th>
                                                    <th>Battle ID</th>
                                                    <th>Remark</th>
                                                    <th>Created At</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (isset($_GET['id'])) {
                                                    $id = mysqli_real_escape_string($con, $_GET['id']);



                                                    $penalty_query = "SELECT * FROM paymenthistory WHERE type='penalty' AND userid='$id'";
                                                    $penalty_result = mysqli_query($con, $penalty_query);

                                                    while ($row = mysqli_fetch_assoc($penalty_result)) {
                                                        $user = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM users WHERE id='" . $row['userid'] . "'"));

                                                ?>
                                                        <tr>
                                                            <td><?php echo $row['id']; ?></td>
                                                            <td><?php echo $user['mobile']; ?></td>
                                                            <td><?php echo $row['amount']; ?></td>
                                                            <td><?php echo $row['upi']; ?></td>
                                                            <td><?php echo $row['utr']; ?></td>
                                                            <td><?php echo $row['remark']; ?></td>
                                                            <td><?php echo $row['created_at']; ?></td>
                                                        </tr>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

            </div>

        </div>
    </section>

</div>




<?php
include("footer.php");
?>