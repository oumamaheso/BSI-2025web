<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Include Composer's autoloader for PHPMailer
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = htmlspecialchars($_POST['fullname']);
    $fromEmail = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $date = htmlspecialchars($_POST['date']);

    if (!$fromEmail) {
        echo "<p>❌ Invalid email address provided.</p>";
        exit;
    }

    $toEmail = "oumamaheso18@gmail.com";  // Recipient

    $subject = "New Consultation Booking Request";
    $body = "You received a new consultation request:\n\n";
    $body .= "Full Name: $fullname\n";
    $body .= "Email: $fromEmail\n";
    $body .= "Preferred Date: $date\n";

    // Create PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'oumamaheso18@gmail.com';        // Gmail address
        $mail->Password   = 'cqepfcitikocfguu';            // App password
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        // Recipients
        $mail->setFrom('oumamaheso18@gmail.com', 'Consultation');
        $mail->addAddress($toEmail);

        // Content
        $mail->isHTML(false); // Set to false since body is plain text
        $mail->Subject = $subject;
        $mail->Body    = $body;

        $mail->send();
        echo "<p>✅ Thank you! Your consultation has been booked successfully.</p>";
    } catch (Exception $e) {
        echo "<p>❌ Message could not be sent. Mailer Error: {$mail->ErrorInfo}</p>";
    }
} else {
    echo "<p>❌ Invalid request method.</p>";
}