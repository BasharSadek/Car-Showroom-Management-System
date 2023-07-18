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



if (isset($_POST['id_Car_Features']) && isset($_POST['feature'])) {
    $id = $_POST['id_Car_Features'];
    $feature = $_POST['feature'];
    $article = $_POST['article'];

    $class = $_POST['classCF'];
    //$src = $_POST['srcCF'];


    $putData = $database->prepare("UPDATE car_features SET car_features.feature=:feature,car_features.article=:article,
    car_features.classCF=:class,car_features.srcCF=:src
    WHERE car_features.id_Car_Features=:id;");

    $putData->bindParam("id", $id);
    $putData->bindParam("feature", $feature);
    $putData->bindParam("article", $article);

    $putData->bindParam("class", $class);

    if (isset($_FILES['srcCF'])) {
        $file_name = $_FILES['srcCF']['name'];
        $tmp_file_name = $_FILES['srcCF']['tmp_name'];
        move_uploaded_file($tmp_file_name, 'image/' . $file_name);
    }

    $putData->bindParam("src", $file_name);

    $putData->execute();



    print_r(json_encode(array("message" => "updated")));
} else {
    print_r(json_encode(array("message" => "error")));
}
