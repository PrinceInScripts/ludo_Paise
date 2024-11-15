<?php
if(!isset($_SESSION['role_id'])){
  header("Location: login");
}else{
  $role_id=$_SESSION['role_id'];
}
date_default_timezone_set('Asia/Kolkata');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- <link rel="icon" href="../assets/images/logo/favicon.png" type="image/x-icon"> -->
  <title>Ludopaisa </title>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

  <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <!-- summernote -->
  <link rel="stylesheet" href="../../plugins/summernote/summernote-bs4.min.css">
  <!-- CodeMirror -->
  <link rel="stylesheet" href="../../plugins/codemirror/codemirror.css">
  <link rel="stylesheet" href="../../plugins/codemirror/theme/monokai.css">
  <!-- SimpleMDE -->
  <link rel="stylesheet" href="../../plugins/simplemde/simplemde.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">


</head>

<body class="hold-Transaction sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Preloader -->
    <!-- <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
    </div> -->

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <!-- <li class="nav-item d-none d-sm-inline-block">
          <a href="index3.html" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="#" class="nav-link">Contact</a>
        </li> -->
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
      

        
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
          <?php
          $query = "SELECT * FROM admin_notifications WHERE status = 0";
          $result = mysqli_query($con, $query);
          ?>
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>
            <span class="badge badge-warning navbar-badge"><?php
                                                            echo mysqli_num_rows($result);
                                                            ?></span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-item dropdown-header"><?= mysqli_num_rows($result) ?> Notifications</span>

            <?php
            while ($row = mysqli_fetch_assoc($result)) {
            ?>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item">
                <i class="fas fa-envelope mr-2"></i> <?=$row['title'] ?>
                <span class="float-right text-muted text-sm">
                  <?php
                  // Convert created_at timestamp to a Unix timestamp
                  $time = strtotime($row['created_at']);
                  $timeDiff = time() - $time;

                  // Determine the time difference in different units
                  if ($timeDiff < 60) {
                    echo $timeDiff . " seconds ago"; // Less than a minute
                  } elseif ($timeDiff < 3600) {
                    echo round($timeDiff / 60) . " minutes ago"; // Less than an hour
                  } elseif ($timeDiff < 86400) {
                    echo round($timeDiff / 3600) . " hours ago"; // Less than a day
                  } else {
                    echo round($timeDiff / 86400) . " days ago"; // More than a day
                  }
                  ?>

                </span>
              </a>
            <?php
            }

            ?>

            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>
       
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="index3.html" class="brand-link">
        <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">LUDO PAISA</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block">ADMIN PANEL</a>
          </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
          <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-sidebar">
                <i class="fas fa-search fa-fw"></i>
              </button>
            </div>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item menu-open">
              <a href="./index.php" class="nav-link active">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard

                </p>
              </a>
            </li>
            <li class="nav-item menu-open">
              <a href="adminEarning.php" class="nav-link">
                <i class="nav-icon fas fa-dollar-sign"></i>
                <p>
                  Admin Earnings

                </p>
              </a>
            </li>
            <?php
            if ($role_id != 3) {
            ?>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-user-shield"></i>
                  <p>
                    Admin Manager
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="allAdmin.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>All Admin</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="addAdmin.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Add New Admin</p>
                    </a>
                  </li>
                </ul>
              </li>
            <?php

            }
            ?>


            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>
                  User Manager
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="allUsers.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>All User</p>
                  </a>
                </li>
                <?php
                if ($role_id != 3) {
                ?>
                  <li class="nav-item">
                    <a href="addUser.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Add User</p>
                    </a>
                  </li>
                <?php
                }
                ?>
                <li class="nav-item">
                  <a href="kyc_status.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>KYC Status</p>
                  </a>
                </li>

              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-trophy"></i>
                <p>
                  Challenge Manager
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="allChallenge.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>View All Challenge</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="completeChallenge.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Completed Challenge</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="conflictChallenge.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Conflict Challenge</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="cancelledChallenge.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Cancelled Challenge</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="runningChallenge.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Running Challenge</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-exchange-alt"></i>
                <p>
                  Transaction Manager
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <!-- <li class="nav-item">
                <a href="battle_Transaction.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Battle Transaction</p>
                </a>
              </li> -->
                <li class="nav-item">
                  <a href="deposit.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Deposit Transaction</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="withdraw.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Withdraw Transaction</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="bonus.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Bonus</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="penalty.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Penalty</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="history.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>History</p>
                  </a>
                </li>
              </ul>
            </li>
            <?php
            if ($role_id != 3) {
            ?>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-cog"></i>
                  <p>
                    Setting
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="gateway.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Recharge Gateway</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="gatewayWithdraw.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Withdraw Gateway</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="limits.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Adjust limit</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="adjust_fees.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Adjust Fees</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="add_message.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Adjust Message</p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="add_gamerule.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Add Game Rule</p>
                    </a>
                  </li>

                </ul>
              </li>
            <?php
            }
            ?>

            <li class="nav-item">
              <a href="../user-app/home" class="nav-link">
                <i class="nav-icon fas fa-globe"></i>

                <p>
                  Go to Website
                </p>
              </a>
            </li>


          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>