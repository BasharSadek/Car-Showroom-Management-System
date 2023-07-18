<?php
include('header_api.php');
include('database.php');

$data = getFromData("SELECT car_card.id_car_Card,car_card.srcCC,car_card.classCC,car_card.yearC,
car_card.carName,car_card.carModel,car_card.price,car_card.mpg,car_features.id_Car_Features,
car_features.feature,car_features.article,car_features.srcCF,
car_features.classCF,car_gallery.id_car_Gallery,car_gallery.srcCG,
car_gallery.classCG,car_specs.id_car_Specs,car_specs.main_src,car_specs.EPA_Est_MPG,
car_specs.EngineType,car_specs.DriveTRAIN,car_specs.TOWING,
car_specs.TECHNOLOGY,car_specs.MileageEstimates,car_specs.UnloadedHeight,
car_specs.OverallWidth,car_specs.Fuel_tank,
color.id_color,color.exteriorcolor,color.interiorcolor,
color.srcCO
FROM car_card JOIN car_gallery ON car_card.id_car_Card=car_gallery.id_car_Card
JOIN car_features ON car_features.id_car_Card=car_card.id_car_Card
JOIN car_specs ON car_specs.id_car_Card=car_card.id_car_Card
JOIN  color ON color.id_car_Card=car_card.id_car_Card");

$getData = $data->fetchAll(PDO::FETCH_ASSOC);
print_r(json_encode($getData));


?>