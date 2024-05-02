<?php

if (isset($_POST["reset-request-submit"])) {
    $selector = bin2hex(random_bytes(8));
    $token = random_bytes(32);

    $url = "http://localhost/php/IMS/new-password.php?selector=" . $selector . "&validator=" . bin2hex($token);

    $expires = date("U") + 1800;

    require 'database/connection.php';

    $userEmail = $_POST["email"];

    $sql = "DELETE FROM pwdReset WHERE pwdResetEmail=?";
    try {
        $stmt = $conn->prepare($sql);
        $stmt->execute([$userEmail]);
    } catch (PDOException $e) {
        echo "There was an error: " . $e->getMessage();
        exit();
    }

    $sql = "INSERT INTO pwdReset (pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires) VALUES (?,?,?,?)";
    try {
        $stmt = $conn->prepare($sql);
        $hashedToken = password_hash($token, PASSWORD_DEFAULT);
        $stmt->execute([$userEmail, $selector, $hashedToken, $expires]);
        $stmt->closeCursor();
        $conn = null; // Close PDO connection if needed (In other words, optional)
    } catch (PDOException $e) {
        echo "There was an error: " . $e->getMessage();
        exit();
    }

    $to = $userEmail;
    $subject = 'Reset your password for IMS';
    $message = '<p>We received a password reset request. The link to reset your password is below. If you did not make this request, you can ignore this email.</p>';
    $message .= '<p>Here is your password reset link: </br>';
    $message .= '<a href="' . $url . '">' . $url . '</a></p>';

    $headers = "From: danyves <danyves@ims.com>\r\n";
    $headers .= "Reply-To: danyves@ims.com\r\n";
    $headers .= "Content-type: text/html\r\n";

    mail($to, $subject, $message, $headers);

    header("Location: ../reset-password.php?reset=success");
} else {
    header("Location: ../index.php");
}
