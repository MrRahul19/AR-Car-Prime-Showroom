<?php
    // Start session
    session_start();

    // Check if the username session variable is set
    if (isset($_SESSION['username'])) {
        // Include the database connection
        include('Connection.php');

        // Get user details from the database
        $username = $_SESSION['username'];
        $sql = "SELECT * FROM users WHERE username = '$username'";
        $result = mysqli_query($conn, $sql);
        $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
    } else {
        header("Location: login.php"); // Redirect to login if not logged in
        exit;
    }

    // Initialize the status variable
    $status = '';  // Variable to store the status message

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the form input values
        $fullName = $_POST['fullName'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $carModel = isset($_POST['carModel']) ? $_POST['carModel'] : '';  // Handle case if carModel is not set
        $message = $_POST['message'];

        // Check if carModel is empty, you can add some validation here
        if (empty($carModel)) {
            $status = "Car model is required!";
        } else {
            // Prepare and bind the SQL query
            $stmt = $conn->prepare("INSERT INTO enquiries (fullName, email, phone, carModel, message) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $fullName, $email, $phone, $carModel, $message);

            // Execute the query
            if ($stmt->execute()) {
                $status = "Enquiry submitted successfully!";
            } else {
                $status = "Error submitting the enquiry. Please try again.";
            }

            // Close the statement
            $stmt->close();
        }

        // Close the connection
        $conn->close();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="Cars-IMG/icon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" 
        integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" 
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="CSS/Style.css">
    <link rel="stylesheet" href="CSS/cars.css">
    <script type="text/javascript">
        <?php if (!empty($status)) { ?>
            alert("<?php echo $status; ?>");
        <?php } ?>
    </script>
    <title>Models | AR</title>
</head>
<body>    

<!--header section START (This header css is Styles.css)-->
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

<!-- this is the showing more details of the car code -->
<div id="showbox1">
    <h2>WagonR</h2>    <h3><a href="cars.php">BACK TO CARS </a></h3>
    <div class="car-detsils">

        <div class="img-side">
            <div class="main-img">
                <img src="Cars-IMG/WagonR.png" class="img1-main" alt="WagonR">
            </div>
            <div class="other-img">
                <img src="internal-IMG/wagonR-1.png" alt="Interior-1">
                <img src="internal-IMG/wagonR-2.png" alt="Interior-2">
                <img src="internal-IMG/wagonR-3.png" alt="Interior-3">
            </div>
        </div>

        <div class="info-side">
            <h1>----Features----</h1>
            <div class="features" id="f">
                &#10004; Dual-Tone Exterior <br> &#10004; Advanced Safety Features <br> &#10004; Fuel-Efficient Engine <br> &#10004; SmartPlay Studio Infotainment <br> 
                &#10004; Spacious Interiors <br> &#10004; LED DRLs <br> &#10004; Automatic Gear Shift (AGS) <br> &#10004; 15-inch Alloy Wheels  <br> 
                &#10004; CNG Option Available <br> &#10004; Rear Parking Sensors
            </div>
            <div class="btns">
                <div class="btns">
                    <button><a href="BookingForm1.php">Book</a></button>
                    <button><a href="services.php?section=box5">Test Drive</a></button>
                </div>
            </div>
        </div>

    </div>
</div>

<div id="showbox2">
    <h2>Brezza</h2>    <h3><a href="cars.php">BACK TO CARS </a></h3>
    <div class="car-detsils">

        <div class="img-side">
            <div class="main-img">
                <img src="Cars-IMG/brezza.png" class="img1-main" alt="Brezza">
            </div>
            <div class="other-img">
                <img src="internal-IMG/brezza-1.png" alt="Interior-1">
                <img src="internal-IMG/brezza-2.png" alt="Interior-2">
                <img src="internal-IMG/brezza-3.png" alt="Interior-3">
            </div>
        </div>

        <div class="info-side">
            <h1>----Features----</h1>
            <div class="features">
                &#10004; Dual-Tone Exterior <br> &#10004; 1.5L K-Series Petrol Engine <br> 
                &#10004; Smart Hybrid Technology <br> &#10004; 9-Inch SmartPlay Pro+ Infotainment <br> 
                &#10004; Head-Up Display (HUD) <br> &#10004; 360-Degree Camera <br> 
                &#10004; Wireless Charging <br> &#10004; 6 Airbags  <br> 
                &#10004; Electric Sunroof <br> &#10004; 20.15 kmpl (Petrol), 25.51 km/kg (CNG)
            </div>
            <div class="btns">
                <div class="btns">
                 BookingForm1.php="BookingForm1.php">Book</a></button>
                    <button><a href="#">Test Drive</a></button>
                </div>
            </div>
        </div>

    </div>
</div>

<div id="showbox3">
    <h2>DZire</h2>    <h3><a href="cars.php">BACK TO CARS </a></h3>
    <div class="car-detsils">

        <div class="img-side">
            <div class="main-img">
                <img src="Cars-IMG/Dzire.png" class="img1-main" alt="DZire">
            </div>
            <div class="other-img">
                <img src="internal-IMG/dzire-1.png" alt="Interior-1">
                <img src="internal-IMG/dzire-2.png" alt="Interior-2">
                <img src="internal-IMG/dzire-3.png" alt="Interior-3">
            </div>
        </div>

        <div class="info-side">
            <h1>----Features----</h1>
            <div class="features">
                &#10004; Dual-Tone Exterior <br> &#10004; Advanced K-Series Dual Jet Engine <br> 
                &#10004; Mileage Up to 22.61 km/l <br> &#10004; 7-Inch SmartPlay Studio <br> 
                &#10004; Automatic Climate Control <br> &#10004; Cruise Control <br> 
                &#10004; Dual Airbags <br> &#10004; ABS with EBD  <br> 
                &#10004; Keyless Entry with Push Start <br> &#10004; Ample Boot Space
            </div>
            <div class="btns">
                <div class="btns">
                 BookingForm1.php="BookingForm1.php">Book</a></button>
                    <button><a href="#">Test Drive</a></button>
                </div>
            </div>
        </div>

    </div>
</div>

<div id="showbox4">
    <h2>Alto800</h2>    <h3><a href="cars.php">BACK TO CARS </a></h3>
    <div class="car-detsils">

        <div class="img-side">
            <div class="main-img">
                <img src="Cars-IMG/Alto800.png" class="img1-main" alt="Alto800">
            </div>
            <div class="other-img">
                <img src="internal-IMG/Alto800-1.png" alt="Interior-1">
                <img src="internal-IMG/Alto800-2.png" alt="Interior-2">
                <img src="internal-IMG/Alto800-3.png" alt="Interior-3">
            </div>
        </div>

        <div class="info-side">
            <h1>----Features----</h1>
            <div class="features">
                &#10004; Compact Design with Bold Front Grille <br> &#10004; Fuel Efficiency Up to 22.05 km/l <br> 
                &#10004; BS6 Compliant 796cc Engine <br> &#10004; Dual Airbags <br> 
                &#10004; Smart Reverse Parking Sensors <br> &#10004; ABS with EBD <br> 
                &#10004; Touchscreen Infotainment System <br> &#10004; Keyless Entry <br> 
                &#10004; Comfortable Cabin with Fabric Upholstery <br> &#10004; Low Maintenance Cost
            </div>
            <div class="btns">
                <div class="btns">
                 BookingForm1.php="BookingForm1.php">Book</a></button>
                    <button><a href="#">Test Drive</a></button>
                </div>
            </div>
        </div>

    </div>
</div>

<div id="showbox5">
    <h2>ECCO</h2>    <h3><a href="cars.php">BACK TO CARS </a></h3>
    <div class="car-detsils">

        <div class="img-side">
            <div class="main-img">
                <img src="Cars-IMG/EECO.png" class="img1-main" alt="ECCO">
            </div>
            <div class="other-img">
                <img src="internal-IMG/ecco-1.png" alt="Interior-1">
                <img src="internal-IMG/ecco-2.png" alt="Interior-2">
                <img src="internal-IMG/ecco-3.png" alt="Interior-3">
            </div>
        </div>

        <div class="info-side">
            <h1>----Features----</h1>
            <div class="features">
                &#10004; Powerful 1.2L Advanced K-Series Engine <br> &#10004; CNG Variant Mileage: 27.05 km/kg <br> 
                &#10004; Flat Cargo Bed for Versatile Utility <br> &#10004; Dual Airbags for Enhanced Safety <br> 
                &#10004; Reverse Parking Sensors <br> &#10004; ABS with EBD <br> 
                &#10004; Sliding Doors for Easy Access <br> &#10004; Spacious Interior for Cargo and Passengers <br> 
                &#10004; BS6 Phase II Complian <br> &#10004; Low Maintenance Cost
            </div>
            <div class="btns">
                <div class="btns">
                 BookingForm1.php="BookingForm1.php">Book</a></button>
                    <button><a href="#">Test Drive</a></button>
                </div>
            </div>
        </div>

    </div>
</div>

<div id="showbox6">
    <h2>Ertiga</h2>    <h3><a href="cars.php">BACK TO CARS </a></h3>
    <div class="car-detsils">

        <div class="img-side">
            <div class="main-img">
                <img src="Cars-IMG/Ertiga.png" class="img1-main" alt="Ertiga">
            </div>
            <div class="other-img">
                <img src="internal-IMG/ertiga-1.png" alt="Interior-1">
                <img src="internal-IMG/ertiga-2.png" alt="Interior-2">
                <img src="internal-IMG/ertiga-3.png" alt="Interior-3">
            </div>
        </div>

        <div class="info-side">
            <h1>----Features----</h1>
            <div class="features">
                &#10004; 1.5L Dual VVT Engine with Smart Hybrid Technology <br> &#10004; 20.51 kmpl (Petrol) / 26.11 km/kg (CNG) <br> 
                &#10004; Advanced 7-Inch SmartPlay Pro Touchscreen <br> &#10004; Dual Airbags & ABS with EBD<br> 
                &#10004; 6-Speed Automatic Transmission with Paddle Shifters <br> &#10004; Premium Dual-Tone Interior Design <br> 
                &#10004; 50:50 Split Third Row Seats for Flexible Storage <br> &#10004; Rear AC Vents for Comfort in All Rows <br> 
                &#10004; Cruise Control for Stress-Free Driving <br> &#10004; BS6 Phase II Compliant Engine
            </div>
            <div class="btns">
                <div class="btns">
                 BookingForm1.php="BookingForm1.php">Book</a></button>
                    <button><a href="#">Test Drive</a></button>
                </div>
            </div>
        </div>

    </div>
</div>

<div id="showbox7">
    <h2>ECCO-Cargo</h2>    <h3><a href="cars.php">BACK TO CARS </a></h3>
    <div class="car-detsils">

        <div class="img-side">
            <div class="main-img">
                <img src="Cars-IMG/ECCO-Cargo.png" class="img1-main" alt="ECCO-Cargo">
            </div>
            <div class="other-img">
                <img src="internal-IMG/ecco-cargo-1.png" alt="Interior-1">
                <img src="internal-IMG/ecco-cargo-2.png" alt="Interior-2">
                <img src="internal-IMG/ecco-cargo-3.png" alt="Interior-3">
            </div>
        </div>

        <div class="info-side">
            <h1>----Features----</h1>
            <div class="features">
                &#10004; 1.2L Advanced K-Series Dual Jet Engine <br> &#10004; 27.05 km/kg (CNG Variant) <br> 
                &#10004; Flat Cargo Bed for Maximum Loading Space <br>  &#10004; Covered Cabin for Secure Transportation <br> 
                &#10004; Seat Belt Reminders & Reverse Parking Sensors <br> &#10004; Low Maintenance Costs for Economical Operation <br> 
                &#10004; Robust Build Quality for Durability <br> &#10004; BS6 Phase II Emission Compliance <br> 
                &#10004; Compact Design for Easy Maneuverability <br>  &#10004; Prices Starting at ₹5.42 Lakh
            </div>
            <div class="btns">
                <div class="btns">
                 BookingForm1.php="BookingForm1.php">Book</a></button>
                    <button><a href="#">Test Drive</a></button>
                </div>
            </div>
        </div>

    </div>
</div>

<div id="showbox8">
    <h2>Super_Carry</h2>    <h3><a href="cars.php">BACK TO CARS </a></h3>
    <div class="car-detsils">

        <div class="img-side">
            <div class="main-img">
                <img src="Cars-IMG/Super_Carry.png" class="img1-main" alt="Super_Carry">
            </div>
            <div class="other-img">
                <img src="internal-IMG/super-carry-1.png" alt="Interior-1">
                <img src="internal-IMG/super-carry-2.png" alt="Interior-2">
                <img src="internal-IMG/super-carry-3.png" alt="Interior-3">
            </div>
        </div>

        <div class="info-side">
            <h1>----Features----</h1>
            <div class="features">
                &#10004; 1.2L Petrol and CNG Engine Options <br> &#10004; 22.07 km/l (Petrol Variant) <br> 
                &#10004; Payload Capacity of 750 kg <br> &#10004; Spacious Cargo Deck for Efficient Transport <br> 
                &#10004; Dual-Side Sliding Door for Easy Access <br> &#10004; Advanced Safety Features Including ABS <br> 
                &#10004; Ergonomically Designed Driver Cabin for Comfort <br> &#10004; Smart Fuel Efficiency with CNG Variant <br> 
                &#10004; High Durability with Robust Build Quality <br> &#10004; Prices Starting only ₹5.02 Lakh
            </div>
            <div class="btns">
                <div class="btns">
                 BookingForm1.php="Booking Form-1.php">Book</a></button>
                    <button><a href="#">Test Drive</a></button>
                </div>
            </div>
        </div>

    </div>
</div>

<!--Cars Models Start-->
<div class="content-all" id="allcontent"><br><br><br>

    <!--Cars types list (left-side)Start-->
    <div class="left-container">
        <div class="list">
            <ul>
                <h3 class="type">All</h2>
                <li><a href="#">Hatchbacks</a></li>
                <li><a href="#">Seden</a></li>
                <li><a href="#">SUV</a></li>
                <li><a href="#">MUV</a></li>
                <li><a href="#">VAN</a></li>
                <li><a href="#">Commercial</a></li>
            </ul>
        </div>
        <button class="enquiry-btn" onclick="openForm()">Enquiry</button>

        
                    <div class="form-popup-overlay" id="formOverlay">
                        <div class="form-popup">
                            <form class="enquiry-form" action="cars.php" method="POST">
                                <h2>Car Services Form</h2>
                                
                                <label for="fullName">Full Name:</label>
                                <input type="text" id="fullName" name="fullName" placeholder="Enter your full name" required>
                                
                                <label for="email">Email:</label>
                                <input type="email" id="email" name="email" placeholder="Enter your email" required>
                                
                                <label for="phone">Phone Number:</label>
                                <input type="tel" id="phone" name="phone" placeholder="Enter your phone number" required>
                                
                                <label for="carModel">Car Model:</label>
                                <div class="custom-dropdown" id="carModel">
                                    <select name="carModel" required>
                                        <option value="" disabled selected>Select a car model</option>
                                        <option value="Hatchback">Hatchback</option>
                                        <option value="Sedan">Sedan</option>
                                        <option value="SUV">SUV</option>
                                        <option value="MUV">MUV</option>
                                        <option value="VAN">VAN</option>
                                        <option value="Convertible">Commercial</option>
                                    </select>
                                </div>

                                <label for="message">Additional Message:</label>
                                <textarea id="message" name="message" rows="4" placeholder="Any specific requests or queries"></textarea>
                                
                                <button type="submit">Submit Enquiry</button>
                                <button type="button" class="close-btn" onclick="closeForm()">Close</button>
                            </form>
                        </div>
                    </div>



    </div>

    <!--Cars list (right-side)Start-->
    <div class="right-container">
        <div class="main-container">
            
            <!-- model-1 -->
            <div class="model-container">
                <div class="model-image classleft">
                    <img src="Cars-IMG/WagonR.png" alt="WagonR">
                </div>
                <div class="model-info-container classright">
                    <div class="info-header">
                        <div class="model-name">
                            <a href="#" id="showboxbtn" onclick="showbox1()">WagonR</a>
                        </div>
                    </div>
                    <div class="model-info">
                        <p>The 2024 Maruti Suzuki Wagon R features improved fuel efficiency with options like a 1.0L petrol engine 
                            (25.19 kmpl) and a 1.2L petrol engine (23.56 kmpl). It comes with advanced safety features, 
                            including dual airbags, ABS with EBD, and ESP. The interior boasts a 7-inch SmartPlay Studio 
                            infotainment system and keyless entry. Prices range from ₹5.55 lakh to ₹7.33 lakh.
                        </p>
                        <a href="#" id="showboxbtn" onclick="showbox1()">More Details...</a>
                    </div>
                </div>
            </div>

            <!-- model-2 -->
            <div class="model-container">
                <div class="model-image classright">
                    <img src="Cars-IMG/brezza.png" alt="brezza">
                </div>
                <div class="model-info-container classleft">
                    <div class="info-header">
                        <div class="model-name">
                            <a href="#">Brezza</a>
                        </div>
                    </div>
                    <div class="model-info">
                        <p>The Brezza features a 1.5L Smart Hybrid petrol engine with a mileage of up to 19.89 
                            km/l. It offers advanced safety features like six airbags, hill-hold assist, and a 
                            360-degree camera. The interior includes a 9-inch touchscreen, wireless Apple 
                            CarPlay/Android Auto, and ambient lighting. Its bold design is highlighted by LED 
                            projector headlamps and stylish alloy wheels.</p>
                        <div class="minfo">
                            <a href="#" id="showboxbtn" onclick="showbox2()">More Details...</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- model-3 -->
            <div class="model-container">
                <div class="model-image classleft">
                    <img src="Cars-IMG/Dzire.png" alt="DZire">
                </div>
                <div class="model-info-container classright">
                    <div class="info-header">
                        <div class="model-name">
                            <a href="#">DZire</a>
                        </div>
                    </div>
                    <div class="model-info">
                        <p>The 2024 Maruti Suzuki Dzire features a 1.2L petrol engine with manual and AMT options, 
                            offering a mileage of up to 22.41 km/l. It comes with safety features like six airbags,
                            ABS with EBD, and hill-hold assist. The interior includes a 9-inch touchscreen with 
                            Apple CarPlay/Android Auto and keyless entry. Pricing starts at ₹6.79 lakh</p>
                        <div class="minfo">
                            <a href="#" id="showboxbtn" onclick="showbox3()">More Details...</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- model-4 -->
            <div class="model-container">
                <div class="model-image classright">
                    <img src="Cars-IMG/Alto800.png" alt="Alto800">
                </div>
                <div class="model-info-container classleft">
                    <div class="info-header">
                        <div class="model-name">
                            <a href="#">Alto800</a>
                        </div>
                    </div>
                    <div class="model-info">
                        <p>The 2024 Maruti Suzuki Alto 800 is a budget-friendly compact hatchback with a 796 cc 
                            engine delivering 47 bhp and 22.05 km/l mileage. It features dual airbags, ABS with 
                            EBD and amenities like air conditioning and Bluetooth connectivity. The car offers 
                            a practical and efficient choice for city driving. Prices range from ₹2.94 lakh to 
                            ₹5.13 lakh</p>
                        <div class="minfo">
                            <a href="#"id="showboxbtn" onclick="showbox4()">More Details...</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- model-5 -->
            <div class="model-container">
                <div class="model-image">
                    <img src="Cars-IMG/EECO.png" alt="Eeco">
                </div>
                <div class="model-info-container">
                    <div class="info-header">
                        <div class="model-name">
                            <a href="#">EECO</a>
                        </div>
                    </div>
                    <div class="model-info">
                        <p>The 2024 Maruti Suzuki Eeco is a versatile minivan with a 1.2L petrol engine delivering 
                            80 bhp and a mileage of 19.71 km/l (petrol) and 26.78 km/kg (CNG). It offers dual 
                            airbags, ABS with EBD, and seating options for 5 or 7 passengers. Interior features 
                            include manual AC and a semi-digital speedometer. Prices start at ₹5.32 lakh</p>
                        <div class="minfo">
                            <a href="#" id="showboxbtn" onclick="showbox5()">More Details...</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- model-6 -->
            <div class="model-container">
                <div class="model-image classright">
                    <img src="Cars-IMG/Ertiga.png" alt="Ertiga">
                </div>
                <div class="model-info-container classleft">
                    <div class="info-header">
                        <div class="model-name">
                            <a href="#">Ertiga</a>
                        </div>
                    </div>
                    <div class="model-info">
                        <p>The 2024 Maruti Suzuki Ertiga is a 7-seater MPV powered by a 1.5L petrol engine with 
                            mild-hybrid technology, delivering 103 bhp and 137 Nm torque. It features a 7-inch 
                            touchscreen with wireless Apple CarPlay/Android Auto, automatic climate control, and 
                            dual airbags with ABS. Available in multiple colors, prices range from ₹8.69 
                            lakh to ₹13.03 lakh</p>
                        <div class="minfo">
                            <a href="#" id="showboxbtn" onclick="showbox6()">More Details...</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- model-7 -->
            <div class="model-container">
                <div class="model-image">
                    <img src="Cars-IMG/ECCO-Cargo.png" alt="Eeco Cargo">
                </div>
                <div class="model-info-container">
                    <div class="info-header">
                        <div class="model-name">
                            <a href="#">Eeco Cargo</a>
                        </div>
                    </div>
                    <div class="model-info">
                        <p>The Maruti Suzuki Eeco Cargo is a reliable commercial van with a 1.2L engine, offering 70.67 bhp and 95 Nm torque. 
                            It provides a flat cargo bed and essential safety features like seat belt reminders. The CNG variant delivers 27.05 km/kg mileage, 
                            while the petrol option is ideal for long distances. With low maintenance costs, it’s a great choice for businesses. 
                            Starting price: ₹5.42 lakh.
                        </p>
                        <div class="minfo">
                            <a href="#" id="showboxbtn" onclick="showbox7()">More Details...</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- model-8 -->
            <div class="model-container">
                <div class="model-image classright">
                    <img src="Cars-IMG/Super_Carry.png" alt="Super Carry">
                </div>
                <div class="model-info-container classleft">
                    <div class="info-header">
                        <div class="model-name">
                            <a href="#">Super Carry</a>
                        </div>
                    </div>
                    <div class="model-info">
                        <p>The Maruti Suzuki Super Carry is a compact commercial vehicle with a 1.2L petrol engine, 
                            delivering 80.7 PS power and a payload capacity of up to 740 kg. It features a spacious 
                            cabin, adjustable driver's seat, and a compact turning radius for easy maneuverability. 
                            Safety includes an engine immobilizer and a robust chassis. Prices start at ₹5.16 lakh </p>
                        <div class="minfo">
                            <a href="#" id="showboxbtn" onclick="showbox8()">More Details...</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!--Cars Models END-->

<!-- this javascripy file add for the js function code -->
<script src="open.js"></script>

</body>
</html>
