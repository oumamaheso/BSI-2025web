<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = htmlspecialchars($_POST['fullname']);
    $toEmail = htmlspecialchars($_POST['email']);
    $date = htmlspecialchars($_POST['date']);

    $fromEmail = "tsakanimaheso@gmail.com";

    $subject = "Test Consultation Request";
    $message = "Full Name: $fullname\nPreferred Date: $date";
    $headers = "From: $fromEmail\r\n";
    $headers .= "Reply-To: $fromEmail\r\n";

    if (mail($toEmail, $subject, $message, $headers)) {
        echo "<h3>Email successfully sent to $toEmail</h3>";
    } else {
        echo "<p>Email failed. Make sure PHP mail is enabled.</p>";
    }
}
?>



