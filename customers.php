<?php
require 'db.php';

$sql = "SELECT * FROM user";
$user = $pdo->query($sql);
$user->execute();
$customers = $user->fetchAll();

foreach ($customers as $key => $value) {
    $sql = "SELECT * FROM address WHERE customer_id = " . $value['id'];
    $query = $pdo->query($sql);
    $address = $query->fetch();

    if ($address != null) {
        $customers[$key]['address'] = $address;
    }
}
header("content-type: application/json");
echo json_encode($customers);