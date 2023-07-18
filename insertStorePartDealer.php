<?php
include('header_api.php');
$username = "root";
$password = "";
$database = new PDO("mysql:host=localhost; dbname=csms;", $username, $password);
$database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$data = json_decode(file_get_contents("php://input"));


if (isset($data->priceSP) && isset($data->quantitySP)) {
  $priceSP = $data->priceSP;
  $quantitySP = $data->quantitySP;
  $id_userAccount = $data->id_userAccount;

  $id_part = $data->id_part;
  $addData = $database->prepare("INSERT INTO store_part VALUES(NULL,:priceSP,:quantitySP,:id_userAccount,:id_part);");
  $addData->bindParam("priceSP", $priceSP);
  $addData->bindParam("quantitySP", $quantitySP);
  $addData->bindParam("id_userAccount", $id_userAccount);

  $addData->bindParam("id_part", $id_part);

  $addData->execute();

  print_r(json_encode(array("message" => "تم اضافة بيانات بنجاح")));
}
