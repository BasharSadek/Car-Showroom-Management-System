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



if (isset($_POST['feature']) && isset($_POST['article'])) {

    $feature = $_POST['feature'];
    $article = $_POST['article'];
    $classCF = $_POST['classCF'];
    //  $srcCF =$_POST['srcCF'];

    $id_car_Card = $_POST['id_car_Card'];

    $addData = $database->prepare("INSERT INTO car_features VALUES (NULL,:feature,:article,:classCF,:srcCF,:id_car_Card);");
    $addData->bindParam("feature", $feature);
    $addData->bindParam("article", $article);
    $addData->bindParam("classCF", $classCF);

    if (isset($_FILES['srcCF'])) {
        $file_name = $_FILES['srcCF']['name'];
        $tmp_file_name = $_FILES['srcCF']['tmp_name'];
        move_uploaded_file($tmp_file_name, 'image/' . $file_name);
    }


    $addData->bindParam("srcCF", $file_name);

    $addData->bindParam("id_car_Card", $id_car_Card);

    $addData->execute();

    print_r(json_encode(array("message" => "تم اضافة بيانات بنجاح")));
}
