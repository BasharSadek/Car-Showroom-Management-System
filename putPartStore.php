<?php
include('header_api.php');

$username = "root";
$password = "";
$database = new PDO("mysql:host=localhost; dbname=csms;", $username, $password);
$database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$data = json_decode(file_get_contents("php://input"));


if (isset($data->id_store_part) && isset($data->priceSP)) {
    $id = $data->id_store_part;
    $priceSP = $data->priceSP;
    $quantitySP = $data->quantitySP;
  

    $putData = $database->prepare("UPDATE store_part SET store_part.priceSP=:priceSP, store_part.quantitySP=:quantitySP
    WHERE store_part.id_store_part=:id;");

    $putData->bindParam("id", $id);
    $putData->bindParam("priceSP", $priceSP);
    $putData->bindParam("quantitySP", $quantitySP);
   
    $putData->execute();
    print_r(json_encode(array("message" => "updated")));
} else {
    print_r(json_encode(array("message" => "error")));
}


?>