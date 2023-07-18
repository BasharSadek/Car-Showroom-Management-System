<?php
include('header_api.php');

$username = "root";
$password = "";
$database = new PDO("mysql:host=localhost; dbname=csms;", $username, $password);
$database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$data = json_decode(file_get_contents("php://input"));




if (isset($data->id_userAccount) && isset($data->firstName)) {
    $id = $data->id_userAccount;
    $fname = $data->firstName;
    $lname = $data->lastName;
    $email = $data->Email;
    
    $pass = $data->passWordU;
    $city = $data->city;
    $address = $data->Addressu;
    $phone = $data->phone;
    
    $putData = $database->prepare("UPDATE useraccount SET useraccount.firstName=:fname,useraccount.lastName=:lname,useraccount.Email=:email,
    useraccount.passWordU=:pass,useraccount.city=:city,useraccount.Addressu=:addres,
    useraccount.phone=:phone
    WHERE useraccount.id_userAccount=:id AND useraccount.type=2");

    $putData->bindParam("id", $id);
    $putData->bindParam("fname", $fname);
    $putData->bindParam("lname", $lname);
    $putData->bindParam("email", $email);

    $putData->bindParam("pass", $pass);
    $putData->bindParam("city", $city);
    $putData->bindParam("addres", $address);
    $putData->bindParam("phone", $phone);
    
    
    $putData->execute();
    print_r(json_encode(array("message" => "updated")));
} else {
    print_r(json_encode(array("message" => "error")));
}


?>