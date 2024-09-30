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

    <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <!-- <h3 class="card-title">Responsive Hover Table</h3> -->

                
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table id="example1" class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Mobile</th>
                      <th>username</th>
                      <th>email</th>
                      <th>Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                
                    <?php
                    $sql="SELECT * FROM users WHERE role!='admin'";
                    $res=mysqli_query($con,$sql);
                    while($row=mysqli_fetch_assoc($res)){ ?>
                        <tr>
                          <td><?php echo $row['id']?></td>
                          <td><?php echo $row['mobile']?></td>
                          <td><?php echo $row['username']?></td>
                          <td><span class="tag tag-success"><?php echo $row['email']?></span></td>
                          <td><?php echo $row['created_at']?></td>
                          <td> 
                            <!-- <a href="#" class="text-primary" style="margin-left: 10px;">
                                    Promote to Admin
                                    </a> -->

                                  <a href="manageAdmin.php?id=<?php echo $row['id']?>">  <button type="add-admin" class="btn btn-primary">Promote to Admin</button></a>
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
            <!-- /.card -->
          </div>
        </div>
  
  </div>

<?php
include ("footer.php");
?>