<?php
include('header_api.php');
include('database.php');

$data = getFromData("SELECT part.id_part,part.partName,part.srcPA,part.price,part.classPA,
part.id_car_Card FROM part");

$getData = $data->fetchAll(PDO::FETCH_ASSOC);
print_r(json_encode($getData));


?>