<?php
include('header_api.php');
include('database.php');

$id = $_GET['id'];

$data = getFromData("SELECT part.id_part,part.partName,part.srcPA,part.price,part.classPA,
part.id_car_Card FROM part
WHERE part.id_part='$id'");

$getData = $data->fetchAll(PDO::FETCH_ASSOC);
print_r(json_encode($getData));
