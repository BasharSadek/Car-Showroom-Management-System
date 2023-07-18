<?php
include('header_api.php');
include('database.php');

$data = getFromData("SELECT useraccount.id_userAccount,useraccount.firstName,useraccount.lastName,useraccount.Email,useraccount.passWordU,
useraccount.city,useraccount.Addressu,useraccount.phone,useraccount.dealerImg,useraccount.COGS,
useraccount.OE,useraccount.O,useraccount.TAXES
FROM useraccount WHERE useraccount.type=1");

$getData = $data->fetchAll(PDO::FETCH_ASSOC);
print_r(json_encode($getData));


?>