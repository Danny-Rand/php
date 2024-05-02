<?php

session_start();
if (isset($_SESSION['user'])) header('location: dashboard.php');

$error_message = '';

if ($_POST) {
    include('Database/connection.php');

    $username = $_POST['username'];
    $password = $_POST['password'];

    if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
        $query = 'SELECT * FROM users WHERE email=:username AND password=:password';
    } else {
        $query = 'SELECT * FROM users WHERE username=:username AND password=:password';
    }

    $stmt = $conn->prepare($query);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $user = $stmt->fetchAll()[0];
        $_SESSION['user'] = $user;

        header('location: dashboard.php');
    } else {
        $error_message = 'the username or password you entered is incorrect.';
    }
    // if($stmt->rowCount() > 0) {
    //     $user = $stmt->fetch(PDO::FETCH_ASSOC);
    //     if (password_verify($password, $user['password'])) {
    //         $_SESSION['user'] = $user;
    //         header('location: dashboard.php');
    //         exit();
    //     } else {
    //         $error_message = "the username or password you entered is incorrect.";
    //     }
    // } else {
    //     $error_message = "the username or password you entered is incorrect.";
    // }
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
                <div class="loginResetContainer">
                    <?php 
                    if (isset($_GET["newpwd"])) {
                        if ($_GET["newpwd"] == "passwordupdated") {
                            echo '<p class="reset-success">Your password has been reset.</p>';
                        }
                    }
                    ?>
                    <a href="reset-password.php">Forgot Password?</a>
                </div>
                <div class="loginButtonContainer">
                    <button>Log In</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>