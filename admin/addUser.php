<?php
include("db.php");
include("top.php");



if (isset($_POST['submit'])) {
    $mobile = trim($_POST['mobile']);

    if (empty($mobile)) {
        $error = "Mobile number is required.";
    } else {
       
        $mobile = mysqli_real_escape_string($con, $mobile);
        $sql = "INSERT INTO users (mobile) VALUES ('$mobile')";
        $res=mysqli_query($con,$sql);

       
        header("location:allUsers.php");
         

         
    }
}
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Add User</h1>
                </div>
            </div>
        </div>

        <form id="quickForm" method="POST">
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputMobile">Enter User Mobile Number</label>
                    <input type="text" name="mobile" class="form-control" id="exampleInputMobile" placeholder="Enter Mobile Number">
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>

<?php
include("footer.php");
?>
