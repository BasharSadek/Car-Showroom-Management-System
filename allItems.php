<?php
include('header_api.php');
include('database.php');

$data = getFromData("SELECT order_tiem.id_order_tiem,order_tiem.id_order,order_tiem.exteriorcolorO,order_tiem.interiorcolorO,
order_tiem.quantity,order_tiem.PriceO,order_tiem.id_car_Card,order_tiem.id_part
FROM order_tiem");

$getData = $data->fetchAll(PDO::FETCH_ASSOC);
print_r(json_encode($getData));
