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
            <h1 class="m-0">All Admin</h1>
          </div>
          <div class="col-sm-6">
          </div>
        </div>
      </div>
    </div>

    <div class="card">
              <div class="card-header">
                <h3 class="card-title">DataTable with default features</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Mobile No.</th>
                    <th>username</th>
                    <th>Email</th>
                    <th>Adhaar No.</th>
                    <th>Deposit Money</th>
                    <th>Withdraw Money</th>
                    <th>KYC Status</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                    $sql="SELECT * FROM users";
                    $res=mysqli_query($con,$sql);
                    while($row=mysqli_fetch_assoc($res)){ ?>
                        <tr>
                          <td><?php echo $row['id']?></td>
                          <td><?php echo $row['mobile']?></td>
                          <td><?php echo $row['username']?></td>
                          <td><?php echo $row['email']?></td>
                          <td><?php echo $row['adhaar_no']?></td>
                          <td><?php echo $row['deposit_wallet']?></td>
                          <td><?php echo $row['withdraw_wallet']?></td>
                          <td>
                          <?php 
                          if($row['kyc_status']==1){
                             ?>
                             <button class="btn btn-success">Verified</button>
                             <?php
                          }else{
                            ?>
                            <button class="btn btn-danger">Not Verified</button>
                            <?php
                          }
                          ?>
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