<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';
require 'PHPMailer-master/src/Exception.php';
include 'connection.php';

$message = ""; // For status messages

if (isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    // Check if email exists
    $checkEmail = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $checkEmail);

    if (mysqli_num_rows($result) > 0) {
        // Generate reset token
        $token = md5(rand());

        // Store token in database
        $update = "UPDATE users SET reset_token='$token' WHERE email='$email'";
        mysqli_query($conn, $update);

        // Create reset link
        $resetLink = "reset-password.php?token=$token";

        // Send email using PHPMailer
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'lumbhanijanvi59@gmail.com'; // 🔁 Change to your Gmail
            $mail->Password = 'janu@#1234';   // 🔁 Use App Password from Gmail
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('lumbhanijanvi59@gmail.com', 'Readlify');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'Password Reset Link - Readlify';
            $mail->Body = "
                <h3>Hello,</h3>
                <p>Click the link below to reset your password:</p>
                <a href='$resetLink'>$resetLink</a>
                <br><br>
                <small>If you didn’t request this, just ignore this email.</small>
            ";

            $mail->send();
            $message = "✅ A password reset link has been sent to your email.";
        } catch (Exception $e) {
            $message = "❌ Failed to send email. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        $message = "❌ This email is not registered.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
    <link rel="stylesheet" href="style.css">
    <title>Readlify / Best Book Store Website</title>
</head>
<body>

<div class="form-modal">
    <div class="form-box">
        <h2>Forgot Password</h2>
        <form method="POST">
            <div class="input-icon">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" placeholder="Enter your registered email" required />
            </div>
            <button type="submit" name="submit">Send Reset Link</button>
        </form>
        <?php if ($message): ?>
            <div class="message"><?= $message ?></div>
        <?php endif; ?>
    </div>
</div>

</body>
</html>
