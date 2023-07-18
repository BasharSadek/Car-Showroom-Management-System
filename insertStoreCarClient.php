<?php
include('header_api.php');
$username = "root";
$password = "";
$database = new PDO("mysql:host=localhost; dbname=csms;", $username, $password);
$database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$data = json_decode(file_get_contents("php://input"));


if (isset($data->priceSC) && isset($data->quantitySC)) {
    $priceSC = $data->priceSC;
    $quantitySC = $data->quantitySC;
    $id_userAccount = $data->id_userAccount;

    $id_car_Card = $data->id_car_Card;
    $addData = $database->prepare("INSERT INTO store_car VALUES(NULL,:priceSC,:quantitySC,:id_userAccount,:id_car_Card);");
    $addData->bindParam("priceSC", $priceSC);
    $addData->bindParam("quantitySC", $quantitySC);
    $addData->bindParam("id_userAccount", $id_userAccount);

    $addData->bindParam("id_car_Card", $id_car_Card);

    $addData->execute();

    print_r(json_encode(array("message" => "تم اضافة بيانات بنجاح")));
}
