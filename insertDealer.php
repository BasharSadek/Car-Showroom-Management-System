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


if (isset($_POST['firstName']) && isset($_POST['lastName'])) {

  $firstName = $_POST['firstName'];
  $lastName =  $_POST['lastName'];
  $Email =  $_POST['Email'];
  $passWordU =  $_POST['passWordU'];

  $city =  $_POST['city'];
  $Addressu = $_POST['Addressu'];
  $phone = $_POST['phone'];
  //$dealerImg =  $_POST['dealerImg'];

  $COGS =  $_POST['COGS'];
  $OE = $_POST['OE'];
  $O =  $_POST['O'];
  $TAXES =  $_POST['TAXES'];

  $addData = $database->prepare("INSERT INTO useraccount VALUES (NULL,:firstName,:lastName,:Email,:passWordU,
    :city,:Addressu,:phone,:dealerImg,:COGS,:OE,:O,:TAXES,1);");
  $addData->bindParam("firstName", $firstName);
  $addData->bindParam("lastName", $lastName);
  $addData->bindParam("Email", $Email);
  $addData->bindParam("passWordU", $password);

  $addData->bindParam("city", $city);
  $addData->bindParam("Addressu", $Addressu);
  $addData->bindParam("phone", $phone);


  $addData->bindParam("COGS", $COGS);
  $addData->bindParam("OE", $OE);
  $addData->bindParam("O", $O);
  $addData->bindParam("TAXES", $TAXES);

  if (isset($_FILES['dealerImg'])) {
    $file_name = $_FILES['dealerImg']['name'];
    $tmp_file_name = $_FILES['dealerImg']['tmp_name'];
    move_uploaded_file($tmp_file_name, 'image/' . $file_name);
  }
  $addData->bindParam("dealerImg", $file_name);
  $addData->execute();

  print_r(json_encode(array("message" => ' done successfully')));
}
