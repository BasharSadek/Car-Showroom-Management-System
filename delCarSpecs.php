<?php
include('header_api.php');

$username = "root";
$password = "";
$database = new PDO("mysql:host=localhost; dbname=csms;", $username, $password);
$database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//$data = json_decode(file_get_contents("php://input"));

$id = $_GET['id'];

if (isset($id)) {
   // $id = $data->id_car_Specs;
    $detData = $database->prepare("DELETE FROM car_specs WHERE car_specs.id_car_Specs=:id");
    $detData->bindParam("id", $id);
    $detData->execute();
    print_r(json_encode(array("message" => "Deleted")));
} else {
    print_r(json_encode(array("message" => "error")));
}


?>