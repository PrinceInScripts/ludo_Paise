<?php
include ("db.php");
include ("top.php");

$deposit_msg="";
$withdraw_msg="";
$sql = "SELECT * FROM settings WHERE id='1'";
$res = mysqli_query($con, $sql);

if (mysqli_num_rows($res) > 0) {
    $row = mysqli_fetch_assoc($res);
    $deposit_msg = $row['deposit_msg'];
    $withdraw_msg = $row['withdraw_msg'];
}

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Adjust Message</h1>
                </div>
                <div class="col-sm-6"></div>
            </div>
        </div>
    </div>

  
    <div class="card-body">
        
        <!-- First Section: Min Withdraw -->
         
         
        <form action="manage_settings.php" class="auth-form" method="post">

        <div class="form-group row">
            <label class="col-form-label col-sm-4" for="deposit_msg">Deposit Message</label>
            <div class="col-sm-8 d-flex">
                <input type="text" class="form-control" id="deposit_msg" name="deposit_msg" value="<?php echo $deposit_msg; ?>" style="width: 50%;">
                <button type="submit" name="update_deposit_msg" class="btn btn-primary ml-2">Update</button>
            </div>
        </div>
        </form>

        <form action="manage_settings.php" class="auth-form" method="post">

        <!-- Second Section: Min Recharge -->
        <div class="form-group row">
            <label class="col-form-label col-sm-4" for="withdraw_msg">Withdraw Message</label>
            <div class="col-sm-8 d-flex">
                <input type="text" class="form-control" id="withdraw_msg" name="withdraw_msg" value="<?php echo $withdraw_msg; ?>" style="width: 50%;">
                <button type="submit" name="update_withdraw_msg" class="btn btn-primary ml-2">Update</button>
            </div>
        </div>
        </form>
    </div>


</div>

<?php
include ("footer.php");
?>
