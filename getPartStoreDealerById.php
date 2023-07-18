<?php
include('header_api.php');
include('database.php');

$id = $_GET['id'];

$data = getFromData("SELECT part.id_part,part.partName,part.srcPA,part.price,part.classPA,
part.id_car_Card,useraccount.id_userAccount
FROM part JOIN store_part ON store_part.id_part=part.id_part
JOIN useraccount ON useraccount.id_userAccount=store_part.id_userAccount
WHERE useraccount.type=1
AND store_part.id_store_part='$id'");

$getData = $data->fetchAll(PDO::FETCH_ASSOC);
print_r(json_encode($getData));
