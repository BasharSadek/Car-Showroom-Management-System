<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: multipart/form-data; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PUT");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");


$username = "root";
$password = "";
$database = new PDO("mysql:host=localhost; dbname=csms;", $username, $password);
$database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//$data = json_decode(file_get_contents("php://input"));


if (isset($_POST['id_car_Specs']) && isset($_POST['EPA_Est_MPG'])) {
    $id = $_POST['id_car_Specs'];

    //$main = $_POST['main_src'];
    $epa = $_POST['EPA_Est_MPG'];
    $engine = $_POST['EngineType'];

    $drive = $_POST['DriveTRAIN'];
    $towing = $_POST['TOWING'];
    $technolo = $_POST['TECHNOLOGY'];

    $mileage = $_POST['MileageEstimates'];
    $unload = $_POST['UnloadedHeight'];
    $over = $_POST['OverallWidth'];

    $fuel = $_POST['Fuel_tank'];

    $putData = $database->prepare("UPDATE car_specs SET car_specs.main_src=:main,car_specs.EPA_Est_MPG=:epa,car_specs.EngineType=:engine,
    car_specs.DriveTRAIN=:drive,car_specs.TOWING=:towing,car_specs.TECHNOLOGY=:technolo,
    car_specs.MileageEstimates=:mileage,car_specs.UnloadedHeight=:unloa,car_specs.OverallWidth=:overa,
    car_specs.Fuel_tank=:fuel
    WHERE car_specs.id_car_Specs=:id");


    $putData->bindParam("id", $id);

    if (isset($_FILES['main_src'])) {
        $file_name = $_FILES['main_src']['name'];
        $tmp_file_name = $_FILES['main_src']['tmp_name'];
        move_uploaded_file($tmp_file_name, 'image/' . $file_name);
    }


    $putData->bindParam("main", $file_name);
    $putData->bindParam("epa", $epa);
    $putData->bindParam("engine", $engine);

    $putData->bindParam("drive", $drive);
    $putData->bindParam("towing", $towing);
    $putData->bindParam("technolo", $technolo);

    $putData->bindParam("mileage", $mileage);
    $putData->bindParam("unloa", $unload);
    $putData->bindParam("overa", $over);

    $putData->bindParam("fuel", $fuel);

    $putData->execute();

    print_r(json_encode(array("message" => "updated")));
} else {
    print_r(json_encode(array("message" => "error")));
}
