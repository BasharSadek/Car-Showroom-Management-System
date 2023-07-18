<?php
include('header_api.php');

$username = "root";
$password = "";
$database = new PDO("mysql:host=localhost; dbname=csms;", $username, $password);
$database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$data = json_decode(file_get_contents("php://input"));




if (isset($data->id_order_tiem) && isset($data->exteriorcolorO)) {
    $id = $data->id_order_tiem;
    $exteriorcolorO = $data->exteriorcolorO;
    $interiorcolorO = $data->interiorcolorO;

    $quantity = $data->quantity;
    $PriceO = $data->PriceO;

    $putData = $database->prepare("UPDATE order_tiem SET order_tiem.exteriorcolorO=:exteriorcolorO,order_tiem.interiorcolorO=:interiorcolorO,
    order_tiem.quantity=:quantity,order_tiem.PriceO=:PriceO
    WHERE order_tiem.id_order_tiem=:id_order_tiem");

    $putData->bindParam("id_order_tiem", $id);
    $putData->bindParam("exteriorcolorO", $exteriorcolorO);
    $putData->bindParam("interiorcolorO", $interiorcolorO);

    $putData->bindParam("quantity", $quantity);
    $putData->bindParam("PriceO", $PriceO);

    $putData->execute();
    print_r(json_encode(array("message" => "updated")));
} else {
    print_r(json_encode(array("message" => "error")));
}
