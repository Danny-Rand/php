<?php

ini_set('log_errors', 1);
ini_set('error_log', 'index.log');

session_start();
if (isset($_SESSION['user'])) header('location: dashboard.php');

$error_message = '';

if ($_POST) {
    include('Database/connection.php');

    $username = $_POST['username'];
    $password = $_POST['password'];

    error_log("Provided password: " . $password);

    if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
        $query = 'SELECT * FROM users WHERE email=:username';
    } else {
        $query = 'SELECT * FROM users WHERE username=:username';
    }

    $stmt = $conn->prepare($query);
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    error_log("Query executed with username/email: $username");

    // if ($stmt->rowCount() > 0) {
    //     $stmt->setFetchMode(PDO::FETCH_ASSOC);
    //     error_log("Stored password: " . $user['password']);
    //     error_log("Password verification succeeded.");
    //     $user = $stmt->fetchAll()[0];
    //     $_SESSION['user'] = $user;


    //     header('location: dashboard.php');
    // } else {
    //     error_log("Password verification failed.");
    //     $error_message = 'the username or password you entered is incorrect.';
    // }
    if ($stmt->rowCount() > 0) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        error_log("Stored hashed password: " . $user['password']);
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        error_log("Hashed version of provided password: " . $hashedPassword);
        if (password_verify($password, $user['password'])) {
            error_log("Password verification succeeded.");
            $_SESSION['user'] = $user;
            header('location: dashboard.php');
            exit();
        } else {
            error_log("Password verification failed.");
            $error_message = "the username or password you entered is incorrect.";
        }
    } else {
        error_log("No user found with provided username/email.");
        $error_message = "the username or password you entered is incorrect.";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>IMS Login - Café Esque IMS</title>
    <link rel="stylesheet" type="text/css" href="CSS/index.css">
</head>

<body id="loginBody">
    <?php if (!empty($error_message)) { ?>
        <div id="errorMessage">
            <p>Error: <?= $error_message ?></p>
        </div>
    <?php } ?>
    <div class="container">
        <div class="loginHeader">
            <h1>Café Esque</h1>
        </div>
        <div class="loginBody">
            <form action="index.php" method="POST">
                <div class="loginInputsContainer">
                    <input placeholder="email or username" name="username" type="text" />
                </div>
                <div class="loginInputsContainer">
                    <input placeholder="password" name="password" type="password" />
                </div>
                <div class="loginButtonContainer">
                    <button>Log In</button>
                </div>
                <div class="loginResetContainer">
                    <a href="reset-password.php">Forgot Password?</a>
                </div>
                <?php
                if (isset($_GET["newpwd"])) {
                    if ($_GET["newpwd"] == "passwordupdated") {
                        echo '<p class="reset-success">Your password has been reset.</p>';
                    }
                }
                ?>
            </form>
        </div>
    </div>
</body>

</html>