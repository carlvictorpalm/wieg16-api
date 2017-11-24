<?php
require 'db.php';

$companies= [];

$sql = "SELECT * FROM user";
$stmt = $pdo->query($sql);
$stmt->execute();
$customers = $stmt->fetchAll();

foreach ($customers as $customer){
    $companies[] = $customer['customer_company'];
}

$companies= array_unique($companies);
header("Content-Type: application/json");
echo json_encode($companies);

foreach ($companies as $company) {
    $sql = "SELECT * FROM companies WHERE company_name = '$company'";
    $result = $pdo->query($sql);
    if($result -> rowCount() == 0){
        $sql="INSERT INTO companies (company_name) VALUES ('$company')";
        $pdo->query($sql);
    }
}
$sql = "SELECT * FROM companies";
$result = $pdo->query($sql);
$dbCompanies = $result->fetchAll(PDO::FETCH_ASSOC);

foreach($dbCompanies as $dbCompany){
    $sql = "UPDATE user SET company_id = ".$dbCompany['id']. " WHERE customer_company = '".$dbCompany['company_name']."'";
    $pdo->query($sql);
}