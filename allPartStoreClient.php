<?php
include('header_api.php');
include('database.php');

$data = getFromData("SELECT part.id_part,part.partName,part.srcPA,part.price,part.classPA,
part.id_car_Card,useraccount.id_userAccount,
store_part.id_store_part,store_part.priceSP,store_part.quantitySP,store_part.id_userAccount
FROM part JOIN store_part ON store_part.id_part=part.id_part
JOIN useraccount ON useraccount.id_userAccount=store_part.id_userAccount
WHERE useraccount.type=2");

$getData = $data->fetchAll(PDO::FETCH_ASSOC);
print_r(json_encode($getData));


?>