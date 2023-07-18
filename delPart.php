<?php
include('header_api.php');

$username = "root";
$password = "";
$database = new PDO("mysql:host=localhost; dbname=csms;", $username, $password);
$database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//$data = json_decode(file_get_contents("php://input"));

$id = $_GET['id'];

if (isset($id)) {
   // $id = $data->id_part;
    $detData = $database->prepare("DELETE FROM store_part WHERE store_part.id_part=:id;");
    $detData->bindParam("id", $id);
    $detData->execute();

    $detData = $database->prepare("DELETE FROM order_tiem WHERE order_tiem.id_part=:id2;");
    $detData->bindParam("id2", $id);
    $detData->execute();

    $detData = $database->prepare("DELETE FROM part WHERE part.id_part=:id3;");
    $detData->bindParam("id3", $id);
    $detData->execute();

    print_r(json_encode(array("message" => "Deleted")));
} else {
    print_r(json_encode(array("message" => "error")));
}



?>