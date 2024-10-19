<?php
include ("db.php");
include ("top.php");


?>

  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Battle Transition</h1>
          </div>
          <div class="col-sm-6">
          </div>
        </div>
      </div>
    </div>

    <div class="card">
             
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>User ID</th>
                    <th>Game ID</th>
                    <th>Amount</th>
                    <th>Profit Amount</th>
                    <th>Deposit Amount</th>
                    <th>Withdraw Amount</th>
                    <th>Status</th>
                    <th>Remarks</th>
                    <th>Created At</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                    $sql="SELECT * FROM game_record order by id desc";
                    $res=mysqli_query($con,$sql);
                    $i=1;
                    while($row=mysqli_fetch_assoc($res)){ ?>
                    <?php
                    $user=mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM users WHERE id='".$row['user_id']."'"));
                    ?>
                        <tr>
                          <td><?php echo $i++?></td>
                          <td><?php echo $user['mobile']?></td>
                          <td><?php echo $row['game_id']?></td>
                          <td><?php echo $row['amount']?></td>
                          <td><?php echo $row['ProfitAmount']?></td>
                          <td><?php echo $row['deposit_balance']?></td>
                          <td><?php echo $row['withdraw_balance']?></td>
                          <td><?php echo $row['status']?></td>
                          <td><?php echo $row['remark']?></td>
                          <td><?php echo $row['created_at']?></td>
                        </tr>
                        <?php
                        }
                    ?>
                  
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>

   

<?php
include ("footer.php");
?>