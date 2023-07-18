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


if (isset($_POST['partName']) && isset($_POST['price'])) {
    $partName =  $_POST['partName'];
    // $srcPA =  $_POST['srcPA'];
    $price = $_POST['price'];
    $classPA =  $_POST['classPA'];

    $id_car_Card =  $_POST['id_car_Card'];

    $addData = $database->prepare("INSERT INTO part VALUES(NULL,:partName,:srcPA,:price,:classPA,:id_car_Card);");

    $addData->bindParam("partName", $partName);

    $addData->bindParam("price", $price);
    $addData->bindParam("classPA", $classPA);

    $addData->bindParam("id_car_Card", $id_car_Card);

    if (isset($_FILES['srcPA'])) {
        $file_name = $_FILES['srcPA']['name'];
        $tmp_file_name = $_FILES['srcPA']['tmp_name'];
        move_uploaded_file($tmp_file_name, 'image/' . $file_name);
    }
    $addData->bindParam("srcPA", $file_name);
    $addData->execute();

    print_r(json_encode(array("message" => "تم اضافة بيانات بنجاح")));
}
