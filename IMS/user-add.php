<?php

session_start();
if (!isset($_SESSION['user'])) header('location: index.php');
$_SESSION['table'] = 'users';
$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html>

<head>
    <title>Dashboard - Igan's Budbod House IMS</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" type="text/css" href="CSS/dashboard.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/e1dd8a9474.js" crossorigin="anonymous"></script>
</head>

<body>
    <div id="dashboardMainContainer">
        <?php include('partials/dashboard-sidebar.php') ?>
        <div class="dashboardContentContainer" id="dashboardContentContainer">
            <?php include('partials/dashboard-topnav.php') ?>
            <div class="dashboardContent">
                <div class="dashboardContentMain">
                    <div id="userAddFormContainer">
                        <form action="database/new-user.php" method="post" class="dashboardForm">
                            <div class="dashboardFormInputContainer">
                                <label for="username" class="userCredentials">Username</label>
                                <input type="text" class="dashboardFormInput" id="username" name="username">
                            </div>
                            <div class="dashboardFormInputContainer">
                                <label for="first_name" class="userCredentials">First Name</label>
                                <input type="text" class="dashboardFormInput" id="first_name" name="first_name">
                            </div>
                            <div class="dashboardFormInputContainer">
                                <label for="last_name" class="userCredentials">Last Name</label>
                                <input type="text" class="dashboardFormInput" id="last_name" name="last_name">
                            </div>
                            <div class="dashboardFormInputContainer">
                                <label for="email" class="userCredentials">Email</label>
                                <input type="text" class="dashboardFormInput" id="email" name="email">
                            </div>
                            <div class="dashboardFormInputContainer">
                                <label for="password" class="userCredentials">Password</label>
                                <input type="password" class="dashboardFormInput" id="password" name="password">
                            </div>
                            <input type="hidden" name="table" value="users">
                            <button type="submit" class="dashboardFormBtn"><i class="fa-solid fa-plus"></i> Add User</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="javascript/dashboard-script.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>