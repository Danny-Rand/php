<?php
session_start();

$_SESSION['table'] = 'users';
$table_name = $_SESSION['table'];
$username = $_POST['username'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$password = $_POST['password'];

//Password Hashing
// $encrypted = password_hash($password, PASSWORD_DEFAULT);

try {
    $command = "INSERT INTO 
                        $table_name(username, first_name, last_name, email, password) 
                    VALUES 
                        ('" . $username . "', '" . $first_name . "', '" . $last_name . "', '" . $email . "', '" . $password . "')";

    //Shortcut for connecting to database
    include('connection.php');

    $conn->exec($command);
    $response = [
        'success' => true,
        'message' => $first_name . ' ' . $last_name . ' is successfully added to the system.'
    ];
} catch (PDOException $e) {
    $response = [
        'success' => false,
        'message' => $e->getMessage()
    ];
}

$_SESSION['response'] = $response;
header('Location: ../user-add.php');
