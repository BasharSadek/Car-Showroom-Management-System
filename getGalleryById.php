<?php
include('header_api.php');
include('database.php');

$id= $_GET['id'];

$data = getFromData("SELECT car_gallery.id_car_Gallery,car_gallery.srcCG,car_gallery.classCG,car_gallery.id_car_Card
FROM car_gallery
WHERE car_gallery.id_car_Gallery='$id'");

$getData = $data->fetchAll(PDO::FETCH_ASSOC);
print_r(json_encode($getData));
