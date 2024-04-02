<?php

include('connection.php');
$stmt = $conn->prepare("SELECT * FROM orders");
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);

return $stmt->fetchAll();
