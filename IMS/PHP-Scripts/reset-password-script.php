<?php

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

    require 'database/connection.php';

    try {
        $sql = "SELECT * FROM pwdReset WHERE pwdResetSelector = ? AND pwdResetExpires >= ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$selector, $currentDate]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            echo "You need to re-submit your reset request.";
            exit();
        } else {
            $tokenBin = hex2bin($validator);
            $tokenCheck = password_verify($tokenBin, $row["pwdResetToken"]);

            if ($tokenCheck === false) {
                echo "You need to re-submit your reset request.";
                exit();
            } elseif ($tokenCheck === true) {
                $tokenEmail = $row['pwdResetEmail'];

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
                    $stmt->execute([$newPwdHash, $tokenEmail]);

                    $sql = "DELETE FROM pwdReset WHERE pwdResetEmail = ?";
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
