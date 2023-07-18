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

    $exteriorcolorO = $data->exteriorcolorO;
    $interiorcolorO = $data->interiorcolorO;

    $quantity = $data->quantity;
    $PriceO = $data->PriceO;
    $id_car_Card = $data->id_car_Card;

    $id_part = $data->id_part;
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

    $data2 = $database->prepare("SELECT orderu.id_order FROM orderu
                       ORDER BY orderu.id_order DESC LIMIT 1;");
    $data2->execute();

    foreach ($data2 as $re) {
        $id_order = $re['id_order'];
    }

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