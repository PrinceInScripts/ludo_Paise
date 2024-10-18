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
                                <!-- User's Complete Transaction History -->
                                <div class="active tab-pane" id="pending">
                                <div class="card">
                                        <table id="example1" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Mobile No.</th>
                                                    <th>Order ID</th>
                                                    <th>Amount</th>
                                                    <th>Type</th>
                                                    <th>UPI</th>
                                                    <!-- <th>Remark</th> -->
                                                    <th>UTR</th>
                                                    <th>Time</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sql = "SELECT * FROM paymenthistory where type='deposit' AND status=0 ORDER BY id DESC"; 
                                                $res = mysqli_query($con, $sql);
                                                $i = 1;
                                                while ($row = mysqli_fetch_assoc($res)) {
                                                    $id = $row['userid'];
                                                    

                                                    $userQuery = "SELECT mobile FROM users WHERE id='$id'";
                                                    $userResult = mysqli_query($con, $userQuery);
                                                    $user = mysqli_fetch_assoc($userResult);
                                                ?>

                                                    <tr>
                                                        <td><?php echo $i ?></td>
                                                        <td><?php echo $user['mobile']; ?></td>
                                                        <td><?php echo $row['order_id']; ?></td>
                                                        <td><?php echo $row['amount']; ?></td>
                                                        <td><?php echo $row['type']; ?></td>
                                                        <td><?php echo $row['upi']; ?></td>
                                                        <!-- <td><?php echo $row['remark']; ?></td> -->
                                                        <td><?php echo $row['utr']; ?></td>
                                                        <td><?php echo $row['created_at']; ?></td>
                                                        <td> 
                                                            <a href="depositAction.php?id=<?php echo $row['id']; ?>&action=2" class="btn btn-danger">Reject</a>
                                                            <a href="depositAction.php?id=<?php echo $row['id']; ?>&action=1" class="btn btn-success">Accept</a>
                                                            <?php
                                                            if($row['payment_ss']!=NULL){
                                                                ?>
                                                                <button class="btn btn-primary" onclick="viewPayment('<?=$row['payment_ss']?>','<?=$row['order_id']?>')">View Screenshot</button>
                                                                <?php 
                                                            }
                                                            ?>
                                                        </td>
                                                    </tr>
                                                <?php
                                                $i = $i + 1;
                                                }
                                                ?>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>

                                <!-- Deposit-Specific Transactions -->
                                <div class="tab-pane" id="complete">
                                    <div class="card">
                                        <table id="example1" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Mobile No.</th>
                                                    <th>Order ID</th>
                                                    <th>Amount</th>
                                                    <th>Type</th>
                                                    <th>UPI</th>
                                                    <!-- <th>Remark</th> -->
                                                    <th>UTR</th>
                                                    <th>Time</th>
                                                    <!-- <th>Action</th> -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sql = "SELECT * FROM paymenthistory where type='deposit' AND status=1 ORDER BY id DESC";
                                                $res = mysqli_query($con, $sql);
                                                $j = 1;

                                                while ($row = mysqli_fetch_assoc($res)) {
                                                    $id = $row['userid'];

                                                    $userQuery = "SELECT mobile FROM users WHERE id='$id'";
                                                    $userResult = mysqli_query($con, $userQuery);
                                                    $user = mysqli_fetch_assoc($userResult);
                                                ?>

                                                    <tr>
                                                        <td><?php echo $j++ ?></td>
                                                        <td><?php echo $user['mobile']; ?></td>
                                                        <td><?php echo $row['order_id']; ?></td>
                                                        <td><?php echo $row['amount']; ?></td>
                                                        <td><?php echo $row['type']; ?></td>
                                                        <td><?php echo $row['upi']; ?></td>
                                                        <!-- <td><?php echo $row['remark']; ?></td> -->
                                                        <td><?php echo $row['utr']; ?></td>
                                                        <td><?php echo $row['created_at']; ?></td>
                                                        
                                                    </tr>
                                                <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>

                                <!-- Withdrawal-Specific Transactions -->
                                <div class="tab-pane" id="failed">
                                <div class="card">
                                        <table id="example1" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Mobile No.</th>
                                                    <th>Order ID</th>
                                                    <th>Amount</th>
                                                    <th>Type</th>
                                                    <th>UPI</th>
                                                    <!-- <th>Remark</th> -->
                                                    <th>UTR</th>
                                                    <th>Time</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sql = "SELECT * FROM paymenthistory where type='deposit' AND status=2 ORDER BY id DESC";
                                                $res = mysqli_query($con, $sql);
                                                $k = 1;

                                                while ($row = mysqli_fetch_assoc($res)) {
                                                    $id = $row['userid'];

                                                    $userQuery = "SELECT mobile FROM users WHERE id='$id'";
                                                    $userResult = mysqli_query($con, $userQuery);
                                                    $user = mysqli_fetch_assoc($userResult);
                                                ?>

                                                    <tr>
                                                        <td><?php echo $k++ ?></td>
                                                        <td><?php echo $user['mobile']; ?></td>
                                                        <td><?php echo $row['order_id']; ?></td>
                                                        <td><?php echo $row['amount']; ?></td>
                                                        <td><?php echo $row['type']; ?></td>
                                                        <td><?php echo $row['upi']; ?></td>
                                                        <!-- <td><?php echo $row['remark']; ?></td> -->
                                                        <td><?php echo $row['utr']; ?></td>
                                                        <td><?php echo $row['created_at']; ?></td>
                                                       
                                                    </tr>
                                                <?php
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

<!-- swal fire cdn  -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
    function viewPayment(payment_ss,txn_id){
    //    swal fire to show mobile screenshot of payment src = payment_ss with html tag
    
    Swal.fire({
        title: 'Payment Screenshot',
        html: `<img src="../assets/payment/screenshot/${txn_id}/${payment_ss}" class="img-fluid" alt="Payment Screenshot">`,
        showCloseButton: true,
        showCancelButton: false,
        showConfirmButton: false,
        focusConfirm: false,
        confirmButtonText: 'Close',
    })






    }
</script>

<?php
include ("footer.php");
?>
