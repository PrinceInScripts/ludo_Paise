<?php
include ("db.php");
include ("top.php");


?>

  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manage Gateway</h1>
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
                    <th>Icon</th>
                    <th>Gateway Name</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                    $sql="SELECT * FROM payment_modes";
                    $res=mysqli_query($con,$sql);
                    while($row=mysqli_fetch_assoc($res)){ ?>
                        <tr>
                          <td><?php echo $row['id']?></td>
                          <td><img src="<?=$row['icon']?>" width="50" alt=""></td>
                          <td><?php echo $row['pay_name']?></td>
                          <td>
                            <?php 
                            if($row['status'] == 1){
                                ?>
                                <button class="btn btn-success" onclick="SwitchGateway(1)">On</button>
                                <?php 
                            }else{
                                ?>
                                <button class="btn btn-danger" onclick="SwitchGateway(0)">Off</button>
                                <?php 
                            }
                            ?>
                          </td>
                          <td></td>
                        </tr>
                        <?php
                        }
                    ?>
                  
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>

   <script>
    function SwitchGateway(){
        
    }
   </script>

<?php
include ("footer.php");
?>