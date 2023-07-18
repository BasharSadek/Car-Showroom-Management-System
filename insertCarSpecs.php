<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: multipart/form-data; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PUT");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

$username = "root";
$password = "";
$database = new PDO("mysql:host=localhost; dbname=csms;", $username, $password);
$database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// $data = json_decode(file_get_contents("php://input"));

if (isset($_POST['EPA_Est_MPG']) && isset($_POST['EngineType'])) {
    // $main_src = $_POST['main_src'];
    $EPA_Est_MPG = $_POST['EPA_Est_MPG'];
    $EngineType = $_POST['EngineType'];

    $DriveTRAIN = $_POST['DriveTRAIN'];
    $TOWING = $_POST['TOWING'];
    $TECHNOLOGY = $_POST['TECHNOLOGY'];

    $MileageEstimates = $_POST['MileageEstimates'];
    $UnloadedHeight = $_POST['UnloadedHeight'];
    $OverallWidth = $_POST['OverallWidth'];

    $Fuel_tank = $_POST['Fuel_tank'];
    $id_car_Card = $_POST['id_car_Card'];



    $addData = $database->prepare("INSERT INTO car_specs VALUES(NULL,:main_src,:EPA_Est_MPG,:EngineType,:DriveTRAIN,:TOWING,:TECHNOLOGY,:MileageEstimates,:UnloadedHeight,:OverallWidth,:Fuel_tank,:id_car_Card);");
    if (isset($_FILES['main_src'])) {
        $file_name = $_FILES['main_src']['name'];
        $tmp_file_name = $_FILES['main_src']['tmp_name'];
        move_uploaded_file($tmp_file_name, 'image/' . $file_name);
    }

    $addData->bindParam("main_src", $file_name);
    $addData->bindParam("EPA_Est_MPG", $EPA_Est_MPG);
    $addData->bindParam("EngineType", $EngineType);

    $addData->bindParam("DriveTRAIN", $DriveTRAIN);
    $addData->bindParam("TOWING", $TOWING);
    $addData->bindParam("TECHNOLOGY", $TECHNOLOGY);

    $addData->bindParam("MileageEstimates", $MileageEstimates);
    $addData->bindParam("UnloadedHeight", $UnloadedHeight);
    $addData->bindParam("OverallWidth", $OverallWidth);

    $addData->bindParam("Fuel_tank", $Fuel_tank);
    $addData->bindParam("id_car_Card", $id_car_Card);

    $addData->execute();


    print_r(json_encode(array("message" => "تم اضافة بيانات بنجاح")));
}
