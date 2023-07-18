<?php
include('header_api.php');

$username = "root";
$password = "";
$database = new PDO("mysql:host=localhost; dbname=csms;", $username, $password);
$database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$data = json_decode(file_get_contents("php://input"));


if (isset($data->id_order) && isset($data->orderTime)) {
    $id = $data->id_order;
    $orderTime = $data->orderTime;
    $delTime = $data->deliverTime;
    $orderType = $data->orderType;

    $orderpro = $data->orderProcess;
    $delliv = $data->delivery;
    $price = $data->totalPrice;

    $putData = $database->prepare("UPDATE orderu SET orderu.orderTime=:orderTime,orderu.deliverTime=:delTime,orderu.orderType=:orderType,
    orderu.orderProcess=:orderpro,orderu.delivery=:delliv,orderu.totalPrice=:price
    WHERE orderu.id_order=:id");

    $putData->bindParam("id", $id);
    $putData->bindParam("orderTime", $orderTime);
    $putData->bindParam("delTime", $delTime);
    $putData->bindParam("orderType", $orderType);

    $putData->bindParam("orderpro", $orderpro);
    $putData->bindParam("delliv", $delliv);
    $putData->bindParam("price", $price);

    $putData->execute();
    print_r(json_encode(array("message" => "updated")));
} else {
    print_r(json_encode(array("message" => "error")));
}


?>