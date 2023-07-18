<?php
include('header_api.php');

$username = "root";
$password = "";
$database = new PDO("mysql:host=localhost; dbname=csms;", $username, $password);
$database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$data = json_decode(file_get_contents("php://input"));



if (isset($data->id_order_tiem) && isset($data->exteriorcolorO)) {
    $id = $data->id_order_tiem;
    $exterior = $data->exteriorcolorO;
    $interior = $data->interiorcolorO;

    $quan = $data->quantity;
    $price = $data->PriceO;

    $putData = $database->prepare("UPDATE order_tiem SET order_tiem.exteriorcolorO=:exterior,order_tiem.interiorcolorO=:interior,
    order_tiem.quantity=:quan,order_tiem.PriceO=:price
    WHERE order_tiem.id_order_tiem=:id");

    $putData->bindParam("id", $id);
    $putData->bindParam("exterior", $exterior);
    $putData->bindParam("interior", $interior);

    $putData->bindParam("quan", $quan);
    $putData->bindParam("price", $price);

    $putData->execute();
    print_r(json_encode(array("message" => "updated")));
} else {
    print_r(json_encode(array("message" => "error")));
}


?>