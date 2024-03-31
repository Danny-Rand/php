<?php

include('connection.php');
$stmt = $conn->prepare("SELECT * FROM users");
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);

return $stmt->fetchAll();
