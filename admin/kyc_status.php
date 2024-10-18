<?php
include("db.php");
include("top.php");
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">KYC Status</h1>
                </div>
                <div class="col-sm-6"></div>
            </div>
        </div>
    </div>

    <div class="col-md">
        <div class="card">
            <div class="card-header p-2">
                <!-- Navigation Tabs -->
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active" href="#pending" data-toggle="tab">Not Verified</a></li>
                    <li class="nav-item"><a class="nav-link" href="#complete" data-toggle="tab">Verified</a></li>
                    <li class="nav-item"><a class="nav-link" href="#reject" data-toggle="tab">Rejected</a></li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">

                    <div class="active tab-pane" id="pending">
                        <div class="card">
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Mobile No.</th>
                                            <th>username</th>
                                            <th>Email</th>
                                            <th>Adhaar No.</th>
                                            <th>Deposit Money</th>
                                            <th>Withdraw Money</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = "SELECT * FROM users where kyc_status='0'";
                                        $res = mysqli_query($con, $sql);
                                        while ($row = mysqli_fetch_assoc($res)) { ?>
                                            <tr>
                                                <td><?php echo $row['id'] ?></td>
                                                <td><?php echo $row['mobile'] ?></td>
                                                <td><?php echo $row['username'] ?></td>
                                                <td><?php echo $row['email'] ?></td>
                                                <td><?php echo $row['adhaar_no'] ?></td>
                                                <td><?php echo $row['deposit_wallet'] ?></td>
                                                <td><?php echo $row['withdraw_wallet'] ?></td>
                                                
                                            </tr>
                                        <?php
                                        }
                                        ?>

                                        </tfoot>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>

                    </div>

                    <div class="tab-pane" id="complete">
                        <div class="card">

                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Mobile No.</th>
                                            <th>username</th>
                                            <th>Email</th>
                                            <th>Adhaar No.</th>
                                            <th>Deposit Money</th>
                                            <th>Withdraw Money</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = "SELECT * FROM users where kyc_status='1'";
                                        $res = mysqli_query($con, $sql);
                                        while ($row = mysqli_fetch_assoc($res)) { ?>
                                            <tr>
                                                <td><?php echo $row['id'] ?></td>
                                                <td><?php echo $row['mobile'] ?></td>
                                                <td><?php echo $row['username'] ?></td>
                                                <td><?php echo $row['email'] ?></td>
                                                <td><?php echo $row['adhaar_no'] ?></td>
                                                <td><?php echo $row['deposit_wallet'] ?></td>
                                                <td><?php echo $row['withdraw_wallet'] ?></td>
                                               
                                            </tr>
                                        <?php
                                        }
                                        ?>

                                        </tfoot>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>

                    <div class="tab-pane" id="reject">
                        <div class="card">
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Mobile No.</th>
                                            <th>username</th>
                                            <th>Email</th>
                                            <th>Adhaar No.</th>
                                            <th>Deposit Money</th>
                                            <th>Withdraw Money</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = "SELECT * FROM users where kyc_status='2'";
                                        $res = mysqli_query($con, $sql);
                                        while ($row = mysqli_fetch_assoc($res)) { ?>
                                            <tr>
                                                <td><?php echo $row['id'] ?></td>
                                                <td><?php echo $row['mobile'] ?></td>
                                                <td><?php echo $row['username'] ?></td>
                                                <td><?php echo $row['email'] ?></td>
                                                <td><?php echo $row['adhaar_no'] ?></td>
                                                <td><?php echo $row['deposit_wallet'] ?></td>
                                                <td><?php echo $row['withdraw_wallet'] ?></td>
                                               
                                            </tr>
                                        <?php
                                        }
                                        ?>

                                        </tfoot>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>

                    </div>


                </div>

            </div>


        </div>

        <?php
        include("footer.php");
        ?>