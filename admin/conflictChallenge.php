<?php
include ("db.php");
include ("top.php");


?>

  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">All Challenge</h1>
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
                    <th>Game ID</th>
                    <th>Game Type</th>
                    <th>Room Code</th>
                    <th>Amount</th>
                    <th>Win Amount</th>
                    <th>Created By</th>
                    <th>Accepted By</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                    $sql="SELECT * FROM games WHERE status='conflict'";
                    $res=mysqli_query($con,$sql);
                    while($row=mysqli_fetch_assoc($res)){ ?>
                        <tr>
                          <td><?php echo $row['id']?></td>
                          <td><?php echo $row['game_id']?></td>
                          <td><?php echo $row['game_type']?></td>
                          <td><?php echo $row['roomcode']?></td>
                          <td><?php echo $row['amount']?></td>
                          <td><?php echo $row['winAmount']?></td>
                          <td><?php echo $row['created_by']?></td>
                          <td><?php echo $row['accepted_by']?></td>
                          <td><?php echo $row['status']?></td>
                          <td>
                            <a href="viewChallenge?id=<?php echo $row['id']?>"> <button class="btn btn-danger">View</button></a>
                         </td>
                        </tr>
                        <?php
                        }
                    ?>
                  
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>

   

<?php
include ("footer.php");
?>