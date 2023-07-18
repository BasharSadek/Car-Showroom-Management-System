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

if (isset($_POST['exteriorcolor']) && isset($_POST['interiorcolor'])) {
    $exteriorcolor = $_POST['exteriorcolor'];
    $interiorcolor = $_POST['interiorcolor'];
    // $srcCO = $_POST['srcCO'];
    $id_car_Card = $_POST['id_car_Card'];



    $addData = $database->prepare("INSERT INTO color VALUES (NULL,:exteriorcolor,:interiorcolor,:srcCO,:id_car_Card);");

    $addData->bindParam("exteriorcolor", $exteriorcolor);
    $addData->bindParam("interiorcolor", $interiorcolor);

    if (isset($_FILES['srcCO'])) {
        $file_name = $_FILES['srcCO']['name'];
        $tmp_file_name = $_FILES['srcCO']['tmp_name'];
        move_uploaded_file($tmp_file_name, 'image/' . $file_name);
    }


    $addData->bindParam("srcCO", $file_name);
    $addData->bindParam("id_car_Card", $id_car_Card);

    $addData->execute();


    print_r(json_encode(array("message" => "تم اضافة بيانات بنجاح")));
}
