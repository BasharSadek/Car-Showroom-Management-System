<?php
include('header_api.php');
include('database.php');

$id = $_GET['id'];

$data = getFromData("SELECT car_card.id_car_Card,car_card.srcCC,car_card.classCC,car_card.yearC,
car_card.carName,car_card.carModel,car_card.price,car_card.mpg,useraccount.id_userAccount,
store_car.id_store_car,store_car.priceSC,store_car.quantitySC
FROM car_card JOIN store_car ON car_card.id_car_Card=store_car.id_car_Card
JOIN useraccount ON useraccount.id_userAccount=store_car.id_userAccount
WHERE useraccount.type=1
AND store_car.id_store_car='$id'");

$getData = $data->fetchAll(PDO::FETCH_ASSOC);
print_r(json_encode($getData));
