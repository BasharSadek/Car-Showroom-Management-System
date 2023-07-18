<?php
include('header_api.php');
include('database.php');

$data = getFromData("SELECT orderu.id_order,orderu.orderTime,orderu.deliverTime,orderu.id_dealer,orderu.id_user,
orderu.orderType,orderu.orderProcess,orderu.delivery,orderu.totalPrice
FROM orderu");

$getData = $data->fetchAll(PDO::FETCH_ASSOC);
print_r(json_encode($getData));


?>