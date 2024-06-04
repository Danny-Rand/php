<?php

ini_set('log_errors', 1);
ini_set('error_log', 'reset-password-script.log');

if (isset($_POST["reset-password-submit"])) {

    $selector = $_POST["selector"];
    $validator = $_POST["validator"];
    $password = $_POST["pwd"];
    $passwordRepeat = $_POST["pwd-repeat"];

    if (empty($password) || empty($passwordRepeat)) {
        header("Location: ../index.php?newpwd=empty");
        exit();
    } else if ($password != $passwordRepeat) {
        header("Location: ../index.php?newpwd=pwdnotsame");
        exit();
    }

    $currentDate = date("U");

    require '../Database/connection.php';

    try {
        $sql = "SELECT * FROM pwdreset WHERE pwdResetSelector = ? AND pwdResetExpires >= ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$selector, $currentDate]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            echo "You need to re-submit your reset request.";
            exit();
        } else {
            $tokenBin = hex2bin($validator);
            $tokenCheck = password_verify($tokenBin, $row["pwdResetToken"]);

            error_log("Selector: $selector");
            error_log("Validator: $validator");
            error_log("Token Bin: " . bin2hex($tokenBin));
            error_log("Token Check: " . ($tokenCheck ? 'true' : 'false'));

            if ($tokenCheck === false) {
                echo "You need to re-submit your reset request.";
                exit();
            } elseif ($tokenCheck === true) {
                $tokenEmail = $row['pwdResetEmail'];

                error_log("Email: $tokenEmail");

                $sql = "SELECT * FROM users WHERE email = ?";
                $stmt = $conn->prepare($sql);
                $stmt->execute([$tokenEmail]);
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                if (!$row) {
                    echo "There was an error";
                    exit();
                } else {
                    $sql = "UPDATE users SET password = ? WHERE email = ?";
                    $stmt = $conn->prepare($sql);
                    $newPwdHash = password_hash($password, PASSWORD_DEFAULT);
                    error_log("New hashed password: " . $newPwdHash);
                    $stmt->execute([$newPwdHash, $tokenEmail]);

                    $sql = "DELETE FROM pwdreset WHERE pwdResetEmail = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute([$tokenEmail]);
                    header("Location: ../index.php?newpwd=passwordupdated");
                }
            }
        }
    } catch (PDOException $e) {
        echo "There was an error: " . $e->getMessage();
        exit();
    }
} else {
    header("Location: ../index.php");
}
