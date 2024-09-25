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

        .rules{
            display:flex;
            justify-content:space-between;
            padding:2% 8%;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .btn-back, .btn-rule {
    padding: 10px 20px;
    font-size: 1em;
    border-radius: 10px;
    text-decoration: none;
    text-align: center;
}

.btn-back {
    background-color: #0079FB;
    color: white;
    font-weight: bold;
}

.btn-rule {
    color: #A26674;
    border: 2px solid #A26674;
    font-weight: bold;
}
        

.challenge-section {
    background-color: white;
    margin: 20px auto;
    text-align: center;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
}

.challenge-heading {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.profile-pic {
    width: 60px;
    height: 60px;
    border-radius: 50%;
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


.room-code-section {
    background-color: #fff;
    padding: 20px;
    text-align: center;
    border-radius: 10px;
    margin: 20px auto;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    max-width: 400px;
}

.room-code-heading {
    font-size: 24px;
    color: #4a4a4a;
    margin-bottom: 10px;
}



.room-code {
    font-size: 24px;
    font-weight: bold;
    color: #333;
    border-radius: 10px;
    display: inline-block;
    margin: 10px 0;

}

.btn-copy {

    background-color: #4B0082;
    color: white;
    padding: 10px 20px;
    border-radius: 10px;
    cursor: pointer;
}

.btn-copy:hover {
    background-color: #5d00b8;
}

.game-result-section {
  

    background-color: #fff;
    border-radius: 10px;
    padding: 20px;
    margin: 20px auto;
    text-align: center;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    max-width: 400px;
}

.game-result-heading {
  
    font-size: 24px;
    font-weight: bold;
    color: #444;
    margin-bottom: 10px;

}

.game-result-description {
    font-size: 1em;
    margin-bottom: 20px;
    color: #666;
}

button {
    display: block;
    width: 100%;
    padding: 10px;
    font-size: 1.2em;
    border: none;
    border-radius: 5px;
    margin-bottom: 10px;
    cursor: pointer;
}

.btn-won {
    background-color: #28a745;
    color: white;
}

.btn-lost {
    background-color: #dc3545;
    color: white;
}

.btn-cancel {
    background-color: #fff;
    color: #333;
    border: 1px solid #ccc;
}

.popup-modal {
    display: none;
    position: fixed;
    z-index: 999;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    justify-content: center;
    align-items: center;
}

.popup-content {
    background-color: white;
    padding: 20px;
    border-radius: 10px;
    text-align: center;
    width: 90%;
    max-width: 400px;
}

.close-popup {
    position: absolute;
    top: 10px;
    right: 20px;
    font-size: 1.5em;
    cursor: pointer;
}

.btn-upload {
    background-color: #007bff;
    color: white;
    padding: 10px;
    border: none;
    border-radius: 5px;
    margin-top: 15px;
    cursor: pointer;
}

#screenshot-upload {
    margin-top: 10px;
    width: 100%;
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


    
    <section class="rules">
    <a href="home" class="btn-back"> Go Back</a>
    <a href="rule" class="btn-rule"> Rules</a>
</section>


    <section class="challenge-section">
    <div class="challenges-container">
        <div class="challenges "> 
            <img id="output" width="40px" class="profile-pic" src="../assets/images/profile/p8.png" alt="p8">
            <p>₹ name</p>
        
        </div>
        <div class="timer-container">
        <img id="output" width="40px" class="profile-pic" src="../assets/images/product/vs.png" alt="p8">
        <p>₹ win Prize</p>
        </div>
      
        <div class="challenges "> 
            <img id="output" width="40px" class="profile-pic" src="../assets/images/profile/p8.png" alt="p8">
            <p>₹ name</p>
        
        </div>
    </div>
</section>
  

<section class="room-code-section">
    <h1 class="room-code-heading">Room Code</h1>
    <p id="room-code" class="room-code">12345678</p> <!-- Example code -->
    <button class="btn-copy" onclick="copyToClipboard()">Copy Code</button>
</section>

<section class="game-result-section">
    <h1 class="game-result-heading">Game Result</h1>
    <p class="game-result-description">After completion of your game, select the status of the game and post your screenshot below</p>
    <button class="btn-won" onclick="openUploadPopup('won')">I WON</button>
    <button class="btn-lost" onclick="openUploadPopup('lost')">I LOST</button>
    <button class="btn-cancel">CANCEL</button>
</section>

<div id="upload-popup" class="popup-modal">
    <div class="popup-content">
        <span class="close-popup" onclick="closePopup()">&times;wejfbe</span>
        <h2 id="popup-title">Upload Screenshot</h2>
        <p>Please upload the screenshot of your game result.</p>
        <input type="file" id="screenshot-upload" accept="image/*">
        <button class="btn-upload " onClick="closePopup()">Upload</button>
    </div>
</div>

  
 
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
    <div class="offcanvas sidebar-offcanvas offcanvas-start" tabindex="-1" id="offcanvasLeft">
        <div class="offcanvas-header sidebar-header">
            <div class="sidebar-logo">
                <img class="img-fluid logo" src="../assets/images/logo/logo.png" alt="logo">
                <img class="img-fluid logo-dark" src="../assets/images/logo/logo-dark.png" alt="logo">
            </div>
        </div>
        <div class="offcanvas-body">
            <a href="profile" class="profile-part d-flex align-items-center gap-2">
                <img class="img-fluid profile-pic" src="../assets/images/profile/p8.png" alt="p8">
                <div>
                    <h3>Ashok Matkaplay</h3>
                    <span>Edit Account</span>
                </div>
            </a>
            
             <a href="#">
                wallet
             </a>
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
                    <a href="setting" class="pages">
                        <i class="iconsax sidebar-icon" data-icon="trophy"></i>
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
                    <a href="rates" class="pages">
                        <i class="iconsax sidebar-icon" data-icon="document-text-1"> </i>
                        <h3> Game Rates</h3>
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

        function copyToClipboard() {
        const roomCode = document.getElementById('room-code').innerText; 
        const tempInput = document.createElement('input'); 
        document.body.appendChild(tempInput);
        tempInput.value = roomCode;
        tempInput.select();
        document.execCommand('copy');
        document.body.removeChild(tempInput);
        alert("Room code copied: " + roomCode); 
    }

    function openUploadPopup(result) {
    var popup = document.getElementById("upload-popup");
    var title = document.getElementById("popup-title");

    // Set title based on the button clicked
    if (result === 'won') {
        title.textContent = "Upload Screenshot for Winning";
    } else if (result === 'lost') {
        title.textContent = "Upload Screenshot for Losing";
    }

    popup.style.display = "flex";  // Display the popup
}

function closePopup() {
    var popup = document.getElementById("upload-popup");
    popup.style.display = "none";  // Hide the popup
}


       
    </script>
</body>


<!-- Mirrored from themes.pixelstrap.com/pwa/taxify/user-app/home by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 01 Sep 2024 04:37:00 GMT -->

</html>