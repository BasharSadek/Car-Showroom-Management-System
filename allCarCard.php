<?php
include('header_api.php');
include('database.php');

$data = getFromData("SELECT car_card.id_car_Card,car_card.srcCC,car_card.classCC,car_card.yearC,
car_card.carName,car_card.carModel,car_card.price,car_card.mpg
FROM car_card");

$getData = $data->fetchAll(PDO::FETCH_ASSOC);
print_r(json_encode($getData));


?>