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



if (isset($_POST['classCC']) && isset($_POST['yearC'])) {
    //$srcCC = $_POST['srcCC'];
    $classCC = $_POST['classCC'];
    $yearC = $_POST['yearC'];
    $carName = $_POST['carName'];

    $carModel = $_POST['carModel'];
    $price = $_POST['price'];
    $mpg = $_POST['mpg'];


    $addData = $database->prepare("INSERT INTO car_card VALUES (NULL,:srcCC,:classCC,:yearC,:carName,:carModel,:price,:mpg);");

    if (isset($_FILES['srcCC'])) {
        $file_name = $_FILES['srcCC']['name'];
        $tmp_file_name = $_FILES['srcCC']['tmp_name'];
        move_uploaded_file($tmp_file_name, 'image/' . $file_name);
    }


    $addData->bindParam("srcCC", $file_name);
    $addData->bindParam("classCC", $classCC);
    $addData->bindParam("yearC", $yearC);
    $addData->bindParam("carName", $carName);

    $addData->bindParam("carModel", $carModel);
    $addData->bindParam("price", $price);
    $addData->bindParam("mpg", $mpg);
    $addData->execute();

    print_r(json_encode(array("message" => "تم اضافة بيانات بنجاح")));
}
