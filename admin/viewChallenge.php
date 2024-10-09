<?php
include("db.php");
include("top.php");
$row = '';
if (isset($_GET['id']) && $_GET['id'] != '') {
  $id = mysqli_real_escape_string($con, $_GET['id']);
  $sql = "SELECT * FROM games WHERE id='$id'";
  $res = mysqli_query($con, $sql);
  if (mysqli_num_rows($res) > 0) {
    $row = mysqli_fetch_assoc($res);
  }
}


?>


<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Challenge</h1>

        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php"><button class="btn btn-danger">Back</button></a></li>
          </ol>
        </div>

      </div>
    </div>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="card card-primary card-outline">
            <div class="card-body box-profile">
              <div class="text-center">
                <img class="profile-user-img img-fluid img-circle"
                  src="../assets/images/games/firstLudo.png"
                  alt="User profile picture">
              </div>

              <h3 class="profile-username text-center"><?php echo $row['game_type'] ?></h3>

              <!-- <p class="text-muted text-center">Software Engineer</p> -->

              <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                  <b>Winner</b> <a class="float-right"><?php echo $row['winner'] ?></a>
                </li>
                <li class="list-group-item">
                  <b>ID</b> <a class="float-right"><?php echo $row['id'] ?></a>
                </li>
                <li class="list-group-item">
                  <b>Game ID</b> <a class="float-right"><?php echo $row['game_id'] ?></a>
                </li>
                <li class="list-group-item">
                  <b>Room Code</b> <a class="float-right"><?php echo $row['roomcode'] ?></a>
                </li>
                <li class="list-group-item">
                  <b>Amount</b> <a class="float-right"><?php echo $row['amount'] ?></a>
                </li>
                <li class="list-group-item">
                  <b>Win Amount</b> <a class="float-right"><?php echo $row['winAmount'] ?></a>
                </li>
                <li class="list-group-item">
                  <b>Created By</b> <a class="float-right"><?php echo $row['created_by'] ?></a>
                </li>
                <li class="list-group-item">
                  <b>Accepted By</b> <a class="float-right"><?php echo $row['accepted_by'] ?></a>
                </li>
                <li class="list-group-item">
                  <b>Created At</b> <a class="float-right"><?php echo $row['created_at'] ?></a>
                </li>
                <li class="list-group-item">
                  <b>Status</b> <a class="float-right"><?php echo $row['status'] ?></a>
                </li>
              </ul>

            </div>
          </div>
        </div>

        <!-- /.col -->
        <div class="col-md-9">
          <div class="card">
            <div class="card-header p-2">
              <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Creator</a></li>
              </ul>
            </div><!-- /.card-header -->
            <div class="card-body">
              <div class="tab-content">
                <div class="active tab-pane" id="activity">
                  <?php
                  $id = $row['created_by'];
                  $sql = "SELECT * FROM users WHERE id='$id'";
                  $res = mysqli_query($con, $sql);
                  $creator = mysqli_fetch_assoc($res);


                  // Fetch profile picture data based on the 'profile_pic' column
                  $img_src = $creator['profile_pic'];
                  $img_src_sql = "SELECT * FROM profile_pic WHERE id = '$img_src'";
                  $img_src_run = mysqli_query($con, $img_src_sql);

                  $img_src_data = mysqli_fetch_assoc($img_src_run);
                  ?>
                  <div class="post">
                    <div class="user-block">
                      <img class="img-circle img-bordered-sm" src="../assets/images/profile/<?php echo $img_src_data['profile'] ?>" alt="user image">
                      <span class="username">
                        <a href="#"><?php echo $creator['username'] ?></a>
                      </span>
                      <span class="description"><?php echo $creator['email'] . '-' . $creator['created_at'] ?>
                        <ul class="list-group list-group-unbordered mb-3">
                          <li class="list-group-item">
                            <b>Mobile No.</b> <a class="float-right"><?php echo $creator['mobile'] ?></a>
                          </li>
                          <li class="list-group-item">
                            <b>ID</b> <a class="float-right"><?php echo $creator['id'] ?></a>
                          </li>
                          <li class="list-group-item">
                            <b>Deposit Wallet ID</b> <a class="float-right"><?php echo $creator['deposit_wallet'] ?></a>
                          </li>
                          <li class="list-group-item">
                            <b>Withdraw Wallet</b> <a class="float-right"><?php echo $creator['withdraw_wallet'] ?></a>
                          </li>
                          <li class="list-group-item">
                            <a href="viewUser.php?id=<?php echo $creator['id']?>" class="btn btn-success">View</a>
                            </li>

                        </ul>

                    </div>


                    <?php
                    if ($row['creator_ss'] != '') {

                    ?>
                      <!-- Post -->
                      <div class="post">
                        <h3>Creator Screenshot</h3>
                        <div class="row mb-3">
                          <div class="col-sm-6">
                            <img class="img-fluid" src="../assets/games/<?php echo $row['id'] ?>/<?php echo $row['acceptor_ss'] ?>" alt="Photo">
                          </div>

                        </div>
                      </div>
                  </div>
                <?php
                    } else {
                ?>

                <?php
                    }
                ?>


                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->

          <div class="col">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Acceptor</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                    <?php
                    $id = $row['accepted_by'];
                    $sql = "SELECT * FROM users WHERE id='$id'";
                    $res = mysqli_query($con, $sql);
                    $acceptor = mysqli_fetch_assoc($res);

                    // Fetch profile picture data based on the 'profile_pic' column
                    $img_src = $acceptor['profile_pic'];
                    $img_src_sql = "SELECT * FROM profile_pic WHERE id = '$img_src'";
                    $img_src_run = mysqli_query($con, $img_src_sql);

                    $img_src_data = mysqli_fetch_assoc($img_src_run);


                    ?>
                    <div class="post">
                      <div class="user-block">
                        <img class="img-circle img-bordered-sm" src="../assets/images/profile/<?php echo $img_src_data['profile'] ?>" alt="user image">
                        <span class="username">
                          <a href="#"><?php echo $acceptor['username'] ?></a>
                        </span>
                        <span class="description"><?php echo $acceptor['email'] . '-' . $acceptor['created_at'] ?>
                          <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                              <b>Mobile No.</b> <a class="float-right"><?php echo $acceptor['mobile'] ?></a>
                            </li>
                            <li class="list-group-item">
                              <b>ID</b> <a class="float-right"><?php echo $acceptor['id'] ?></a>
                            </li>
                            <li class="list-group-item">
                              <b>Deposit Wallet ID</b> <a class="float-right"><?php echo $acceptor['deposit_wallet'] ?></a>
                            </li>
                            <li class="list-group-item">
                              <b>Withdraw Wallet</b> <a class="float-right"><?php echo $acceptor['withdraw_wallet'] ?></a>
                            </li>
                            <li class="list-group-item">
                            <a href="viewUser.php?id=<?php echo $acceptor['id']?>" class="btn btn-success">View</a>
                            </li>

                          </ul>

                      </div>


                      <?php
                      if ($row['acceptor_ss'] != '') {

                      ?>
                        <!-- Post -->
                        <div class="post">
                          <h3>Acceptor Screenshot</h3>
                          <div class="row mb-3">
                            <div class="col-sm-6">
                              <img class="img-fluid" src="../assets/games/<?php echo $row['id'] ?>/<?php echo $row['acceptor_ss'] ?>" alt="Photo">
                            </div>

                          </div>
                        </div>
                    </div>
                  <?php
                      } else {
                  ?>

                  <?php
                      }
                  ?>



                  </div>
                  <!-- /.tab-content -->
                </div><!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
          </div>

          <!-- /.row -->
        </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>





<?php
include("footer.php");
?>