<?php
include ("db.php");
include ("top.php");
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Deposit</h1>
                </div>
                <div class="col-sm-6"></div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Mobile No.</th>
                        <th>Order ID</th>
                        <th>Amount</th>
                        <th>Type</th>
                        <th>UPI</th>
                        <th>Remark</th>
                        <th>UTR</th>
                        <th>Time</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $sql = "SELECT * FROM paymenthistory WHERE type='deposit'";
                $res = mysqli_query($con, $sql);

                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['userid'];
                    // Corrected SQL query to retrieve the mobile number
                    $userQuery = "SELECT mobile FROM users WHERE id='$id'";
                    $userResult = mysqli_query($con, $userQuery);
                    $user = mysqli_fetch_assoc($userResult); // Fetch user details
                    ?>

                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $user['mobile']; ?></td>
                        <td><?php echo $row['order_id']; ?></td>
                        <td><?php echo $row['amount']; ?></td>
                        <td><?php echo $row['type']; ?></td>
                        <td><?php echo $row['upi']; ?></td>
                        <td><?php echo $row['remark']; ?></td>
                        <td><?php echo $row['utr']; ?></td>
                        <td><?php echo $row['created_at']; ?></td>
                        <td> <?php 
                            if ($row['status'] == 2) {
                                echo "<span style='color: orange;'>Failed</span>";
                            } elseif ($row['status'] == 1) {
                                echo "<span style='color: green;'>Success</span>";
                            } else if($row['status'] == 0){
                                echo "<span style='color: red;'>Pending</span>";
                            }
                            ?></td>
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

<?php
include ("footer.php");
?>
