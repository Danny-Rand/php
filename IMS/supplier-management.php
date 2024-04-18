<?php

session_start();
if (!isset($_SESSION['user'])) header('location: index.php');
$_SESSION['table'] = '';
$user = $_SESSION['user'];
$suppliers = include('database/suppliers.php');
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard - Café Esque IMS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="CSS/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="CSS/datatable.css">

</head>

<body>
    <div id="dashboardMainContainer">
        <?php include('partials/dashboard-sidebar.php') ?>
        <div class="dashboardContentContainer" id="dashboardContentContainer">
            <?php include('partials/dashboard-topnav.php') ?>
            <div class="dashboardContent">
                <div class="dashboardContentMain">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Supplier Name</th>
                                    <th>Supplier Location</th>
                                    <th>Contact Person</th>
                                    <th>Contact Title</th>
                                    <th>Contact Number</th>
                                    <th>Country</th>
                                    <th>Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($suppliers as $index => $supplier) { ?>
                                    <tr>
                                        <td><?php echo $index + 1 ?></td>
                                        <td><?php echo $supplier['supplier-name'] ?></td>
                                        <td><?php echo $supplier['supplier-location'] ?></td>
                                        <td><?php echo $supplier['contact-person'] ?></td>
                                        <td><?php echo $supplier['contact-title'] ?></td>
                                        <td><?php echo $supplier['contact-number'] ?></td>
                                        <td><?php echo $supplier['country'] ?></td>
                                        <td><?php echo $supplier['email'] ?></td>
                                    </tr>
                                <?php } ?>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Supplier Name</th>
                                    <th>Supplier Location</th>
                                    <th>Contact Person</th>
                                    <th>Contact Title</th>
                                    <th>Contact Number</th>
                                    <th>Country</th>
                                    <th>Email</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script defer src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script defer src="javascript/datatable.js"></script>
    <script defer src="https://cdn.datatables.net/2.0.3/js/dataTables.bootstrap5.js"></script>
    <script defer src="javascript/inventory.js"></script>
    <script src="https://kit.fontawesome.com/e1dd8a9474.js" crossorigin="anonymous"></script>
    <script src="javascript/dashboard-script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>