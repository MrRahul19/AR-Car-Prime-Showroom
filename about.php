<?php
// Start session
session_start();

// Include the database connection
include('Connection.php');

// Check if the username session variable is set
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    $username = "Guest"; // Default to "Guest" if not logged in
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="Cars-IMG/icon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" 
    integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="CSS/Style.css">
    <style>
        body {
            background: url('Cars-IMG/login-back.jpg');
            background-size: cover;
        }
    </style>
    <title>About | AR</title>
</head>
<body>

    <!--header section START-->
    <div class="header">
        <div class="info">
            <img src="Cars-IMG/logo_AR.jpeg" alt="Showroom Logo" class="logo">
            <h4 class="name">AR PRIME SHOWROOM </h4>
        </div>

        <div class="menu__bar">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="services.php">Services </a></li>
                <li><a href="cars.php">Cars </a></li>
                <li><a href="about.php">About Us</a></li>
                <li><a href="contact.php">Contact </a></li>
            </ul>
        </div>

        <div class="connect-db">
            <div class="sign">
                <li><a href="login.php">SIGN IN</a></li>
                <li><a href="register.php">REGISTER</a></li>
            </div>
            <form class="SearchBar" action="#">
                <input type="text" placeholder="Search Cars.." name="searchbar">
                <button type="submit"><i class="fa fa-search"></i></button>
            </form>
            <div class="user">
                <h4><i class="fa fa-user-circle"></i> <?php echo htmlspecialchars($username); ?>!</h4>
                <?php if ($username !== "Guest"): ?>
                    <button><a href="logout.php">Logout</a></button>
                <?php endif; ?>
            </div> 
        </div>
    </div>
<!--header section END-->
   <div style="text-align:center; color: white;" class="main-about">
    <!--main body section-->
    <div class="logo2">
        <img src="Cars-IMG/logo_AR.jpeg" alt="Showroom"/>
        <h2 class="h">Welcome to AR Prime Showroom</h2>
        <p>Your Trusted Destination for Premium Cars</p>
        <p>Introducing the latest addition to my garage.</p>
      </div>

    <div class="container">
        <div class="card">
            <img src="Cars-IMG/interimg-icon.jpg"class="imgofshowroom"  alt="Showroom Interior"/>
            <p>Customer Satisfaction</p>
        </div>
        <div class="card">
            <img src="Cars-IMG/carsale-icon.jpg" class="imgofshowroom"  alt="Customer Focus" />
            <p>Customer Focus</p>
        </div>
        <div class="card">
            <img src="Cars-IMG/trustworthy-icon.png" class="imgofshowroom"  alt="Trustworthy & Transparent" />
            <p>Trustworthy & Transparent</p>
        </div>
        <div class="card">
            <img src="Cars-IMG/expert-service-icon.png" class="imgofshowroom"  alt="Expert Service" />
            <p>Expert Service</p>
        </div>
    </div>    
    </div> 
</body>
</html>