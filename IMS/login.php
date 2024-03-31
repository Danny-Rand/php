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
        $error_message = 'The username, password, or role you entered is incorrect.';
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

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>IMS Login - Igan's Budbod House IMS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="CSS/new-login.css">
</head>

<body>
    <!-- <div class="loginHeader" style="text-align: center; margin-bottom: 80px; margin-top: 20px;">
        <h1 style="font-size: 60px; color: #b30000; padding: 0px; margin: 0px; text-transform: uppercase;">Igan's Budbod House</h1>
        <p style="font-size: 36px; color: #f7afaf; margin: 0px; text-transform: uppercase;
         display: inline-block;">Inventory Management System</p>
    </div> -->
    <div class="login-container">
        <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh">
            <form class="border shadow p-3 rounded" style="width: 450px" method="post">
                <h1 class="text-center p-3">LOGIN</h1>
                <?php if (!empty($error_message)) { ?>
                    <div class="alert alert-danger" role="alert" style="text-align: center">
                        <p><?= $error_message ?></p>
                    </div>
                <?php } ?>
                <div class="mb-3">
                    <label for="username" class="form-label">Username or Email</label>
                    <input type="text" class="form-control" id="username" name="username">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <div class="mb-1">
                    <label class="form-label">Select User Type:</label>
                </div>
                <select class="form-select mb-3" aria-label="Default select example" name="role">
                    <option selected value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>

</html>