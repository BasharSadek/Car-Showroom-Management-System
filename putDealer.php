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

if (isset($_POST['id_userAccount']) && isset($_POST['firstName'])) {

    $id = $_POST['id_userAccount'];
    $fname = $_POST['firstName'];
    $lname = $_POST['lastName'];
    $email = $_POST['Email'];

    $pass = $_POST['passWordU'];
    $city = $_POST['city'];
    $address = $_POST['Addressu'];
    $phone = $_POST['phone'];
    //$img = $_POST['dealerImg'];

    $cogs = $_POST['COGS'];
    $oe = $_POST['OE'];
    $o = $_POST['O'];
    $taxes = $_POST['TAXES'];
    
    $putData = $database->prepare("UPDATE useraccount SET useraccount.firstName=:fname,useraccount.lastName=:lname,useraccount.Email=:email,
    useraccount.passWordU=:pass,useraccount.city=:city,useraccount.Addressu=:addres,
    useraccount.phone=:phone,useraccount.dealerImg=:img,
    useraccount.COGS=:cogs,useraccount.OE=:oe,useraccount.O=:o,useraccount.TAXES=:tax
    WHERE useraccount.id_userAccount=:id AND useraccount.type=1");

    $putData->bindParam("id", $id);
    $putData->bindParam("fname", $fname);
    $putData->bindParam("lname", $lname);
    $putData->bindParam("email", $email);

    $putData->bindParam("pass", $pass);
    $putData->bindParam("city", $city);
    $putData->bindParam("addres", $address);
    $putData->bindParam("phone", $phone);

    if (isset($_FILES['dealerImg'])) {
        $file_name = $_FILES['dealerImg']['name'];
        $tmp_file_name = $_FILES['dealerImg']['tmp_name'];
        move_uploaded_file($tmp_file_name, 'image/' . $file_name);
    }

    $putData->bindParam("img", $file_name);

    $putData->bindParam("cogs", $cogs);
    $putData->bindParam("oe", $oe);
    $putData->bindParam("o", $o);
    $putData->bindParam("tax", $taxes);

    $putData->execute();

    print_r(json_encode(array("message" => "updated")));
} else {
    print_r(json_encode(array("message" => "error")));
}
