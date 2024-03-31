<?php

include('connection.php');
$stmt = $conn->prepare("SELECT * FROM products");
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);

return $stmt->fetchAll();
