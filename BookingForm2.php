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
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['formType']) && $_POST['formType'] === 'box1') {
    try {
        // Collect form data
        $full_name = $_POST['full_name'];
        $contact_number = $_POST['contact_number'];
        $email = $_POST['email'];
        $dob = $_POST['dob'];
        $occupation = $_POST['occupation'];
        $state = $_POST['state'];
        $district = $_POST['district'];
        $city = $_POST['city'];
        $street_address = $_POST['street_address'];
        $id_proof_type = $_POST['id_proof_type'];
        $id_proof_number = $_POST['id_proof_number'];
        $preferred_communication = $_POST['preferred_communication'];
        $preferred_delivery = $_POST['preferred_delivery'];
        $comments = $_POST['comments'];

        // Handle file upload for ID Proof Image
        $id_proof_image = '';
        if (isset($_FILES['id_proof_image']) && $_FILES['id_proof_image']['error'] == 0) {
            $target_dir = "uploads/"; // Ensure this directory exists and has write permissions
            $target_file = $target_dir . basename($_FILES["id_proof_image"]["name"]);
            
            if (move_uploaded_file($_FILES["id_proof_image"]["tmp_name"], $target_file)) {
                $id_proof_image = $target_file; // Store the file path in the database
            } else {
                echo "<script>alert('Failed to upload the file. Check folder permissions.');</script>";
            }
        } else {
            echo "<script>alert('Error with file upload: " . $_FILES['id_proof_image']['error'] . "');</script>";
        }

        // Prepare SQL Query
        $stmt = $conn->prepare("
            INSERT INTO car_bookingform2 (
                full_name, contact_number, email, dob, occupation, state, district, city, street_address, 
                id_proof_type, id_proof_image, id_proof_number, preferred_communication, preferred_delivery, comments
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");

        $stmt->bind_param(
            "sssssssssssssss",
            $full_name, $contact_number, $email, $dob, $occupation, $state, $district,
            $city, $street_address, $id_proof_type, $id_proof_image, $id_proof_number,
            $preferred_communication, $preferred_delivery, $comments
        );

        if ($stmt->execute()) {
            echo "<script>alert('Booking successfully submitted!'); window.location.href='BookingForm3.php';</script>";
        } else {
            throw new Exception("Error: " . $stmt->error);
        }

        $stmt->close();
        $conn->close();
    } catch (Exception $e) {
        echo "<script>alert('Error: " . $e->getMessage() . "'); window.location.href='BookingForm2.php';</script>";
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="Cars-IMG/icon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Car Booking | AR</title>
    <link rel="stylesheet" href="Booking.css">
</head>
<body>
<!--header section START-->
    <div class="header">
        <div class="info">
            <img src="Cars-IMG/logo_AR.jpeg" alt="Showroom Logo" class="logo">
            <h4 class="name">AR PRIME SHOWROOM </h4>
        </div>
        <div class="center">
            <div class="marquee-wrapper">
            <img src="Cars-IMG/icon1.png" alt="car-icon" class="logo left-logo">
            <h2 class="marquee">Car Booking Form</h2>
            <img src="Cars-IMG/icon2.png" alt="car-icon" class="logo right-logo">
            </div>
        </div>
        <div class="connect-db">
            <div class="user">
                <h4><i class="fa fa-user-circle"></i> <?php echo htmlspecialchars($username); ?>!</h4>
                <button><a href="logout.php">Logout</a></button>
            </div> 
        </div>
    </div>
<!--header section END-->

<div class="main">
    <div class="main-form">
    
            <div class="form">
                <h2>Owner Details Form </h2>
                <form action="BookingForm2.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="formType" value="box1">
                    
                    <!-- User Information Section -->
                    <label for="full_name">Full Name:</label>
                    <input type="text" id="full_name" name="full_name" required><br><br>

                    <label for="contact_number">Contact Number:</label>
                    <input type="tel" id="contact_number" name="contact_number" pattern="^[987]\d{9}$" required><br><br>

                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required><br><br>

                    <label for="dob">Date of Birth:</label>
                    <input type="date" id="dob" name="dob" required><br><br>

                    <label for="occupation">Occupation:</label>
                    <input type="text" id="occupation" name="occupation" required><br><br>

                    <label for="state">State:</label>
                    <select id="state" name="state" required>
                        <option value=""> Select State  </option>
                        <option value="maharashtra">Maharashtra</option>
                        <option value="gujarat">Gujarat</option>
                        <option value="karnataka">Karnataka</option>
                        <option value="tamil_nadu">Tamil Nadu</option>
                        <option value="kerala">Kerala</option>
                        <!-- Add more states as needed -->
                    </select><br><br>

                    <label for="district">District:</label>
                    <input type="text" id="district" name="district" required><br><br>

                    <label for="city">City:</label>
                    <input type="text" id="city" name="city" required><br><br>

                    <label for="street_address">Street Address:</label>
                    <input type="text" id="street_address" name="street_address" required><br><br>

                    <label for="id_proof_type">ID Proof Type:</label>
                    <select id="id_proof_type" name="id_proof_type" required>
                        <option value=""> Select ID Proof Type </option>
                        <option value="aadhar">Aadhar</option>
                        <option value="pan">PAN</option>
                        <option value="driving_license">Driving License</option>
                        <option value="passport">Passport</option>
                        <option value="voter_id">Voter ID</option>
                    </select><br><br>

                    <label for="id_proof_image">Upload Photo ID (Front Side):</label>
                    <input type="file" id="id_proof_image" name="id_proof_image" accept="image/*" required><br><br>


                    <label for="id_proof_number">ID Proof Number:</label>
                    <input type="text" id="id_proof_number" name="id_proof_number" required><br><br>

                    <label for="preferred_communication">Preferred Communication Method:</label>
                    <select id="preferred_communication" name="preferred_communication" required>
                        <option value=""> Select Communication Method </option>
                        <option value="email">Email</option>
                        <option value="phone_call">Phone Call</option>
                        <option value="sms">SMS</option>
                        <option value="whatsapp">WhatsApp</option>
                    </select><br><br>

                    <label for="preferred_delivery">Preferred Delivery Location:</label>
                    <select id="preferred_delivery" name="preferred_delivery" required>
                        <option value=""> Select Delivery Location </option>
                        <option value="showroom_pickup">Showroom Pickup</option>
                        <option value="home_delivery">Home Delivery</option>
                    </select><br><br>

                    <label for="comments"> Comments:</label>
                    <textarea id="comments" name="comments"></textarea><br>
                    
                    <div class="button-container">
                    <button type="button" class="cancel-btn" onclick="window.location.href='BookingForm1.php'">Cancel</button>
                        <input type="submit" value="Submit" class="submit-btn">
                    </div>

                </form>
            </div>

        </div>
    </div>
    
<script>
    //this alert msg show before the from filling time 
    window.onload = function() {
        alert('This is the -Owner details form- fill the correct & accurate information with proper documentation');
    };
</script>
    
</body>
</html>