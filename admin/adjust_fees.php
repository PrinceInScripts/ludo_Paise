<?php
include ("db.php");
include ("top.php");

$sql = "SELECT * FROM settings WHERE id='1'";
$res = mysqli_query($con, $sql);

if (mysqli_num_rows($res) > 0) {
    $row = mysqli_fetch_assoc($res);
    $clasicFees = $row['classic_fee'];
    $popularFees = $row['popular_fee'];
    $game3fee = $row['game3_fee'];
    $game4fee = $row['game4_fee'];
}

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Adjust Fees</h1>
                </div>
                <div class="col-sm-6"></div>
            </div>
        </div>
    </div>

  
    <div class="card-body">
        
        <!-- First Section: Min Withdraw -->
         
         
        <form action="manage_settings.php" class="auth-form" method="post">

        <div class="form-group row">
            <label class="col-form-label col-sm-4" for="clasicFees">Classic Fees</label>
            <div class="col-sm-8 d-flex">
                <input type="text" class="form-control" id="clasicFees" name="clasicFees" value="<?php echo $clasicFees; ?>" style="width: 50%;">
                <button type="submit" name="update_classicFees" class="btn btn-primary ml-2">Update</button>
            </div>
        </div>
        </form>

        <form action="manage_settings.php" class="auth-form" method="post">

        <!-- Second Section: Min Recharge -->
        <div class="form-group row">
            <label class="col-form-label col-sm-4" for="popularFees">Popular Fees</label>
            <div class="col-sm-8 d-flex">
                <input type="text" class="form-control" id="popularFees" name="popularFees" value="<?php echo $popularFees; ?>" style="width: 50%;">
                <button type="submit" name="update_popularFees" class="btn btn-primary ml-2">Update</button>
            </div>
        </div>
        </form>
        <form action="manage_settings.php" class="auth-form" method="post">

        <div class="form-group row">
            <label class="col-form-label col-sm-4" for="game3fee">Game 3 Fees</label>
            <div class="col-sm-8 d-flex">
                <input type="text" class="form-control" id="game3fee" name="game3fee" value="<?php echo $game3fee; ?>" style="width: 50%;">
                <button type="submit" name="update_game3Fees" class="btn btn-primary ml-2">Update</button>
            </div>
        </div>
        </form>

        <form action="manage_settings.php" class="auth-form" method="post">

        <!-- Second Section: Min Recharge -->
        <div class="form-group row">
            <label class="col-form-label col-sm-4" for="game4fee">Game 4 Fees</label>
            <div class="col-sm-8 d-flex">
                <input type="text" class="form-control" id="game4fee" name="game4fee" value="<?php echo $game4fee; ?>" style="width: 50%;">
                <button type="submit" name="update_game4Fees" class="btn btn-primary ml-2">Update</button>
            </div>
        </div>
        </form>
    </div>


</div>

<?php
include ("footer.php");
?>
