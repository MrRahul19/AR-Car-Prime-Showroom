<?php
// Include the connection file
include('connection.php');

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
    <style>
        body {
            background: url('Cars-IMG/login-back.jpg');
            background-size: cover;
        }
        .main-home{
            color: white;
        }
        /* Box Styling */
        .box {
            padding: 10px;
            padding-bottom: 30px;
            margin-top: 20px;
        }
        /* Main Container */
        .Regular_Services {
            display: flex;
            justify-content: space-between;
            gap: 30px;
        }

        /* Left Side */
        .left-side {
            padding: 20px;
            margin: 84px;
            border-radius: 12px;
            color: white;
        }
        .left-side img {
            max-width: 100%;
            height: 75%;
            margin-bottom: 15px;
            border-radius: 8px;
            display: block;
            margin: 0 auto;
        }

        /* Right Side */

        .right-side label {
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
            display: block;
            font-size: 18px;
        }


        /* Dropdown Styling */
        .right-side select {
            cursor: pointer;
            width: 99%;
        }
        /* Checkbox Styling */
        .right-side input[type="checkbox"] {
            margin-right: 10px;
            cursor: pointer;
            margin-left: 30px;
            margin-top: 6px;
        }
        /* Textarea Styling */
        .right-side textarea {
            resize: vertical;
            min-height: 60px;
        }











        /* Transparent Form Container */
        .right-side {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            border-radius: 10px;
            padding: 20px;
            width: 400px;
            height: 550px;
            margin-right: 12%;
        }
        .right-side h2 {
            text-align: center;
            /* color: #333; */
            font-size: 24px;
            margin-bottom: 10px;
            margin-top: -7px;
        }
        /* Focus Effects */
        .right-side input:focus,
        .right-side select:focus,
        .right-side textarea:focus {
            outline: none;
            border: 1px solid #4CAF50; /* Highlight on focus */
            background: rgba(255, 255, 255, 0.1); /* Slight opacity on focus */
        }

        /* Transparent Button Styling */
        .right-side button {
            margin-top: 15px;
            width: 100%;
            padding: 10px;
            background-color: rgba(76, 175, 80, 0.8); /* Slightly transparent button */
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            background-color: #4CAF50;
            color: white;
            padding: 14px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            width: 100%;
            font-size: 18px;
            transition: background-color 0.3s ease-in-out;
        }

        .right-side button:hover {
            background-color: rgba(76, 175, 80, 1); /* Full opacity on hover */
            background-color: #24de2c;
        }
        /* Transparent Input Fields - Specific Targeting */
        .right-side input[type="text"],
        .right-side input[type="email"],
        .right-side input[type="tel"]{
            width: 95%;
            margin-bottom: 15px;
            font-size: 16px;
            transition: all 0.1s ease-in-out;
            background: transparent;
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 5px;
            margin-top: 3px;
            color: white;
            padding: 8px;
        }
        /* Focus and Hover Effects */
        .right-side input[type="text"]:hover, 
        .right-side input[type="email"]:hover,
        .right-side input[type="tel"]:hover,
        .right-side select:hover,
        .right-side textarea:hover,
        .right-side input[type="text"]:focus, 
        .right-side input[type="email"]:focus,
        .right-side input[type="tel"]:focus,
        .right-side select:focus,
        .right-side textarea:focus {
            border: 1px solid #0078D7;
            outline: none;
            border: 1px solid #4CAF50; /* Highlight on focus */
            background: rgba(255, 255, 255, 0.1); /* Slight opacity on focus */
        }

        /* Placeholder Styling */
        .right-side input[type="text"]::placeholder,
        .right-side input[type="email"]::placeholder,
        .right-side input[type="tel"]::placeholder,
        .right-side input::placeholder,
        .right-side textarea::placeholder {
            color: #ccc; /* Light placeholder text */
            opacity: 1; /* Ensure visibility */
        }

        /* Focus Effects */
        .right-side input[type="text"]:focus,
        .right-side input[type="email"]:focus,
        .right-side input[type="tel"]:focus {
            outline: none;
            border: 1px solid #4CAF50; /* Highlight on focus */
            background: rgba(255, 255, 255, 0.1); /* Slight opacity on focus */
        }
        /* Remove transparency specifically for select and textarea */
        .right-side select,
        .right-side textarea {
            background: transparent;
            border: 1px solid #ddd; /* Subtle border */
            border-radius: 5px;
            padding: 8px;
            box-sizing: border-box;
            width: 99%;
            margin-bottom: 15px;
        }

        /* Add hover and focus effects for select and textarea */
        .right-side select:hover,
        .right-side textarea:hover,
        .right-side select:focus,
        .right-side textarea:focus {
            border: 1px solid #4CAF50; /* Highlight border on hover and focus */
            /* Light background on hover and focus */
            outline: none;
        }

        /* Placeholder styling for textarea */
        .right-side textarea::placeholder {
            color: #aaa; /* Subtle placeholder color */
            opacity: 1;
        }
        select {
            background-color: transparent; /* Make the background of the dropdown transparent */
        }

        option {
            background-color: transparent; /* Make the background of each option transparent */
        }

    </style>
    <title>Home | AR</title>
    <script type="text/javascript">
        <?php if (!empty($status)) { ?>
            alert("<?php echo $status; ?>");
        <?php } ?>
    </script>
</head>
<body>

    <!-- Header Section START -->
    <div class="header">
        <div class="info">
            <img src="Cars-IMG/logo_AR.jpeg" alt="Showroom Logo" class="logo">
            <h4 class="name">AR PRIME SHOWROOM</h4>
        </div>

        <div class="menu__bar">
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="services.php">Services</a></li>
                <li><a href="cars.php">Cars</a></li>
                <li><a href="about.php">About Us</a></li>
                <li><a href="contact.php">Contact</a></li>
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
    <!-- Header Section END -->

    <div id="box1" class="box">
        <div class="Regular_Services">
    
            <div class="left-side">
            <div class="Features">
            <h4>Key Features:</h4>
            <ol>
                <li>Online Vehicle Enquiry</li>
                <li>Test Drive Booking</li>
                <li>Car Booking and Purchase</li>
                <li>Loan/Finance Application</li>
                <li>Flexible Scheduling for Pickup and Drop-off</li>
                <li>Service Booking</li>
                <li>Insurance and Warranty Extension</li>
                <li>Accident Repair Request</li>
                <li>User-Friendly Interface</li>
                <li>Secure Login and User Management</li>
                <li>Real-Time Notifications</li>
                <li>Career/Job Application</li>
            </ol>
        </div>
            </div>
    
            <div class="right-side">
                
            <form class="enquiry-form" action="index.php" method="POST">
                <h2>Car Services Form</h2>
                
                <label for="fullName">Full Name:</label>
                <input type="text" id="fullName" name="fullName" placeholder="Enter your full name" required>
                
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required>
                
                <label for="phone">Phone Number:</label>
                <input type="tel" id="phone" name="phone" placeholder="Enter your phone number" required>
                
                <label for="carModel">Car Model:</label>
                <div class="custom-dropdown" id="carModel">
                    <!-- Added name attribute here -->
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
            </form>

            </div>

        </div>
    </div>


</body>
</html>
