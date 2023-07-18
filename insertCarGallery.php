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

if (isset($_POST['classCG']) && isset($_POST['id_car_Card'])) {

    $classCG = $_POST['classCG'];
    //  $srcCG =$_POST['srcCG'];
    $id_car_Card = $_POST['id_car_Card'];

    $addData = $database->prepare("INSERT INTO car_gallery VALUES(NULL,:classCG,:srcCG,:id_car_Card);");

    $addData->bindParam("classCG", $classCG);

    if (isset($_FILES['srcCG'])) {
        $file_name = $_FILES['srcCG']['name'];
        $tmp_file_name = $_FILES['srcCG']['tmp_name'];
        move_uploaded_file($tmp_file_name, 'image/' . $file_name);
    }

    $addData->bindParam("srcCG", $file_name);
    $addData->bindParam("id_car_Card", $id_car_Card);


    $addData->execute();

    print_r(json_encode(array("message" => "تم اضافة بيانات بنجاح")));
}
