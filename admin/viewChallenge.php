<?php
include("db.php");
include("top.php");
$role_id = $_SESSION['role_id'];
$row = '';
if (isset($_GET['id']) && $_GET['id'] != '') {
  $id = mysqli_real_escape_string($con, $_GET['id']);
  $battleid = $id;
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
                  <b>Created By</b> <a class="float-right"><?php
                                                            $fetch = "SELECT * FROM users WHERE id = '$row[created_by]'";
                                                            $run = mysqli_query($con, $fetch);
                                                            $data = mysqli_fetch_assoc($run);
                                                            echo $data['mobile'];
                                                            ?></a>
                </li>
                <li class="list-group-item">
                  <b>Accepted By</b> <a class="float-right"><?php
                                                            $user = "SELECT * FROM users WHERE id = '$row[accepted_by]'";
                                                            $run = mysqli_query($con, $user);
                                                            $data = mysqli_fetch_assoc($run);
                                                            echo $data['mobile'];
                                                            ?></a>
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
                <li class="nav-item"><a class="nav-link" href="#acceptor" data-toggle="tab">Acceptor</a></li>
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
                            <b>Deposit Wallet</b> <a class="float-right"><?php echo $creator['deposit_wallet'] ?></a>
                          </li>
                          <li class="list-group-item">
                            <b>Withdraw Wallet</b> <a class="float-right"><?php echo $creator['withdraw_wallet'] ?></a>
                          </li>
                          <li class="list-group-item">
                            <a href="viewUser.php?id=<?php echo $creator['id'] ?>" class="btn btn-success">View</a>
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
                            <button class="btn btn-secondary" onclick="viewJssC()">View Join Screenshot</button>
                            <button class="btn btn-secondary" onclick="viewssC()">View Screenshot</button>
                          </div>

                        </div>
                      </div>
                  </div>


                  <?php
                      if ($role_id != 3) {
                  ?>
                    <div class="container">
                      <div class="container-fluid">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="card card-primary card-outline">
                              <div class="card-header">
                                <h3 class="card-title">
                                  <i class="fas fa-edit"></i>
                                  Take Action
                                </h3>
                              </div>
                              <div class="card-body pad table-responsive">
                                <table class="table table-bordered text-center">

                                  <?php
                                  if ($row['status'] == 'conflict' || $row['status'] == 'pending') {
                                  ?>
                                    <tr>

                                      <td>
                                        <button type="button" onclick="winA('<?= $creator['mobile'] ?>')" class="btn btn-block btn-success btn-lg">Win</button>
                                      </td>
                                      <td>
                                        <button type="button" onclick="addPenalty('<?= $creator['mobile'] ?>')" class="btn btn-block btn-danger btn-lg">Add Penalty</button>
                                      </td>

                                    </tr>
                                  <?php
                                  } elseif ($row['status'] == 'complete') {
                                  ?>
                                    <tr>

                                      <td>
                                        <button type="button" onclick="comingsoon()" class="btn btn-block btn-warning btn-lg">Revert Battle</button>
                                      </td>

                                    </tr>
                                  <?php
                                  } elseif ($row['status'] == 'pending') {
                                  ?>
                                    <tr>

                                      <td>
                                        <button type="button" onclick="comingsoon()" class="btn btn-block btn-secondary btn-lg">Waiting</button>
                                      </td>

                                    </tr>
                                  <?php
                                  } elseif ($row['status'] == 'cancel') {
                                  ?>
                                    <tr>

                                      <td>
                                        <button type="button" onclick="comingsoon()" class="btn btn-block btn-danger btn-lg">Challenge Cancelled</button>
                                      </td>

                                    </tr>
                                  <?php
                                  }
                                  ?>


                                </table>
                              </div>
                              <!-- /.card -->
                            </div>
                          </div>
                          <!-- /.col -->
                        </div>
                      </div>
                    </div>

                  <?php
                      }
                  ?>

                <?php
                    } else {
                ?>
                </div>
              <?php
                    }
              ?>


              </div>

              <div class="tab-pane" id="acceptor">
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
                          <b>Deposit Wallet</b> <a class="float-right"><?php echo $acceptor['deposit_wallet'] ?></a>
                        </li>
                        <li class="list-group-item">
                          <b>Withdraw Wallet</b> <a class="float-right"><?php echo $acceptor['withdraw_wallet'] ?></a>
                        </li>
                        <li class="list-group-item">
                          <a href="viewUser.php?id=<?php echo $acceptor['id'] ?>" class="btn btn-success">View</a>
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
                          <button class="btn btn-secondary" onclick="viewJssA()">View Join Screenshot</button>
                          <button class="btn btn-secondary" onclick="viewssA()">View Screenshot</button>
                        </div>

                      </div>
                    </div>
                </div>

                <?php
                    if ($role_id != 3) {
                ?>
                  <div class="container">
                    <div class="container-fluid">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="card card-primary card-outline">
                            <div class="card-header">
                              <h3 class="card-title">
                                <i class="fas fa-edit"></i>
                                Take Action
                              </h3>
                            </div>
                            <div class="card-body pad table-responsive">
                              <table class="table table-bordered text-center">
                                <?php
                                if ($row['status'] == 'conflict' || $row['status'] == 'running' || $row['status'] == 'pending') {
                                ?>
                                  <tr>

                                    <td>
                                      <button type="button" onclick="winA('<?= $acceptor['mobile'] ?>')" class="btn btn-block btn-success btn-lg">Win</button>
                                    </td>
                                    <td>
                                      <button type="button" onclick="addPenalty('<?= $acceptor['mobile'] ?>')" class="btn btn-block btn-danger btn-lg">Add Penalty</button>
                                    </td>

                                  </tr>
                                <?php
                                } else if ($row['status'] == 'complete') {
                                ?>
                                  <tr>

                                    <td>
                                      <button type="button" onclick="comingsoon()" class="btn btn-block btn-warning btn-lg">Revert Battle</button>
                                    </td>

                                  </tr>

                                <?php

                                } else if ($row['status'] == 'pending') {
                                ?>
                                  <tr>

                                    <td>
                                      <button type="button" onclick="comingsoon()" class="btn btn-block btn-secondary btn-lg">Waiting</button>
                                    </td>

                                  </tr>
                                <?php
                                } else if ($row['status'] == 'cancel') {
                                ?>
                                  <tr>

                                    <td>
                                      <button type="button" onclick="comingsoon()" class="btn btn-block btn-danger btn-lg">Challenge Cancelled</button>
                                    </td>

                                  </tr>
                                <?php
                                }
                                ?>
                              </table>
                            </div>
                            <!-- /.card -->
                          </div>
                        </div>
                        <!-- /.col -->
                      </div>
                    </div>
                  </div>
                <?php
                    }
                ?>
              <?php
                  } else {
              ?>
                                   

              </div>
            <?php
                  }
            ?>
            <!-- /.tab-content -->
          
            </div><!-- /.card-body -->
            <button type="button" onclick="cancelBattle('<?= $battleid ?>')" class="btn btn-block btn-secondary btn-lg">Cancel Battle</button>
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->




        <!-- /.row -->
      </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>

