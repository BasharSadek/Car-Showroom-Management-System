<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: multipart/form-data; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PUT");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");


$username = "root";
$password = "";
$database = new PDO("mysql:host=localhost; dbname=csms;", $username, $password);
$database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//$data = json_decode(file_POST_contents("php://input"));


if (isset($_POST['id_car_Card']) && isset($_POST['classCC'])) {
    $id = $_POST['id_car_Card'];
    // $src = $_POST['srcCC'];
    $class = $_POST['classCC'];
    $year = $_POST['yearC'];

    $name = $_POST['carName'];
    $model = $_POST['carModel'];
    $price = $_POST['price'];
    $mpg = $_POST['mpg'];


    $putData = $database->prepare("UPDATE car_card SET car_card.srcCC=:src, car_card.classCC=:class,car_card.yearC=:yea,
    car_card.carName=:nam,car_card.carModel=:model,car_card.price=:price,car_card.mpg=:mpg
    WHERE car_card.id_car_Card=:id;");

    $putData->bindParam("id", $id);

    if (isset($_FILES['srcCC'])) {
        $file_name = $_FILES['srcCC']['name'];
        $tmp_file_name = $_FILES['srcCC']['tmp_name'];
        move_uploaded_file($tmp_file_name, 'image/' . $file_name);
    }


    $putData->bindParam("src", $file_name);
    $putData->bindParam("class", $class);
    $putData->bindParam("yea", $year);

    $putData->bindParam("nam", $name);
    $putData->bindParam("model", $model);
    $putData->bindParam("price", $price);
    $putData->bindParam("mpg", $mpg);

    $putData->execute();

    print_r(json_encode(array("message" => "updated")));
} else {
    print_r(json_encode(array("message" => "error")));
}
