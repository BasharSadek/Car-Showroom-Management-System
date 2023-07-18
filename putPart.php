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



if (isset($_POST['id_part']) && isset($_POST['partName'])) {
    $id = $_POST['id_part'];
    $name = $_POST['partName'];
    // $src = $_POST['srcPA'];

    $price = $_POST['price'];
    $class = $_POST['classPA'];

    $putData = $database->prepare("UPDATE part SET part.partName=:nam,part.srcPA=:src,part.price=:price,
    part.classPA=:class
    WHERE part.id_part=:id;");

    $putData->bindParam("id", $id);
    $putData->bindParam("nam", $name);

    if (isset($_FILES['srcPA'])) {
        $file_name = $_FILES['srcPA']['name'];
        $tmp_file_name = $_FILES['srcPA']['tmp_name'];
        move_uploaded_file($tmp_file_name, 'image/' . $file_name);
    }

    $putData->bindParam("src", $file_name);

    $putData->bindParam("price", $price);
    $putData->bindParam("class", $class);

    $putData->execute();

    print_r(json_encode(array("message" => "updated")));
} else {
    print_r(json_encode(array("message" => "error")));
}
