<?php
include('header_api.php');
$username = "root";
$password = "";
$database = new PDO("mysql:host=localhost; dbname=csms;", $username, $password);
$database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$data = json_decode(file_get_contents("php://input"));



if (isset($data->messageDate) && isset($data->text_messages)) {
    $messageDate = $data->messageDate;
    $text_messages = $data->text_messages;
    $id_dealer = $data->id_dealer;
    $id_client = $data->id_client;
    $addData = $database->prepare("INSERT INTO messages VALUES (NULL,:messageDate,:text_messages,:id_dealer,:id_client);");
    $addData->bindParam("messageDate", $messageDate);
    $addData->bindParam("text_messages", $text_messages);
    $addData->bindParam("id_dealer", $id_dealer);
    $addData->bindParam("id_client", $id_client);


    $addData->execute();

    print_r(json_encode(array("message" => "تم اضافة بيانات بنجاح")));
}


?>