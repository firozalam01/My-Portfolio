<?php
// Include PHPMailer files
require __DIR__ . '/PHPMailer/Exception.php';
require __DIR__ . '/PHPMailer/PHPMailer.php';
require __DIR__ . '/PHPMailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name    = $_POST['name'] ?? '';
    $email   = $_POST['email'] ?? '';
    $subject = $_POST['subject'] ?? '';
    $message = $_POST['msg'] ?? '';

    // Create PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        // SMTP settings
        $mail->SMTPDebug = 0; // Change to SMTP::DEBUG_SERVER for debugging
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'portfolioinquiry84@gmail.com';
        $mail->Password   = 'ufok pmba zpwv tzsp'; // App password, not Gmail password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        // Sender & recipient
        $mail->setFrom('portfolioinquiry84@gmail.com', 'Portfolio Contact Form');
        $mail->addAddress('portfolioinquiry84@gmail.com', 'Portfolio Owner');

        // Email content
        $mail->isHTML(true);
        $mail->Subject = "New Contact Form Submission: $subject";
        $mail->Body    = "
            <h3>You have a new contact form message:</h3>
            <p><b>Name:</b> {$name}</p>
            <p><b>Email:</b> {$email}</p>
            <p><b>Subject:</b> {$subject}</p>
            <p><b>Message:</b><br>" . nl2br($message) . "</p>
        ";
        $mail->AltBody = "Name: $name\nEmail: $email\nSubject: $subject\nMessage: $message";

        // Send mail
        $mail->send();
        echo "Message has been sent successfully!";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
