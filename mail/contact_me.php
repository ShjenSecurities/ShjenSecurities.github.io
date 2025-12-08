<?php
/**
 * CONTACT FORM SCRIPT USING PHPMailer
 * This replaces the unreliable mail() function.
 * * IMPORTANT: Change the 4 placeholder values below!
 */

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

// 1. Configure the location of the PHPMailer files
// NOTE: Adjust the path if you placed the PHPMailer folder somewhere else.
require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

// 2. SMTP Configuration (Required for sending email)
// Replace these four placeholder values with your SMTP details
define('SMTP_HOST',    'smtp.protonmail.ch');  // e.g., 'smtp.sendgrid.net' or 'smtp.protonmail.com'
define('SMTP_USERNAME', 'mail@shjensecurities.tech'); // Your full sending email address
define('SMTP_PASSWORD', 'RG62RRU6GNBDN19M'); // IMPORTANT: Use an App Password/SMTP password
define('SMTP_PORT',    587); // e.g., 587 (TLS) or 465 (SSL)
define('CONTACT_EMAIL', 'shjensecurities@protonmail.com'); // Destination email (where messages are sent)
define('SENDER_EMAIL',  'noreply@shjensecurites.tech'); // The "From" address for your emails

// Check for empty fields and basic email validation (Remains the same)
if(empty($_POST['name']) || empty($_POST['email']) || empty($_POST['phone']) || empty($_POST['message']) || !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo "No arguments Provided!";
    return false;
}

// Sanitize input data to prevent XSS attacks (Remains the same)
$name = strip_tags(htmlspecialchars($_POST['name']));
$email_address = strip_tags(htmlspecialchars($_POST['email']));
$phone = strip_tags(htmlspecialchars($_POST['phone']));
$message = strip_tags(htmlspecialchars($_POST['message']));

// Create the email message body
$email_subject = "Website Contact Form: " . $name;
$email_body = "You have received a new message from your website contact form.\n\n"
            . "Here are the details:\n\n"
            . "Name: $name\n\n"
            . "Email: $email_address\n\n"
            . "Phone: $phone\n\n"
            . "Message:\n$message";

// 3. Configure and send the email with PHPMailer
$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->isSMTP(); // Set mailer to use SMTP
    $mail->Host       = SMTP_HOST;
    $mail->SMTPAuth   = true; // Enable SMTP authentication
    $mail->Username   = SMTP_USERNAME;
    $mail->Password   = SMTP_PASSWORD;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption
    $mail->Port       = SMTP_PORT;
    // For port 465, use: $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;

    // Recipients
    $mail->setFrom(SENDER_EMAIL, 'Website Contact'); // The email the message appears to be from
    $mail->addAddress(CONTACT_EMAIL); // The email address receiving the message
    $mail->addReplyTo($email_address, $name); // Set the reply-to address to the sender's email

    // Content
    $mail->isHTML(false); // Set email format to plain text
    $mail->Subject = $email_subject;
    $mail->Body    = $email_body;

    $mail->send();
    
    // Success response for AJAX
    echo "OK";
    return true;

} catch (Exception $e) {
    // Failure response for AJAX
    http_response_code(500);
    // You can log the error for debugging, but don't show it to the user:
    // echo "Mail send failed. Mailer Error: {$mail->ErrorInfo}";
    echo "Mail send failed.";
    return false;
}

?>
