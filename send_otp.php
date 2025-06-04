<?php
//ini_set('display_errors', 1);
//error_reporting(E_ALL);
session_start();

//new
$_SESSION['otp'] = $otp; // Ensure this is set
$_SESSION['email'] = $email; // Also store email for verification

//require_once '../config.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';
require 'src/Exception.php';
require 'config.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
//new code for wrong otp also logged in. 


if(isset($_POST['email'])) {
    $otp = rand(100000, 999999);
    $_SESSION['otp'] = $otp;
    $_SESSION['email'] = $_POST['email'];

    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Gmail SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'kupido22cs@gmail.com'; // Replace with your Gmail
        $mail->Password = 'izhq uwak kzcm qzyr'; // Use App Password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('kupido22cs@gmail.com', 'Cab Booking Project');
        $mail->addAddress($_POST['email']);
        $mail->isHTML(true);
        $mail->Subject = 'Your OTP for Registration';
        $mail->Body = "<h3>Your OTP Code is: <b>$otp</b></h3>";

        if ($mail->send()) {
            echo json_encode(['status' => 'success', 'msg' => 'OTP sent successfully']);
        }
    } catch (Exception $e) {
        echo json_encode(['status' => 'failed', 'msg' => 'Mailer Error: ' . $mail->ErrorInfo]);
    }
}
if (!isset($_POST['otp']) || $_POST['otp'] != $_SESSION['otp']) {
    echo json_encode(["status" => "failed", "msg" => "Invalid OTP! Please try again."]);
    exit;
}
?>
