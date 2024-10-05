<?php
include('db.php');
if(!isset($_SESSION['isLogin'])){
    header('location:login');
}

$mobile = $_SESSION['mobile'];
$query = "SELECT * FROM users WHERE mobile = '$mobile'";
$run = mysqli_query($con,$query);
$data = mysqli_fetch_assoc($run);
$wallet = $data['wallet'];


?>
<!DOCTYPE html>
<html lang="en">



<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="taxify">
    <meta name="keywords" content="taxify">
    <meta name="author" content="taxify">
    <link rel="manifest" href="manifest.json">
    <link rel="icon" href="../assets/images/logo/favicon.png" type="image/x-icon">
    <title>Ludo Paisa </title>

    <link rel="apple-touch-icon" href="../assets/images/logo/favicon.png">
    <meta name="title-color" content="#01AA85">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="taxify">
    <meta name="msapplication-TileImage" content="../assets/images/logo/favicon.png">

    <meta name="msapplication-TileColor" content="#FFFFFF">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!--Google font-->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100;200;300;400;500;600;700;800;900&amp;display=swap"
        rel="stylesheet">

    <!-- iconsax css -->
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/iconsax.css">

    <!-- bootstrap css -->
    <link rel="stylesheet" id="rtl-link" type="text/css" href="../assets/css/vendors/bootstrap.css">


    <!-- swiper css -->
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/swiper-bundle.min.css">
    
    

    <!-- Theme css -->
    <link rel="stylesheet" id="change-link" type="text/css" href="../assets/css/style.css">
    <link rel="stylesheet" id="change-link" type="text/css" href="../assets/css/style1.css">
    <style>
        .flag{
            width: 30px;
            height: 30px;
            margin-right: 10px;
        }
    .add-cash-button {
        display: flex;
        align-items: center; 
        justify-content: center;
        padding: 4px 20px; 
        background-color: #551A8B; 
        border: none;
        border-radius: 20px; 
        text-decoration: none;
        display:flex;
        gap:4px;
        
        }
        .add-cash-content{
            display:flex;
            flex-direction:column;
            align-items:center;
            color:#fff;
            font-weight:600;
           
            
        }
        .add-cash-content p{
            font-size:10px;
        }

        .add-cash-circle {
            display: inline-block;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background-color: white;
        }

        .create-battle-section {
  background-color: #f7f7f7;
  /* padding: 50px; */
  text-align: center;
}

