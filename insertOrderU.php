<?php
include('header_api.php');
$username = "root";
$password = "";
$database = new PDO("mysql:host=localhost; dbname=csms;", $username, $password);
$database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$data = json_decode(file_get_contents("php://input"));


if (isset($data->orderTime) && isset($data->deliverTime)) {
    $orderTime = $data->orderTime;
    $deliverTime = $data->deliverTime;
    $id_dealer = $data->id_dealer;

    $id_user = $data->id_user;
    $orderType = $data->orderType;
    $orderProcess = $data->orderProcess;

    $delivery = $data->delivery;
    $totalPrice = $data->totalPrice;
    $addData = $database->prepare("INSERT INTO orderu VALUES (NULL,:orderTime,:deliverTime,:id_dealer,:id_user,:orderType,:orderProcess,:delivery,:totalPrice);");

    $addData->bindParam("orderTime", $orderTime);
    $addData->bindParam("deliverTime", $deliverTime);
    $addData->bindParam("id_dealer", $id_dealer);

    $addData->bindParam("id_user", $id_user);
    $addData->bindParam("orderType", $orderType);
    $addData->bindParam("orderProcess", $orderProcess);

    $addData->bindParam("delivery", $delivery);
    $addData->bindParam("totalPrice", $totalPrice);

    $addData->execute();

    print_r(json_encode(array("message" => "تم اضافة بيانات بنجاح")));
}


?>