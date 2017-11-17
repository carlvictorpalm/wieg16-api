<?php
require "db.php";

$id = $_GET['customer_id'];

$sql_address = "SELECT postcode, street, city FROM address WHERE customer_id = ".$id;
$statement = $pdo->query($sql_address);
$statement->execute();
$customers =$statement->fetch();

header("Content-Type: application/json");
if ($customers != null){
    echo json_encode($customers);
}
else {
    header("HTTP/1.0 404 not found");
    echo json_encode(["message" => "Customer not found"]);
}