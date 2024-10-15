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
          <h1 class="m-0">Dashboard</h1>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3>150</h3>

              <p>New Orders</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3>53<sup style="font-size: 20px">%</sup></h3>

              <p>Bounce Rate</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
              <h3>44</h3>

              <p>User Registrations</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-danger">
            <div class="inner">
              <h3>65</h3>

              <p>Unique Visitors</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
      <!-- Main row -->

      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
            <div class="d-flex justify-content-between w-100">
              <h3 class="card-title">Recent Users</h3>
              <button type="button" class="btn btn-danger btn-sm" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
            </button>
            </div>
            </div>
            
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>username</th>
                    <th>Mobile</th>
                    <th>wallet</th>
                    <th>Created At</th>
                    <th>KYC Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $sql = "SELECT * FROM users ORDER BY created_at DESC";
                  $res = mysqli_query($con, $sql);
                  while ($row = mysqli_fetch_assoc($res)) {
                  ?>
                    <tr>
                      <td><?php echo $row['id']; ?></td>
                      <td><?php echo $row['username']; ?></td>
                      <td><?php echo $row['mobile']; ?></td>
                      <td><?php echo $row['deposit_wallet'] + $row['withdraw_wallet']; ?></td>
                      <td><?php echo $row['created_at']; ?></td>
                      <td><?php echo $row['kyc_status']; ?></td>
                      <td><a href="viewUser?id=<?php echo $row['id'] ?>" class="btn btn-warning">View</a></td>
                    </tr>
                  <?php
                  }
                  ?>
                </tbody>
              </table>

            

        </div><!-- /.container-fluid -->
      </div><!-- /.container-fluid -->

      
      <div class="row">
        <div class="col-md-12">
        <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between w-100">
            <h3 class="card-title">Recent Deposit Transition</h3>
              <button type="button" class="btn btn-danger btn-sm" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
            </button>
            </div>
            </div>
        <div class="card-body">
          
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Mobile No.</th>
                        <th>Order ID</th>
                        <th>Amount</th>
                        <th>UPI</th>
                        <th>Remark</th>
                        <th>UTR</th>
                        <th>Time</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $sql = "SELECT * FROM paymenthistory WHERE type='deposit' ORDER BY created_at DESC";
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
                        <?php 
                        if($row['status'] == 0){
                          ?>
                          <form action="update_status.php" method="post">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <input type="hidden" name="type" value="deposit">
                            <input type="hidden" name="status" value="1">
                            <td><button class="btn btn-success" name="update_status">Update Status</button></td>
                          </form>
                            
                          <?php
                        }else{
                        ?>
                        <td></td>
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
      <div class="row">
        <div class="col-md-12">
        <div class="card">
        <div class="card-header">
              
           
            <div class="d-flex justify-content-between w-100">
            <h3 class="card-title">Recent Withdraw Transition</h3>
              <button type="button" class="btn btn-danger btn-sm" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
            </button>
            </div>
            </div>

        <div class="card-body">
          
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Mobile No.</th>
                        <th>Order ID</th>
                        <th>Amount</th>
                        <th>UPI</th>
                        <th>Remark</th>
                        <th>UTR</th>
                        <th>Time</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $sql = "SELECT * FROM paymenthistory WHERE type='withdraw' ORDER BY created_at DESC";
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
      </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>

<?php
include("footer.php");
?>