.create-battle-container {
  margin: 0 auto;
  background-color: #fff;
  padding: 30px;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.create-battle-title {
  font-size: 24px;
  font-weight: bold;
  margin-bottom: 20px;
}

.create-battle-form {
  display: flex;
  flex-direction: column;
  align-items: center;
}

.create-battle-input {
  width: 100%;
  padding: 15px;
  margin-bottom: 20px;
  border: 1px solid #ddd;
  border-radius: 5px;
}

.create-battle-button {
  width: 100%;
  padding: 15px;
  background-color: #4CAF50;
  color: #fff;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.create-battle-button:hover {
  background-color: #3e8e41;
}

.challenge-section {
    text-align: center;
}

.challenge-heading {
    background-color: #400080; 
    width: 100%;
    color: white;
    padding: 20px;
    text-align: center;
}

.profile-pic {
    width: 60px;
    height: 60px;
    border-radius: 100%;
}

.challenges-container {
    display: flex; 
    justify-content: space-around;
    align-items: center;
    padding: 40px 20px;
    margin: 10px 0;
}

.challenges {
    display: flex; 
    flex-direction: column;
    justify-content: center;
    gap: 5px;
    margin-bottom: 20px;
}

.finding-player {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.timer-container {
    display: flex;
    flex-direction: column;
    font-size: 1em;
    margin-bottom: 20px;
    gap: 10px;
}

.loading-spinner {
    width: 20px;
    height: 20px;
    border: 3px solid rgba(255, 255, 255, 0.3);
    border-top-color: #000;
    border-radius: 50%;
    animation: spin 1s linear infinite;
    margin-right: 10px;
}



.btn-primary {
    padding: 10px 15px;
    background-color: #400080; 
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer; 
    transition: background-color 0.3s; 
}

.delete-button:hover {
    background-color: #320060; 
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
       
    </style>
</head>

<body>
    <!-- header starts -->
    <header id="header" class="main-header">
        <div class="custom-container">
            <div class="header-panel">
                <div class="d-flex align-items-center gap-2">
                    <a href="#offcanvasLeft" data-bs-toggle="offcanvas">
                        <i class="iconsax icon-btn" data-icon="text-align-left"> </i>
                    </a>
                    
                </div>

                <div class="add-cash-button">
                
                <a href="wallet" class="add-cash-content"> 
                   
                    <p>Add cash</p>
                    <p>₹<?php echo $wallet?> </p>  

                  
                    
                </a>
                <div class="add-cash-circle">

                </div>
                
                </div>
            </div>
        </div>
    </header>
    <!-- header end -->
    
    <section class="create-battle-section">
  <div class="create-battle-container">
    <h1 class="create-battle-title">Create A Battle</h1>
    <div class="create-battle-form">
      <input type="number" name="amount" placeholder="Enter your amount" class="create-battle-input">
      <a href="battleview.php" class="create-battle-button">Submit</a>
    </div>
  </div>
</section>


    <section class="challenge-section">
    <h1 class="challenge-heading">Create Challenge</h1>
    <div class="challenges-container">
        <div class="challenges "> <!-- Added challenge-option class -->
            <img id="output" width="40px" class="profile-pic" src="../assets/images/profile/p8.png" alt="p8">
            <p>₹ 130</p>
            <p>Entry Fee</p>
            <div class="loading-circle"></div> <!-- Added loading-circle for loading spinner -->
        </div>
        <div class="timer-container">
            <span id="timer">100</span>
            <button class=" btn-primary">Delete</button>
        </div>
      
        <div class="challenges "> <!-- Added challenge-option class -->
        <div class="finding-player">
        <div class="loading-spinner"></div>
            <p>Finding Player...</p>
        </div>
            
            <p>₹170</p>
            <p>Prize</p>
        </div>
    </div>
</section>
    <section class="challenge-section">
    <h1 class="challenge-heading">Select Challenge</h1>
    <div class="challenges-container">
        <div class="challenges ">
            <img id="output" width="40px" class="profile-pic" src="../assets/images/profile/p8.png" alt="p8">
            <p>₹ 130</p>
            <p>Entry Fee</p>
            <div class="loading-circle"></div>
        </div>
        <div class="timer-container">
            <span id="timer">100</span>
            <button class=" btn-primary">Match</button>
        </div>
      
        <div class="challenges ">
        <div class="finding-player">
        <div class="loading-spinner"></div>
            <p>Finding Player...</p>
        </div>
            
            <p>₹170</p>
            <p>Prize</p>
        </div>
    </div>
</section>

  
 
    <!-- offer section end -->

    <!-- panel-space start -->
    <section class="panel-space"></section>
    <!-- panel-space end -->

   

    <!-- bottom navbar start -->
    <div class="navbar-menu">
        <ul>
            <li class="active">
                <a href="home">
                    <div class="icon">
                        <img class="unactive" src="https://themes.pixelstrap.com/pwa/taxify/assets/images/svg/home.svg" alt="home">
                        <img class="active" src="https://themes.pixelstrap.com/pwa/taxify/assets/images/svg/home-fill.svg" alt="home">
                    </div>
                    <span class="active">Home</span>
                </a>
            </li>

            <li>
                <a href="wallet">
                    <div class="icon">
                        <img style="width:25px" class="unactive" src="https://cdn-icons-png.flaticon.com/512/482/482541.png" alt="category">
                        <img style="width:25px" class="active" src="https://cdn-icons-png.flaticon.com/512/60/60484.png" alt="category">
                    </div>
                    <span>Wallet</span>
                </a>
            </li>

            <li >
                <a href="setting">
                    <div class="icon">
                        <img style="width:25px" class="unactive" src="https://cdn-icons-png.flaticon.com/512/2040/2040504.png" alt="car">
                        <img style="width:25px" class="active" src="https://cdn-icons-png.flaticon.com/512/3524/3524659.png" alt="car">
                    </div>
                    <span>Setting</span>
                </a>
            </li>

            <li>
                <a href="bids">
                    <div class="icon">
                        <img style="width:25px" class="unactive" src="https://cdn-icons-png.flaticon.com/512/783/783196.png" alt="car">
                        <img style="width:25px" class="active" src="https://cdn-icons-png.flaticon.com/512/2639/2639683.png" alt="car">
                    </div>
                    <span>All Bids</span>
                </a>
            </li>
            

            <li>
                <a href="history">
                    <div class="icon">
                        <img style="width:25px" class="unactive" src="https://cdn-icons-png.flaticon.com/512/1157/1157077.png" alt="setting">
                        <img style="width:25px" class="active" src="https://cdn-icons-png.flaticon.com/128/149/149880.png" alt="setting">
                    </div>
                    <span>History</span>
                </a>
            </li>
        </ul>
    </div>
    <!-- bottom navbar end -->

    <!-- sidebar starts -->
    <?php include_once('includes/sidebar.php') ?>
    <!-- sidebar end -->

    <!-- iconsax js -->
    <script src="../assets/js/iconsax.js"></script>

    <!-- bootstrap js -->
    <script src="../assets/js/bootstrap.bundle.min.js"></script>

    <!-- sticky-header js -->
    <script src="../assets/js/sticky-header.js"></script>

    <!-- swiper js -->
    <script src="../assets/js/swiper-bundle.min.js"></script>
    <script src="../assets/js/custom-swiper.js"></script>

    <!-- template-setting js -->
    <script src="../assets/js/template-setting.js"></script>

    <!-- script js -->
    <script src="../assets/js/script.js"></script>

    <script>
        function viewChart() {
            var ele = document.getElementsByName('flexRadioDefault');
            for (i = 0; i < ele.length; i++) {
                if (ele[i].checked)
                    window.location.href = ele[i].id;
            }
        }

       
    </script>
</body>


<!-- Mirrored from themes.pixelstrap.com/pwa/taxify/user-app/home by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 01 Sep 2024 04:37:00 GMT -->

</html>