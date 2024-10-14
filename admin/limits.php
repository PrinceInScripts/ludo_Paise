<?php
include("db.php");
include("top.php");

$minWithdraw = "";
$minRecharge = "";
$sql = "SELECT * FROM settings WHERE id='1'";
$res = mysqli_query($con, $sql);

if (mysqli_num_rows($res) > 0) {
    $row = mysqli_fetch_assoc($res);
    $minWithdraw = $row['minWithdraw'];
    $minRecharge = $row['minRecharge'];
}

$recharge_status = "";
$withdraw_status = "";
$sql = "SELECT * FROM settings WHERE id='1'";
$res = mysqli_query($con, $sql);

if (mysqli_num_rows($res) > 0) {
    $row = mysqli_fetch_assoc($res);
    $recharge_status = $row['recharge_status'];
    $withdraw_status = $row['withdraw_status'];
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



    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Adjust Status</h1>
                </div>
                <div class="col-sm-6"></div>
            </div>
        </div>
    </div>

    <div class="card-body">
        <!-- First Section: Recharge Status -->
        <form action="manage_settings.php" method="post" id="rechargeForm">
            <div class="form-group row">
                <label class="col-form-label col-sm-4" for="recharge_status">Recharge Status</label>
                <div class="col-sm-8 d-flex align-items-center">
                    <input type="hidden" name="recharge_status" value="OFF">
                    <input type="checkbox" id="recharge_status" name="recharge_status" value="on"
                        <?php echo ($recharge_status == 'on') ? 'checked' : ''; ?>
                        data-toggle="toggle" onchange="document.getElementById('rechargeForm').submit();">
                </div>
            </div>
        </form>

        <!-- Second Section: Withdraw Status -->
        <form action="manage_settings.php" method="post" id="withdrawForm">
            <div class="form-group row">
                <label class="col-form-label col-sm-4" for="withdraw_status">Withdraw Status</label>
                <div class="col-sm-8 d-flex align-items-center">
                    <input type="hidden" name="withdraw_status" value="OFF">
                    <input type="checkbox" id="withdraw_status" name="withdraw_status" value="on"
                        <?php echo ($withdraw_status == 'on') ? 'checked' : ''; ?>
                        data-toggle="toggle" onchange="document.getElementById('withdrawForm').submit();">
                </div>
            </div>
        </form>

    </div>

    <!-- swal fire cdn  -->

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <?php
    if (isset($_GET['status'])) {
        if ($_GET['status'] == 'true') {
            // swal fire 

    ?>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Status updated successfully',
                }).then(function() {
                    window.location = "limits.php";
                });
            </script>
    <?php
        }
    }
    ?>



    <?php
    include("footer.php");
    ?>