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
                    <h1 class="m-0">Withdraw</h1>
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
                    <li class="nav-item"><a class="nav-link active" href="#pending" data-toggle="tab">Pending</a></li>
                    <li class="nav-item"><a class="nav-link" href="#complete" data-toggle="tab">Complete</a></li>
                    <li class="nav-item"><a class="nav-link" href="#failed" data-toggle="tab">Failed</a></li>
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
                                            <th>Transaction ID</th>
                                            <th>Amount</th>
                                            <th>Type</th>
                                            <th>Created At</th>
                                            <th>Remark</th>
                                            <?php
                                        if($role_id!=3){
                                        ?>
                                        <th>Action</th>
                                        <?php
                                        }
                                        ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = "SELECT * FROM withdrawrecord WHERE status=0 order by id desc";
                                        $res = mysqli_query($con, $sql);
                                        $i=1;
                                        while ($row = mysqli_fetch_assoc($res)) {
                                            $user=mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM users WHERE id='".$row['userid']."'"));
                                        ?>

                                            <tr>
                                                <td><?php echo $i++; ?></td>
                                                <td><?php echo $user['mobile']; ?></td>
                                                <td><?php echo $row['txnid']; ?></td>
                                                <td><?php echo $row['amount']; ?></td>
                                                <td><?php echo $row['type']; ?></td>
                                                <td><?php echo $row['created_at']; ?></td>
                                                <td><?php echo $row['remark']; ?></td>
                                                <?php
                                        if($role_id!=3){
                                        ?>
                                        <td>
                                                    <a href="withdrawAction.php?id=<?php echo $row['id']; ?>&action=1" class="btn btn-success">Approve</a>
                                                    <a href="withdrawAction.php?id=<?php echo $row['id']; ?>&action=2" class="btn btn-danger">Reject</a>
                                                    <button onclick="info('<?=$user['mobile'] ?>')" class="btn btn-danger">Reject</button>
                                                </td>
                                        <?php
                                        }
                                        ?>
                                               
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>

                    </div>

                    <div class="tab-pane" id="complete">
                        <div class="card">
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Mobile No.</th>
                                            <th>Transaction ID</th>
                                            <th>Amount</th>
                                            <th>Type</th>
                                            <th>Created At</th>
                                            <th>Remark</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = "SELECT * FROM withdrawrecord WHERE status=1 order by id desc";
                                        $res = mysqli_query($con, $sql);
                                        $i=1;
                                        while ($row = mysqli_fetch_assoc($res)) {
                                            $user=mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM users WHERE id='".$row['userid']."'"));
                                        ?>

                                            <tr>
                                                <td><?php echo $i++; ?></td>
                                                <td><?php echo $user['mobile']; ?></td>
                                                <td><?php echo $row['txnid']; ?></td>
                                                <td><?php echo $row['amount']; ?></td>
                                                <td><?php echo $row['type']; ?></td>
                                                <td><?php echo $row['created_at']; ?></td>
                                                <td><?php echo $row['remark']; ?></td>
                                               
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>






                    </div>

                    <div class="tab-pane" id="failed">
                        <div class="card">
                            <div class="card-body">
                                <table id="example3" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Mobile No.</th>
                                            <th>Transaction ID</th>
                                            <th>Amount</th>
                                            <th>Type</th>
                                            <th>Created At</th>
                                            <th>Remark</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = "SELECT * FROM withdrawrecord WHERE status=2 order by id desc";
                                        $res = mysqli_query($con, $sql);
                                        $i=1;
                                        while ($row = mysqli_fetch_assoc($res)) {
                                            $user=mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM users WHERE id='".$row['userid']."'"));
                                        ?>

                                            <tr>
                                                <td><?php echo $i++ ?></td>
                                                <td><?php echo $user['mobile']; ?></td>
                                                <td><?php echo $row['txnid']; ?></td>
                                                <td><?php echo $row['amount']; ?></td>
                                                <td><?php echo $row['type']; ?></td>
                                                <td><?php echo $row['created_at']; ?></td>
                                                <td><?php echo $row['remark']; ?></td>
                                                
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>






                    </div>


                </div>

            </div>


        </div>

        <script>
            function info(mobile){
                alert(mobile);
            }
        </script>

        <?php
        include("footer.php");
        ?>

