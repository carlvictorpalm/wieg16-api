<?php
require "db.php";

$id = $_GET['id'];

$sql = "SELECT * FROM user
WHERE id = ".$id;
$statement = $pdo->query($sql);
$statement->execute();
$customers =$statement->fetchAll();
foreach ($customers as $key => $customer) {
    $sql = "SELECT * FROM address WHERE customer_id = ".$customer['id'];
    $query = $pdo->query($sql);
    $address = $query->fetch();
    if ($address != null) {
        $customers[$key]['address'] = $address;
    }
}

header("Content-Type: application/json");
echo json_encode($customers);
