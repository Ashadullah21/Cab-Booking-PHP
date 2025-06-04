<?php
//ini_set('display_errors', 1);
//error_reporting(E_ALL);
//session_start();
require_once('config.php');

// Debugging: Check if OTP is stored correctly
error_log("SESSION OTP: " . ($_SESSION['otp'] ?? 'Not Set'));
error_log("POST OTP: " . ($_POST['otp'] ?? 'Not Set'));

if (!isset($_POST['otp']) || !isset($_SESSION['otp']) || $_POST['otp'] != $_SESSION['otp']) {
    echo json_encode(["status" => "failed", "msg" => "Invalid OTP! Please try again."]);
    exit;
}

// If OTP is correct, proceed with registration...

if(isset($_POST['otp']) && isset($_SESSION['otp']) && isset($_SESSION['email'])) {
    if($_POST['otp'] == $_SESSION['otp']) {
        // Sanitize inputs
        $firstname = $conn->real_escape_string($_POST['firstname']);
        $middlename = isset($_POST['middlename']) ? $conn->real_escape_string($_POST['middlename']) : "";
        $lastname = $conn->real_escape_string($_POST['lastname']);
        $gender = $conn->real_escape_string($_POST['gender']);
        $contact = $conn->real_escape_string($_POST['contact']);
        $address = $conn->real_escape_string($_POST['address']);
        $email = $_SESSION['email'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Secure password

        // Check if the email already exists
        $check_query = "SELECT * FROM client_list WHERE email = '$email'";
        $result = $conn->query($check_query);
        if($result->num_rows > 0) {
            echo "Email already registered. Please login.";
            exit;
        }

        // Insert into database
        $query = "INSERT INTO client_list (firstname, middlename, lastname, gender, contact, address, email, password, email_verified) 
                  VALUES ('$firstname', '$middlename', '$lastname', '$gender', '$contact', '$address', '$email', '$password', 1)";
        
        if($conn->query($query)) {
            unset($_SESSION['otp']); // Remove OTP session after successful verification
            echo "Registration successful! You can now <a href='login.php'>Login</a>";
			//---------------- unset session otp --------------//
			unset($_SESSION['otp']);
			unset($_SESSION['email'])
        } else {
            echo "Database Error: " . $conn->error;
        }
    } else {
        echo "Invalid OTP! Try again.";
    }
} else {
    echo "OTP session expired or invalid.";
}
?>