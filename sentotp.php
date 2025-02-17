<?php
require 'smtp/PHPMailerAutoload.php';

function generateOTP($length = 6)
{
    return str_pad(rand(0, pow(10, $length) - 1), $length, '0', STR_PAD_LEFT);
}

function sendOTP($email, $otp)
{
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tls';
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 587;
    $mail->Username = "panchalaayush72@gmail.com"; 
    $mail->Password = "cydvqkgpmpoetkvx"; 
    $mail->setFrom("$email", "name"); 
    $mail->addAddress($email); 
    $mail->isHTML(true);
    $mail->Subject = "Password Reset OTP";
    $mail->Body = "Your OTP for password reset is: $otp";

    if ($mail->send()) {
        return true; 
    } else {
        return false; 
    }
}

if (isset($_POST['email'])) {
    $email = $_POST['email'];

    $otp = generateOTP();

    session_start();
    $_SESSION['otp'] = $otp;
    $_SESSION['email'] = $email;

    if (sendOTP($email, $otp)) {
        echo "OTP has been sent to your email.";
        header('location:otp_verify.php');
    } else {
        echo "Failed to send OTP. Please try again later.";
    }
}