<!-- swal fire cdn  -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
  function comingsoon() {
    Swal.fire({
      icon: 'info',
      title: 'Coming Soon',
      text: 'This feature is coming soon.',
    })
  }

  // swal.fire with html to show mobile screenshot 
  function viewssC() {
    <?php
    if ($row['creator_ss'] == 'cancel') {
    ?>
      Swal.fire({
        title: 'Creator Screenshot',
        html: '<p class="btn btn-danger">Challenge Cancelled</p>',
        showCloseButton: true,
        showConfirmButton: false,
      })
    <?php
    } else {
    ?>
      Swal.fire({
        title: 'Creator Screenshot',
        html: '<img src="../assets/games/<?php echo $row['id'] ?>/<?php echo $row['creator_ss'] ?>" class="img-fluid" alt="Photo">',
        showCloseButton: true,
        showConfirmButton: false,
      })
    <?php
    }
    ?>


  }

  function viewJssC() {
    <?php
    if ($row['creator_join_ss'] == 'cancel') {
    ?>
      Swal.fire({
        title: 'Creator Screenshot',
        html: '<p class="btn btn-danger">Challenge Cancelled</p>',
        showCloseButton: true,
        showConfirmButton: false,
      })
    <?php
    } else {
    ?>
      Swal.fire({
        title: 'Creator Screenshot',
        html: '<img src="../assets/games/<?php echo $row['id'] ?>/<?php echo $row['creator_join_ss'] ?>" class="img-fluid" alt="Photo">',
        showCloseButton: true,
        showConfirmButton: false,
      })
    <?php
    }
    ?>


  }

  function viewssA() {
    <?php
    if ($row['acceptor_ss'] == 'cancel') {
    ?>
      Swal.fire({
        title: 'Accestor Screenshot',
        html: '<p class="btn btn-danger">Challenge Cancelled</p>',
        showCloseButton: true,
        showConfirmButton: false,
      })
    <?php
    } else {
    ?>
      Swal.fire({
        title: 'Accestor Screenshot',
        html: '<img src="../assets/games/<?php echo $row['id'] ?>/<?php echo $row['acceptor_ss'] ?>" class="img-fluid" alt="Photo">',
        showCloseButton: true,
        showConfirmButton: false,
      })
    <?php
    }
    ?>

  }

  function viewJssA() {
    <?php
    if ($row['acceptor_join_ss'] == 'cancel') {
    ?>
      Swal.fire({
        title: 'Accestor Screenshot',
        html: '<p class="btn btn-danger">Challenge Cancelled</p>',
        showCloseButton: true,
        showConfirmButton: false,
      })
    <?php
    } else {
    ?>
      Swal.fire({
        title: 'Accestor Screenshot',
        html: '<img src="../assets/games/<?php echo $row['id'] ?>/<?php echo $row['acceptor_join_ss'] ?>" class="img-fluid" alt="Photo">',
        showCloseButton: true,
        showConfirmButton: false,
      })
    <?php
    }
    ?>

  }

  function winA(mobile) {
    Swal.fire({
      title: 'Are you sure?',
      text: "Winner will be : " + mobile,
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, Win it!'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: 'winChallenge.php',
          type: 'POST',
          data: {
            mobile: mobile,
            id: '<?= $row['id'] ?>'
          },
          success: function(data) {
            response = JSON.parse(data);

            if (response.status == 'success') {
              Swal.fire(
                'Success!',
                'Challenge won successfully.',
                'success'
              ).then(() => {
                location.reload();
              })
            } else {
              Swal.fire(
                'Error!',
                'Error winning challenge.',
                'error'
              ).then(() => {
                location.reload();
              })
            }

          }
        });
      }
    })
  }

  function cancelBattle(id){
    Swal.fire({
      title: 'Are you sure?',
      text: "You want to cancel this battle",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, Cancel it!'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: 'operations/cancelbattle.php',
          type: 'POST',
          data: {
            id: id
          },
          success: function(data) {
            response = JSON.parse(data);

            if (response.status == 'success') {
              Swal.fire(
                'Success!',
                'Battle cancelled successfully.',
                'success'
              ).then(() => {
                location.reload();
              })
            } else {
              Swal.fire(
                'Error!',
                'Error cancelling battle.',
                'error'
              ).then(() => {
                location.reload();
              })
            }

          }
        });
      }
    })
  }

  function addPenalty(mobile) {

    // ask amount for penalty and ask remark for penalty

    Swal.fire({
      title: 'Add Penalty',
      html: '<input type="number" id="amount" class="swal2-input" placeholder="Amount">' +
        '<input type="text" id="remark" class="swal2-input" placeholder="Remark">',
      showCloseButton: true,
      showCancelButton: true,
      focusConfirm: false,
      confirmButtonText: 'Add Penalty',
      confirmButtonColor: '#d33',
      cancelButtonText: 'Cancel',
      cancelButtonColor: '#3085d6',
      preConfirm: () => {
        const amount = Swal.getPopup().querySelector('#amount').value
        const remark = Swal.getPopup().querySelector('#remark').value
        if (!amount || !remark) {
          Swal.showValidationMessage(`Please enter amount and remark`)
        }
        return {
          amount: amount,
          remark: remark
        }
      }
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: 'addPenalty.php',
          type: 'POST',
          data: {
            mobile: mobile,
            amount: result.value.amount,
            id: '<?= $row['id'] ?>',
            remark: result.value.remark
          },
          success: function(data) {
            Swal.fire(
              'Success!',
              'Penalty added successfully.',
              'success'
            ).then(() => {
              location.reload();
            })
          }
        });
      }
    })

  }
</script>

<!-- fgdj -->


<?php
include("footer.php");
?>