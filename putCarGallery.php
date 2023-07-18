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


if (isset($_POST['id_car_Gallery']) && isset($_POST['classCG'])) {
    $id = $_POST['id_car_Gallery'];
    $class = $_POST['classCG'];
    // $src = $_POST['srcCG'];



    $putData = $database->prepare("UPDATE car_gallery SET car_gallery.classCG=:class,car_gallery.srcCG=:src
    WHERE car_gallery.id_car_Gallery=:id;");

    $putData->bindParam("id", $id);
    $putData->bindParam("class", $class);

    if (isset($_FILES['srcCG'])) {
        $file_name = $_FILES['srcCG']['name'];
        $tmp_file_name = $_FILES['srcCG']['tmp_name'];
        move_uploaded_file($tmp_file_name, 'image/' . $file_name);
    }

    $putData->bindParam("src", $file_name);

    $putData->execute();

    print_r(json_encode(array("message" => "updated")));
} else {
    print_r(json_encode(array("message" => "error")));
}
