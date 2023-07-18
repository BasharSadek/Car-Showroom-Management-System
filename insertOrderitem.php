<?php
include('header_api.php');
$username = "root";
$password = "";
$database = new PDO("mysql:host=localhost; dbname=csms;", $username, $password);
$database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$data = json_decode(file_get_contents("php://input"));


if (isset($data->id_order) && isset($data->exteriorcolorO)) {
    $id_order = $data->id_order;
    $exteriorcolorO = $data->exteriorcolorO;
    $interiorcolorO = $data->interiorcolorO;

    $quantity = $data->quantity;
    $PriceO = $data->PriceO;
    $id_car_Card = $data->id_car_Card;

    $id_part = $data->id_part;
    $addData = $database->prepare("INSERT INTO order_tiem VALUES (NULL,:id_order,:exteriorcolorO,:interiorcolorO,:quantity,:PriceO,:id_car_Card,:id_part);");
    $addData->bindParam("id_order", $id_order);
    $addData->bindParam("exteriorcolorO", $exteriorcolorO);
    $addData->bindParam("interiorcolorO", $interiorcolorO);

    $addData->bindParam("quantity", $quantity);
    $addData->bindParam("PriceO", $PriceO);
    $addData->bindParam("id_car_Card", $id_car_Card);

    $addData->bindParam("id_part", $id_part);

    $addData->execute();

    print_r(json_encode(array("message" => "تم اضافة بيانات بنجاح")));
}


?>