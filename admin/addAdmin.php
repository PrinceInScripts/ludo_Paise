<?php
include("db.php");
include("top.php");

if(isset($_POST['submit'])){
  $username = $_POST['username'];
  $password = $_POST['password'];
  $role = $_POST['role'];
  $retype_password = $_POST['retype-password'];
  if($password == $retype_password){
    $encrpted_password = md5($password);
    $sql = "INSERT INTO admins (username, password,plain_password, role_id) VALUES ('$username', '$encrpted_password','$password', '$role')";
    if(mysqli_query($con, $sql)){
      echo "<script>
      document.addEventListener('DOMContentLoaded', function() {
          Swal.fire({
              title: 'Success',
              text: 'Admin added successfully',
              icon: 'success',
              confirmButtonText: 'OK'
          }).then(() => {
              window.location.href = 'index.php'; // Redirect to index.php after success
          });
      });
      </script>";
    } else {
      echo "<script>
      document.addEventListener('DOMContentLoaded', function() {
          Swal.fire({
              title: 'Error',
              text: 'Error adding admin',
              icon: 'error',
              confirmButtonText: 'OK'
          });
      });
      </script>";
    }
  } else {
    echo "<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            title: 'Error',
            text: 'Passwords do not match',
            icon: 'error',
            confirmButtonText: 'OK'
        });
    });
    </script>";
  }
}
?>
<div class="hold-transition register-page">
  <div class="register-box">


    <div class="card">
      <div class="card-body register-card-body">
        <p class="login-box-msg">Register a new membership</p>

        <form method="post">

          <div class="input-group mb-3">
            <input type="text" name="username" class="form-control" placeholder="Username">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="form-group">
              <?php
              $sql = "SELECT * FROM roles";
              $result = mysqli_query($con, $sql);
              $count = mysqli_num_rows($result);
              if ($count > 0) {
                echo "<label>Role</label>";
                echo "<select class='custom-select' name='role'>";
                while ($row = mysqli_fetch_assoc($result)) {
                  echo "<option value='" . $row['id'] . "'>" . $row['role_name'] . "</option>";
                }
                echo "</select>";
              }
              ?>
          </div>
          <div class="input-group mb-3">
            <input type="password" name="password" class="form-control" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="input-group  mb-3">
            <input type="password" name="retype-password" class="form-control" placeholder="Retype password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-8">
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" name="submit" class="btn btn-primary btn-block">Register</button>
            </div>
            <!-- /.col -->
          </div>
        </form>



      </div>
      <!-- /.form-box -->
    </div><!-- /.card -->
  </div>
</div>

<?php
include("footer.php");
?>