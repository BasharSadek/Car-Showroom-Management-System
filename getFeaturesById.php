<?php
include('header_api.php');
include('database.php');

$id = $_GET['id'];

$data = getFromData("SELECT car_features.id_Car_Features,car_features.feature,car_features.article,car_features.srcCF,
car_features.classCF,car_features.id_car_Card FROM car_features
WHERE car_features.id_Car_Features='$id'");

$getData = $data->fetchAll(PDO::FETCH_ASSOC);
print_r(json_encode($getData));
