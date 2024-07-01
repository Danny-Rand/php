<?php

session_start();
if (isset($_SESSION['user'])) header('location: dashboard.php');

$error_message = '';

if (isset($_POST['submit'])) {
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