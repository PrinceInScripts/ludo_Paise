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
      <h2 class="my-2">Earnings</h2>
      <div class="row">

        <!-- Total Earning -->
        <?php
        $total_sql = "SELECT * FROM games where status='complete'";
        $total_run = mysqli_query($con, $total_sql);
        $total_earning = 0;
        while ($row = mysqli_fetch_assoc($total_run)) {
          $total_amount = $row['amount'] * 2;
          $win_amount = $row['winAmount'];
          $wining_amount = $total_amount - $win_amount;
          $total_earning += $wining_amount;
        }
        ?>
        <div class="col-lg-3 col-6">
          <div class="small-box bg-info">
            <div class="inner">
              <h3><?php echo "₹" . number_format($total_earning, 2) ?></h3>

              <p>Total Earning</p>
            </div>
            <div class="icon">
              <i class="ion ion-cash"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <!-- Monthly Earning -->
        <?php
        // Monthly Earnings (Last 30 Days)
        $monthly_sql = "SELECT * FROM games WHERE status='complete' AND created_at >= DATE_SUB(CURDATE(), INTERVAL 30 DAY)";
        $monthly_run = mysqli_query($con, $monthly_sql);
        $monthly_earning = 0;

        while ($row = mysqli_fetch_assoc($monthly_run)) {
          $total_amount = $row['amount'] * 2;
          $win_amount = $row['winAmount'];
          $wining_amount = $total_amount - $win_amount;
          $monthly_earning += $wining_amount;
        }
        ?>
        <div class="col-lg-3 col-6">
          <div class="small-box bg-success">
            <div class="inner">
              <h3><?php echo "₹" . number_format($monthly_earning, 2) ?></h3>

              <p>Monthly Earning</p>
            </div>
            <div class="icon">
              <i class="ion ion-cash"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <!-- Today Earning -->
        <?php
        $today_sql = "SELECT * FROM games WHERE status='complete' AND DATE(created_at) = CURDATE()";
        $today_run = mysqli_query($con, $today_sql);
        $today_earning = 0;

        while ($row = mysqli_fetch_assoc($today_run)) {
          $total_amount = $row['amount'] * 2;
          $win_amount = $row['winAmount'];
          $wining_amount = $total_amount - $win_amount;
          $today_earning += $wining_amount;
        }
        ?>
        <div class="col-lg-3 col-6">
          <div class="small-box bg-warning">
            <div class="inner">
              <h3><?php echo "₹" . number_format($today_earning, 2) ?></h3>

              <p>Today Earning</p>
            </div>
            <div class="icon">
              <i class="ion ion-cash"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>


        <!-- Total Transactions -->
        <?php
        $total_transactions_sql = "SELECT COUNT(*) as total_transactions FROM games WHERE status='complete'";
        $total_transactions_run = mysqli_query($con, $total_transactions_sql);
        $total_transactions_data = mysqli_fetch_assoc($total_transactions_run);
        $total_transactions = $total_transactions_data['total_transactions'];
        ?>
        <div class="col-lg-3 col-6">
          <div class="small-box bg-danger">
            <div class="inner">
              <h3><?php echo $total_transactions ?></h3>
              <p>Total Transactions</p>
            </div>
            <div class="icon">
              <i class="ion ion-cash"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>

      </div>

      <h2 class="my-2">Balance</h2>
      <div class="row">

        <!-- Total Earning -->
        <?php

        $total_sql = "SELECT SUM(deposit_wallet) as total_deposit, SUM(withdraw_wallet) as total_withdraw FROM users";
        $total_run = mysqli_query($con, $total_sql);
        $total_data = mysqli_fetch_assoc($total_run);
        $total_money = $total_data['total_deposit'] + $total_data['total_withdraw'];
        ?>
        <div class="col-lg-3 col-6">
          <div class="small-box bg-info">
            <div class="inner">
              <h3><?php echo "₹" . number_format($total_money, 2) ?></h3>

              <p>Total Balance</p>
            </div>
            <div class="icon">
              <i class="ion ion-cash"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <!-- Monthly Earning -->
        <?php
        // Monthly Earnings (Last 30 Days)
        $total_sql = "SELECT SUM(deposit_wallet) as total_deposit FROM users";
        $total_run = mysqli_query($con, $total_sql);
        $total_deposit = mysqli_fetch_assoc($total_run);



        ?>
        <div class="col-lg-3 col-6">
          <div class="small-box bg-success">
            <div class="inner">
              <h3><?php echo "₹" . number_format($total_deposit['total_deposit'], 2) ?></h3>

              <p>Total Deposit Wallet</p>
            </div>
            <div class="icon">
              <i class="ion ion-cash"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <!-- Today Earning -->
        <?php
        $total_sql = "SELECT SUM(withdraw_wallet) as total_withdraw FROM users";
        $total_run = mysqli_query($con, $total_sql);
        $total_withdraw = mysqli_fetch_assoc($total_run);
        ?>
        <div class="col-lg-3 col-6">
          <div class="small-box bg-warning">
            <div class="inner">
              <h3><?php echo "₹" . number_format($total_withdraw['total_withdraw'], 2) ?></h3>

              <p>Total Withdraw Balance</p>
            </div>
            <div class="icon">
              <i class="ion ion-cash"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>


        <!-- Total Transactions -->
        <?php
         $total_withdraw_hold_sql="SELECT SUM(amount) as withdraw_hold FROM withdrawrecord WHERE status=0";
          $total_withdraw_hold_run=mysqli_query($con,$total_withdraw_hold_sql);
          $total_withdraw_hold_data=mysqli_fetch_assoc($total_withdraw_hold_run);
        ?>
        <div class="col-lg-3 col-6">
          <div class="small-box bg-danger">
            <div class="inner">
              <h3><h3><?php echo "₹" . number_format($total_withdraw_hold_data['withdraw_hold'], 2) ?></h3></h3>
              <p>Total Withdraw Hold Money</p>
            </div>
            <div class="icon">
              <i class="ion ion-cash"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>

      </div>

      <!-- Deposit Transition -->

      <h2 class="my-2">Deposit</h2>
      <div class="row">

        <!-- Total Deposit -->
        <?php

        $total_sql = "SELECT SUM(deposit_wallet) as total_deposit_money FROM users";
        $total_run = mysqli_query($con, $total_sql);
        $total_data = mysqli_fetch_assoc($total_run);
        $total_deposit_money = $total_data['total_deposit_money'];
        ?>
        <div class="col-lg-3 col-6">
          <div class="small-box bg-info">
            <div class="inner">
              <h3><?php echo "₹" . number_format($total_deposit_money, 2) ?></h3>

              <p>Total Deposit Balance</p>
            </div>
            <div class="icon">
              <i class="ion ion-cash"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <!-- Monthly Earning -->
        <?php
        // Monthly Earnings (Last 30 Days)
        $total_sql = "SELECT SUM(deposit_wallet) as total_monthly_deposit FROM users WHERE created_at >= DATE_SUB(CURDATE(), INTERVAL 30 DAY)";
        $total_run = mysqli_query($con, $total_sql);
        $total_monthly_deposit = mysqli_fetch_assoc($total_run);
        ?>
        <div class="col-lg-3 col-6">
          <div class="small-box bg-success">
            <div class="inner">
              <h3><?php echo "₹" . number_format($total_monthly_deposit['total_monthly_deposit'], 2) ?></h3>

              <p>Total Monthly Deposit Wallet</p>
            </div>
            <div class="icon">
              <i class="ion ion-cash"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <!-- Weekly Earning (last 7 days)-->
        <?php
        $total_sql = "SELECT SUM(deposit_wallet) as total_weekly__deposit FROM users WHERE created_at >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)";
        $total_run = mysqli_query($con, $total_sql);
        $total_weekly__deposit = mysqli_fetch_assoc($total_run);
        ?>
        <div class="col-lg-3 col-6">
          <div class="small-box bg-warning">
            <div class="inner">
              <h3><?php echo "₹" . number_format($total_weekly__deposit['total_weekly__deposit'], 2) ?></h3>

              <p>Total Weekly Deposit Balance</p>
            </div>
            <div class="icon">
              <i class="ion ion-cash"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>


         <!-- Day Earning (last 1 days)-->
         <?php
        $total_sql = "SELECT SUM(deposit_wallet) as total_day__deposit FROM users WHERE created_at >= DATE_SUB(CURDATE(), INTERVAL 1 DAY)";
        $total_run = mysqli_query($con, $total_sql);
        $total_day__deposit = mysqli_fetch_assoc($total_run);
        ?>
        <div class="col-lg-3 col-6">
          <div class="small-box bg-warning">
            <div class="inner">
              <h3><?php echo "₹" . number_format($total_day__deposit['total_day__deposit'], 2) ?></h3>

              <p>Total Today Deposit Balance</p>
            </div>
            <div class="icon">
              <i class="ion ion-cash"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>

      </div>



      <!-- Users -->
      <h2 class="my-2">Users</h2>
      <div class="row">

        <!-- Total Users -->
        <?php
        $total_users_sql = "SELECT COUNT(*) as total_users FROM users WHERE role='user'";
        $total_users_run = mysqli_query($con, $total_users_sql);
        $total_users_data = mysqli_fetch_assoc($total_users_run);
        $total_users = $total_users_data['total_users'];
        ?>
        <div class="col-lg-3 col-6">
          <div class="small-box bg-info">
            <div class="inner">
              <h3><?php echo $total_users ?></h3>

              <p>Total Users</p>
            </div>
            <div class="icon">
              <i class="ion ion-person"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <!-- Monthly New Users -->
        <?php
        $monthly_users_sql = "SELECT COUNT(*) as monthly_users FROM users WHERE role='user' AND created_at >= DATE_SUB(CURDATE(), INTERVAL 30 DAY)";
        $monthly_users_run = mysqli_query($con, $monthly_users_sql);
        $monthly_users_data = mysqli_fetch_assoc($monthly_users_run);
        $monthly_users = $monthly_users_data['monthly_users'];
        ?>
        <div class="col-lg-3 col-6">
          <div class="small-box bg-success">
            <div class="inner">
              <h3><?php echo $monthly_users ?></h3>
              <p>Monthly New Users</p>
            </div>
            <div class="icon">
              <i class="ion ion-person"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <!-- Today's New Users -->
        <?php
        $today_users_sql = "SELECT COUNT(*) as today_users FROM users WHERE role='user' AND DATE(created_at) = CURDATE()";
        $today_users_run = mysqli_query($con, $today_users_sql);
        $today_users_data = mysqli_fetch_assoc($today_users_run);
        $today_users = $today_users_data['today_users'];
        ?>
        <div class="col-lg-3 col-6">
          <div class="small-box bg-warning">
            <div class="inner">
              <h3><?php echo $today_users ?></h3>
              <p>Today’s New Users</p>
            </div>
            <div class="icon">
              <i class="ion ion-person"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>


        <!-- Active Users -->
        <?php
        $active_users_sql = "SELECT COUNT(*) as active_users FROM users WHERE role='user' AND kyc_status=1";
        $active_users_run = mysqli_query($con, $active_users_sql);
        $active_users_data = mysqli_fetch_assoc($active_users_run);
        $active_users = $active_users_data['active_users'];
        ?>
        <div class="col-lg-3 col-6">
          <div class="small-box bg-danger">
            <div class="inner">
              <h3><?php echo $active_users ?></h3>
              <p>Active Users</p>
            </div>
            <div class="icon">
              <i class="ion ion-person"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>

      </div>

      <!-- Total Battle -->
      <h2 class="my-2">Total Battles</h2>
      <div class="row">

        <!-- Total Game Battles -->
        <?php
        $total_battles_sql = "SELECT COUNT(*) as total_battles FROM games";
        $total_battles_run = mysqli_query($con, $total_battles_sql);
        $total_battles_data = mysqli_fetch_assoc($total_battles_run);
        $total_battles = $total_battles_data['total_battles'];
        ?>
        <div class="col-lg-3 col-6">
          <div class="small-box bg-info">
            <div class="inner">
              <h3><?php echo $total_battles ?></h3>

              <p>Total Battle</p>
            </div>
            <div class="icon">
              <i class="ion ion-trophy"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <!-- Completed Games -->
        <?php
        $completed_sql = "SELECT COUNT(*) as completed FROM games WHERE status='complete'";
        $completed_run = mysqli_query($con, $completed_sql);
        $completed_data = mysqli_fetch_assoc($completed_run);
        $completed = $completed_data['completed'];
        ?>
        <div class="col-lg-3 col-6">
          <div class="small-box bg-success">
            <div class="inner">
              <h3><?php echo $completed ?></h3>
              <p>Total Complete Battle</p>
            </div>
            <div class="icon">
              <i class="ion ion-trophy"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <!-- Conflicted Games -->
        <?php
        $conflicted_sql = "SELECT COUNT(*) as conflicted FROM games WHERE status='conflict'";
        $conflicted_run = mysqli_query($con, $conflicted_sql);
        $conflicted_data = mysqli_fetch_assoc($conflicted_run);
        $conflicted = $conflicted_data['conflicted'];
        ?>
        <div class="col-lg-3 col-6">
          <div class="small-box bg-warning">
            <div class="inner">
              <h3><?php echo $conflicted ?></h3>
              <p>Total Conflict Battle</p>
            </div>
            <div class="icon">
              <i class="ion ion-trophy"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>


        <!-- Cancelled Games -->
        <?php
        $cancelled_total_sql = "SELECT COUNT(*) as cancelled FROM games WHERE status='cancel'";
        $cancelled_total_run = mysqli_query($con, $cancelled_total_sql);
        $cancelled_total_data = mysqli_fetch_assoc($cancelled_total_run);
        $cancelled_total = $cancelled_total_data['cancelled'];
        ?>
        <div class="col-lg-3 col-6">
          <div class="small-box bg-danger">
            <div class="inner">
              <h3><?php echo $cancelled_total ?></h3>
              <p>Total Cancelled Battle</p>
            </div>
            <div class="icon">
              <i class="ion ion-trophy"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>

      </div>

      <!--Today's Total Battle -->
      <h2 class="my-2">Today’s Battles</h2>
      <div class="row">

        <!-- Today's Total Game Battles -->
        <?php
        $total_battles_today_sql = "SELECT COUNT(*) as total_battles FROM games WHERE DATE(created_at) = CURDATE()";
        $total_battles_today_run = mysqli_query($con, $total_battles_today_sql);
        $total_battles_today_data = mysqli_fetch_assoc($total_battles_today_run);
        $total_battles_today = $total_battles_today_data['total_battles'];
        ?>
        <div class="col-lg-3 col-6">
          <div class="small-box bg-info">
            <div class="inner">
              <h3><?php echo $total_battles_today ?></h3>
              <p>Today's Total Battles</p>
            </div>
            <div class="icon">
              <i class="ion ion-trophy"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <!-- Today's Completed Games -->
        <?php
        $completed_today_sql = "SELECT COUNT(*) as completed FROM games WHERE status='complete' AND DATE(created_at) = CURDATE()";
        $completed_today_run = mysqli_query($con, $completed_today_sql);
        $completed_today_data = mysqli_fetch_assoc($completed_today_run);
        $completed_today = $completed_today_data['completed'];
        ?>
        <div class="col-lg-3 col-6">
          <div class="small-box bg-success">
            <div class="inner">
              <h3><?php echo $completed_today ?></h3>
              <p>Today's Completed Battles</p>
            </div>
            <div class="icon">
              <i class="ion ion-trophy"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <!-- Today's Conflicted Games -->
        <?php
        $conflicted_today_sql = "SELECT COUNT(*) as conflicted FROM games WHERE status='conflict' AND DATE(created_at) = CURDATE()";
        $conflicted_today_run = mysqli_query($con, $conflicted_today_sql);
        $conflicted_today_data = mysqli_fetch_assoc($conflicted_today_run);
        $conflicted_today = $conflicted_today_data['conflicted'];
        ?>
        <div class="col-lg-3 col-6">
          <div class="small-box bg-warning">
            <div class="inner">
              <h3><?php echo $conflicted_today ?></h3>
              <p>Today's Conflicted Battles</p>
            </div>
            <div class="icon">
              <i class="ion ion-trophy"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <!-- Today's Cancelled Games -->
        <?php
        $cancelled_today_sql = "SELECT COUNT(*) as cancelled FROM games WHERE status='cancel' AND DATE(created_at) = CURDATE()";
        $cancelled_today_run = mysqli_query($con, $cancelled_today_sql);
        $cancelled_today_data = mysqli_fetch_assoc($cancelled_today_run);
        $cancelled_today = $cancelled_today_data['cancelled'];
        ?>
        <div class="col-lg-3 col-6">
          <div class="small-box bg-danger">
            <div class="inner">
              <h3><?php echo $cancelled_today ?></h3>
              <p>Today's Cancelled Battles</p>
            </div>
            <div class="icon">
              <i class="ion ion-trophy"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>

      </div>



      <!-- Recent User -->
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <div class="d-flex justify-content-between w-100">
                <h1 class="card-title" style="font-size: 1.5rem; font-family:serif; font-weight:800px;">Recent Users</h1>
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
                  $i = 1;
                  while ($row = mysqli_fetch_assoc($res)) {
                  ?>
                    <tr>
                      <td><?php echo $i++ ?></td>
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
          </div>
        </div>
      </div>

      <!-- Recent Deposit Transition -->
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <div class="d-flex justify-content-between w-100">
                <h3 class="card-title" style="font-size: 1.5rem; font-family:serif; font-weight:800px;">Recent Deposit Transition</h3>
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
                  $sql = "SELECT * FROM paymenthistory WHERE type='deposit' AND status=0 ORDER BY created_at DESC";
                  $res = mysqli_query($con, $sql);
                  $i = 1;

                  while ($row = mysqli_fetch_assoc($res)) {
                    $user = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM users WHERE id='" . $row['userid'] . "'"));
                  ?>

                    <tr>
                      <td><?php echo $i++ ?></td>
                      <td><?php echo $user['mobile']; ?></td>
                      <td><?php echo $row['order_id']; ?></td>
                      <td><?php echo $row['amount']; ?></td>
                      <td><?php echo $row['upi']; ?></td>
                      <td><?php echo $row['remark']; ?></td>
                      <td><?php echo $row['utr']; ?></td>
                      <td><?php echo $row['created_at']; ?></td>
                      <td> <?php
                            if ($row['status'] == 2) {
                              echo "<span style='color: red;'>Failed</span>";
                            } elseif ($row['status'] == 1) {
                              echo "<span style='color: green;'>Success</span>";
                            } else if ($row['status'] == 0) {
                              echo "<span style='color: orange;'>Pending</span>";
                            }
                            ?></td>
                      <?php
                      if ($row['status'] == 0) {
                      ?>
                        <td>
                          <button class="btn btn-success" onclick="approve('<?php echo $row['order_id'] ?>','credit')">Approve</button>
                          <button class="btn btn-danger" onclick="approve('<?php echo $row['order_id'] ?>','debit')">Decline</button>
                        </td>

                      <?php
                      } else {
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
        </div>
      </div>


      <!-- Recent Withdraw Transition -->
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <div class="d-flex justify-content-between w-100">
                <h3 class="card-title" style="font-size: 1.5rem; font-family:serif; font-weight:800px;">Recent Withdraw Transition</h3>
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
                    <th>Transition ID</th>
                    <th>Amount</th>
                    <th>Type</th>
                    <th>Payment Way</th>
                    <th>Remark</th>
                    <th>Created At</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $sql = "SELECT * FROM withdrawrecord WHERE status=0 ORDER BY created_at DESC";
                  $res = mysqli_query($con, $sql);
                  $i = 1;
                  while ($row = mysqli_fetch_assoc($res)) {
                    $user = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM users WHERE id='" . $row['userid'] . "'"));
                  ?>

                    <tr>
                      <td><?php echo $i++; ?></td>
                      <td><?php echo $user['mobile']; ?></td>
                      <td><?php echo $row['txnid']; ?></td>
                      <td><?php echo $row['amount']; ?></td>
                      <td><?php echo $row['type']; ?></td>
                      <td>
                        
                        <?php 
                        $arr = json_decode($row['payment_info'], true);
                        if($row['type']=='bank' && $arr['is_bank'] == true){
                          echo "Bank Acc. :- ".$arr['bank']['ac'].'<br/>'."IFSC Code :- ".$arr['bank']['ifsc'];
                        } else if($row['type']=='upi' && $arr['is_upi'] == true){
                          echo "UPI :- ".$arr['upi'];
                        } else{
                          echo "N/A";
                        }
                        ?>
                      </td>
                      <td><?php echo $row['remark']; ?></td>
                      <td><?php echo $row['created_at']; ?></td>
                      <td> <?php
                            if ($row['status'] == 2) {
                              echo "<span style='color: red;'>Failed</span>";
                            } elseif ($row['status'] == 1) {
                              echo "<span style='color: green;'>Success</span>";
                            } else if ($row['status'] == 0) {
                              echo "<span style='color: orange;'>Pending</span>";
                            }
                            ?></td>
                      <td>
                        <button class="btn btn-success" onclick="withdraw_approve('<?php echo $row['txnid'] ?>','confirm')">Approve</button>
                        <button class="btn btn-warning" onclick="withdraw_approve('<?php echo $row['txnid'] ?>','decline')">Refund</button>
                      </td>
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
  </section>
</div>

<!-- swal fire cdn  -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<!-- jquery  -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script>
  function approve(order_id, r_type) {
    //approve request using ajax and swal fire
    $.ajax({
      url: 'approveRecharge.php',
      type: 'POST',
      data: {
        order_id: order_id,
        r_type: r_type

      },
      success: function(data) {
        response = JSON.parse(data);

        if (response.type == 'credit') {
          if (response.status == 'success') {
            Swal.fire({
              icon: 'success',
              title: 'Success',
              text: 'Transaction Approved Successfully',
            }).then((result) => {
              location.reload();
            });
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Error',
              text: response.message,
            });
          }
        } else {
          if (response.status == 'success') {
            Swal.fire({
              icon: 'success',
              title: 'Success',
              text: 'Transaction Declined Successfully',
            }).then((result) => {
              location.reload();
            });
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Error',
              text: response.message,
            });
          }
        }


      }
    });

  }


  function withdraw_approve(txnid, r_type) {
    //approve request using ajax and swal fire
    $.ajax({
      url: 'approveWithdraw.php',
      type: 'POST',
      data: {
        txnid: txnid,
        r_type: r_type

      },
      success: function(data) {
        response = JSON.parse(data);

        if (response.type == 'confirm') {
          if (response.status == 'success') {
            Swal.fire({
              icon: 'success',
              title: 'Success',
              text: 'Transaction Approved Successfully',
            }).then((result) => {
              location.reload();
            });
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Error',
              text: response.message,
            });
          }
        } else {
          if (response.status == 'success') {
            Swal.fire({
              icon: 'success',
              title: 'Success',
              text: 'Transaction Declined Successfully',
            }).then((result) => {
              location.reload();
            });
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Error',
              text: response.message,
            });
          }
        }


      }
    });

  }
</script>

<?php
include("footer.php");
?>