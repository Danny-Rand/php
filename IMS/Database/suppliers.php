<?php

include('connection.php');
$stmt = $conn->prepare("SELECT * FROM suppliers");
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);

return $stmt->fetchAll();
