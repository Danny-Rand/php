<?php

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

ini_set('log_errors', 1);
ini_set('error_log', 'reset-request.log');

error_log("reset-request.php script started.");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST["reset-request-submit"])) {
    error_log("Reset request submit detected.");
    
    $selector = bin2hex(random_bytes(8));
    $token = random_bytes(32);

    $url = "http://localhost/php/IMS/new-password.php?selector=" . $selector . "&validator=" . bin2hex($token);

    $expires = date("U") + 1800;

    require '../database/connection.php';

    $userEmail = $_POST["email"];

    error_log("Processing reset for email: $userEmail");

    $sql = "DELETE FROM pwdreset WHERE pwdResetEmail=?";
    try {
        $stmt = $conn->prepare($sql);
        $stmt->execute([$userEmail]);
        error_log("Deleted existing reset entries for email: $userEmail");
    } catch (PDOException $e) {
        error_log("Error deleting existing reset entries: " . $e->getMessage());
        echo "There was an error: " . $e->getMessage();
        exit();
    }

    $sql = "INSERT INTO pwdreset (pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires) VALUES (?,?,?,?)";
    try {
        $stmt = $conn->prepare($sql);
        $hashedToken = password_hash($token, PASSWORD_DEFAULT);
        $stmt->execute([$userEmail, $selector, $hashedToken, $expires]);
        error_log("Inserted new reset entry for email: $userEmail with selector: $selector");
        /* $stmt->closeCursor(); */
        /* $conn = null; // Close PDO connection if needed (optional) */
    } catch (PDOException $e) {
        error_log("Error inserting new reset entry: " . $e->getMessage());
        echo "There was an error: " . $e->getMessage();
        exit();
    }

    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();
        $mail->Host       = 'localhost';  // Set the SMTP server to send through
        $mail->SMTPAuth   = false;
        /* $mail->Username   = 'your-email@example.com';    // SMTP username
        $mail->Password   = 'your-email-password';       // SMTP password */
        /* $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; */
        $mail->SMTPSecure = '';
        $mail->Port       = 1025;

        //Recipients
        $mail->setFrom('danyves@ims.com', 'danyves');
        $mail->addAddress($userEmail);     // Add a recipient

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Reset your password for IMS';
        $mail->Body    = '<p>We received a password reset request. The link to reset your password is below. If you did not make this request, you can ignore this email.</p>';
        $mail->Body   .= '<p>Here is your password reset link: <br>';
        $mail->Body   .= '<a href="' . $url . '">' . $url . '</a></p>';

        $mail->send();
        error_log("Reset email sent to: $userEmail");
        header("Location: ../reset-password.php?reset=success");
    } catch (Exception $e) {
        error_log("Error sending reset email: " . $mail->ErrorInfo);
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    error_log("No reset request submit detected.");
    header("Location: ../index.php");
}

error_log("reset-request.php script ended.");