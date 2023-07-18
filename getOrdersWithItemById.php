<?php
include('header_api.php');
include('database.php');

$id=$_GET['id'];

$data = getFromData("SELECT orderu.id_order,orderu.orderTime,orderu.deliverTime,orderu.id_dealer,orderu.id_user,
orderu.orderType,orderu.orderProcess,orderu.delivery,orderu.totalPrice,
order_tiem.id_order_tiem,order_tiem.exteriorcolorO,order_tiem.interiorcolorO,
order_tiem.quantity,order_tiem.PriceO,order_tiem.id_car_Card,
order_tiem.id_part
FROM orderu JOIN order_tiem ON order_tiem.id_order=orderu.id_order
WHERE orderu.id_order='$id'");

$getData = $data->fetchAll(PDO::FETCH_ASSOC);
print_r(json_encode($getData));
