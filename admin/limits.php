<?php
include ("db.php");
include ("top.php");

$minWithdraw="";
$minRecharge="";
$sql = "SELECT * FROM settings WHERE id='1'";
$res = mysqli_query($con, $sql);

if (mysqli_num_rows($res) > 0) {
    $row = mysqli_fetch_assoc($res);
    $minWithdraw = $row['minWithdraw'];
    $minRecharge = $row['minRecharge'];
}

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Adjust Limits</h1>
                </div>
                <div class="col-sm-6"></div>
            </div>
        </div>
    </div>

  
    <div class="card-body">
        
        <!-- First Section: Min Withdraw -->
         
         
        <form action="manage_settings.php" class="auth-form" method="post">

        <div class="form-group row">
            <label class="col-form-label col-sm-4" for="minWithdraw">Min Withdraw</label>
            <div class="col-sm-8 d-flex">
                <input type="text" class="form-control" id="minWithdraw" name="minWithdraw" value="<?php echo $minWithdraw; ?>" style="width: 50%;">
                <button type="submit" name="update_withdraw" class="btn btn-primary ml-2">Update</button>
            </div>
        </div>
        </form>

        <form action="manage_settings.php" class="auth-form" method="post">

        <!-- Second Section: Min Recharge -->
        <div class="form-group row">
            <label class="col-form-label col-sm-4" for="minRecharge">Min Recharge</label>
            <div class="col-sm-8 d-flex">
                <input type="text" class="form-control" id="minRecharge" name="minRecharge" value="<?php echo $minRecharge; ?>" style="width: 50%;">
                <button type="submit" name="update_recharge" class="btn btn-primary ml-2">Update</button>
            </div>
        </div>
        </form>
    </div>


</div>

<?php
include ("footer.php");
?>
