<?php
include('header_api.php');

$username = "root";
$password = "";
$database = new PDO("mysql:host=localhost; dbname=csms;", $username, $password);
$database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$data = json_decode(file_get_contents("php://input"));


if (isset($data->id_store_car) && isset($data->priceSC)) {
    $id = $data->id_store_car;
    $priceSC = $data->priceSC;
    $quantitySC = $data->quantitySC;
  

    $putData = $database->prepare("UPDATE store_car SET store_car.priceSC=:priceSC,store_car.quantitySC=:quantitySC
    WHERE store_car.id_store_car=:id;");

    $putData->bindParam("id", $id);
    $putData->bindParam("priceSC", $priceSC);
    $putData->bindParam("quantitySC", $quantitySC);
   
    $putData->execute();
    print_r(json_encode(array("message" => "updated")));
} else {
    print_r(json_encode(array("message" => "error")));
}


?>