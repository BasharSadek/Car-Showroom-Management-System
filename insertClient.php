<?php
include('header_api.php');
$username = "root";
$password = "";
$database = new PDO("mysql:host=localhost; dbname=csms;", $username, $password);
$database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


$data = json_decode(file_get_contents("php://input"));


if (isset($data->firstName) && isset($data->lastName)) {
    $firstName = $data->firstName;
    $lastName = $data->lastName;
    $Email = $data->Email;
    $passWordU = $data->passWordU;

    $city = $data->city;
    $Addressu = $data->Addressu;
    $phone = $data->phone;
    $addData = $database->prepare("INSERT INTO useraccount VALUES (NULL,:firstName,:lastName,:Email,:passWordU,
    :city,:Addressu,:phone,NULL,NULL,NULL,NULL,NULL,2);");
    $addData->bindParam("firstName", $firstName);
    $addData->bindParam("lastName", $lastName);
    $addData->bindParam("Email", $Email);
    $addData->bindParam("passWordU", $passWordU);

    $addData->bindParam("city", $city);
    $addData->bindParam("Addressu", $Addressu);
    $addData->bindParam("phone", $phone);

    $addData->execute();

    print_r(json_encode(array("message" => "تم اضافة بيانات بنجاح")));
}


?>