<?php 

$userid = $_SESSION['id'];


$query = "SELECT * FROM users WHERE id = '$userid'";
$run = mysqli_query($con,$query);
$data = mysqli_fetch_assoc($run);

$name = $data['username'];
$email = $data['email'];
$wallet = $data['deposit_wallet']+$data['withdraw_wallet'];

$img_src_sql = "SELECT * FROM profile_pic WHERE id = '$data[profile_pic]'";
$img_src_run = mysqli_query($con, $img_src_sql);

$img_src_data = mysqli_fetch_assoc($img_src_run);

?>

<div class="offcanvas sidebar-offcanvas offcanvas-start" tabindex="-1" id="offcanvasLeft">
        <div class="offcanvas-header sidebar-header">
            <div class="sidebar-logo">
                <img class="img-fluid logo" src="../assets/images/logo/logo.png" alt="logo">
                <img class="img-fluid logo-dark" src="../assets/images/logo/logo-dark.png" alt="logo">
            </div>
        </div>
        <div class="offcanvas-body">
            <a href="profile" class="profile-part d-flex align-items-center gap-2">
                <img class="img-fluid profile-pic" src="../assets/images/profile/<?php echo $img_src_data['profile']?>" alt="p8">
                <div>
                    <h3><?php echo $data['username']?>
                    <img src="https://cdn-icons-png.flaticon.com/512/7641/7641727.png" alt="Verified" srcset="" title="Verified" width="20">
                </h3>
                    <span>Edit Account</span>
                </div>
            </a>

            <div onclick="window.location.href='wallet'" class="wallet-part">
            <h6>My Wallet Balance</h6>
            <div class="d-flex align-content-center justify-content-center gap-1">
                <h5>₹ <?=$wallet?> </h5></div>
        </div>
            <ul class="link-section switch-section">
                <li class="active">
                    <a href="home" class="pages">
                        <i class="iconsax sidebar-icon" data-icon="home-2"> </i>
                        <h3>Home</h3>
                    </a>
                </li>
                <li>
                    <a href="history" class="pages">
                        <i class="iconsax sidebar-icon" data-icon="car"> </i>
                        <h3>Account Statement</h3>
                    </a>
                </li>
                <li>
                    <a href="notification" class="pages">
                        <i class="iconsax sidebar-icon" data-icon="bell-2"> </i>
                        <h3>Notification</h3>
                    </a>
                </li>
                <li>
                    <a href="ranking" class="pages">
                        <i class="iconsax sidebar-icon" data-icon="trophy"></i>
                        <h3>Leaderboard</h3>
                    </a>
                </li>
                <li>
                    <a href="refer_earn" class="pages">
                        <i class="iconsax sidebar-icon" data-icon="trophy"></i>
                        <h3>Refer & Earn</h3>
                    </a>
                </li>

                <li>
                    <a href="setting" class="pages">
                    <img style="width:25px" class="unactive" src="https://cdn-icons-png.flaticon.com/512/2040/2040504.png" alt="car">
                        <h3>Setting</h3>
                    </a>
                </li>
                <li>
                    <a href="#0" class="pages">
                        <i class="iconsax sidebar-icon" data-icon="book-closed"> </i>
                        <h3>Terms & Condition</h3>
                    </a>
                </li>

                <li>
                    <a href="game_rules" class="pages">
                        <i class="iconsax sidebar-icon" data-icon="document-text-1"> </i>
                        <h3> Game Rules</h3>
                    </a>
                </li>

                <!-- <li>
                    <div class="pages">
                        <i class="iconsax sidebar-icon" data-icon="brush-3"> </i>
                        <h3>Dark</h3>
                    </div>
                    <div class="switch-btn">
                        <input id="dark-switch" type="checkbox">
                    </div>
                </li> -->

            </ul>

            <div class="bottom-sidebar">
                <a href="login" class="pages">
                    <i class="iconsax sidebar-icon" data-icon="logout-2"> </i>
                    <h3>Logout</h3>
                </a>
            </div>
        </div>
    </div>