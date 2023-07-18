<?php
include('header_api.php');
include('database.php');

$data = getFromData("SELECT messages.id_messages,messages.messageDate,messages.text_messages,
messages.id_dealer,messages.id_client FROM messages");

$getData = $data->fetchAll(PDO::FETCH_ASSOC);
print_r(json_encode($getData));


?>