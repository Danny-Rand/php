<?php

session_start();
if (!isset($_SESSION['user'])) header('location: index.php');
$_SESSION['table'] = '';
$user = $_SESSION['user'];
$products = include('database/products.php');
?>

<!DOCTYPE html>
<html>

<head>
    <title>Dashboard - Igan's Budbod House IMS</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" type="text/css" href="CSS/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="CSS/datatable.css">

    <script defer src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script defer src="javascript/datatable.js"></script>
    <script defer src="https://cdn.datatables.net/2.0.2/js/dataTables.bootstrap5.js"></script>
    <script defer src="Javascript/product-listings.js"></script>
    <script src="https://kit.fontawesome.com/e1dd8a9474.js" crossorigin="anonymous"></script>
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
                                    <th>Product Name</th>
                                    <th>SKU</th>
                                    <th>Stock Qty.</th>
                                    <th>Unit Price</th>
                                    <th>Total Value</th>
                                    <th>Category</th>
                                    <th>Supplier</th>
                                    <th>Reorder Point</th>
                                    <th>Last Updated</th>
                                    <th>Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($products as $index => $product) { ?>
                                    <tr>
                                        <td><?php echo $index + 1 ?></td>
                                        <td><?php echo $product['product-name'] ?></td>
                                        <td><?php echo $product['sku'] ?></td>
                                        <td><?php echo $product['stock-qty'] ?></td>
                                        <td><?php echo $product['unit-price'] ?></td>
                                        <td><?php echo $product['total-value'] ?></td>
                                        <td><?php echo $product['category'] ?></td>
                                        <td><?php echo $product['supplier'] ?></td>
                                        <td><?php echo $product['reorder-point'] ?></td>
                                        <td><?php echo $product['last-updated'] ?></td>
                                        <td><?php echo $product['description'] ?></td>
                                    </tr>
                                <?php } ?>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Product Name</th>
                                    <th>SKU</th>
                                    <th>Stock Qty.</th>
                                    <th>Unit Price</th>
                                    <th>Total Value</th>
                                    <th>Category</th>
                                    <th>Supplier</th>
                                    <th>Reorder Point</th>
                                    <th>Last Updated</th>
                                    <th>Description</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="javascript/dashboard-script.js"></script>
</body>

</html>