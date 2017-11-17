<?php
require "db.php";

$sql = 'SELECT user.*, address.id AS address_id
        FROM `user` 
        LEFT JOIN `address` 
        ON `user`.`id`=`address`.`customer_id`';
$sql = "SELECT * FROM user";
$statement = $pdo->prepare($sql);
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

if ($customers){
    header("Content-Type: application/json");
    echo json_encode($customers);
}
else {
    header("HTTP/1.0 404 not found");
    echo json_encode(["message" => "Customer not found"]);
}