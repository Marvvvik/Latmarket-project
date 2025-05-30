<?php

require "con_db_transports.php";

$Cars_selct_SQl = "SELECT DISTINCT Marka FROM Cars";
$atlasa_car_select = mysqli_query($savienojums, $Cars_selct_SQl);
$Car_brendss = "";

    while($car_brends = mysqli_fetch_assoc($atlasa_car_select)) {

        $Car_brendss .= "<option value='{$car_brends['Marka']}'>{$car_brends['Marka']}</option>";

    }


$Cars_min_price = "SELECT MIN(Cena) AS min_cena FROM Cars";
$atlasa_car_min_price = mysqli_query($savienojums, $Cars_min_price);
$car_zem_cen = "";

if ($car_min_price = mysqli_fetch_assoc($atlasa_car_min_price)) {

    $car_zem_cen = $car_min_price['min_cena'];

}


$Cars_max_price = "SELECT MAX(Cena) AS max_cena FROM Cars";
$atlasa_car_max_price = mysqli_query($savienojums, $Cars_max_price);
$car_aug_cen = "";

if ($car_max_price = mysqli_fetch_assoc($atlasa_car_max_price)) {

    $car_aug_cen = $car_max_price['max_cena'];
    
}


$Cars_min_year = "SELECT MIN(Izladuma_gads) AS min_year FROM Cars";
$atlasa_car_min_year = mysqli_query($savienojums, $Cars_min_year);
$car_zem_gads = "";

if ($car_min_year = mysqli_fetch_assoc($atlasa_car_min_year)) {

    $car_zem_gads = $car_min_year['min_year'];

}

$Cars_max_year = "SELECT MAX(Izladuma_gads) AS max_year FROM Cars";
$atlasa_car_max_year = mysqli_query($savienojums, $Cars_max_year);
$car_aug_gads = "";

if ($car_max_year = mysqli_fetch_assoc($atlasa_car_max_year)) {

    $car_aug_gads = $car_max_year['max_year'];

}

$Cars_min_mileage = "SELECT MIN(Nobrakums) AS min_mileage FROM Cars";
$atlasa_car_min_mileage = mysqli_query($savienojums, $Cars_min_mileage);
$car_zem_mileage = "";

if ($car_min_mileage = mysqli_fetch_assoc($atlasa_car_min_mileage)) {

    $car_zem_mileage = $car_min_mileage['min_mileage'];

}

$Cars_max_mileage = "SELECT MAX(Nobrakums) AS max_mileage FROM Cars";
$atlasa_car_max_mileage = mysqli_query($savienojums, $Cars_max_mileage);
$car_aug_mileage = "";

if ($car_max_mileage = mysqli_fetch_assoc($atlasa_car_max_mileage)) {

    $car_aug_mileage = $car_max_mileage['max_mileage'];

}


$Cars_min_power = "SELECT MIN(Jauda) AS min_power FROM Cars";
$atlasa_car_min_power = mysqli_query($savienojums, $Cars_min_power);
$car_zem_power = "";

if ($car_min_power = mysqli_fetch_assoc($atlasa_car_min_power)) {

    $car_zem_power = $car_min_power['min_power'];

}

$Cars_max_power = "SELECT MAX(Jauda) AS max_power FROM Cars";
$atlasa_car_max_power = mysqli_query($savienojums, $Cars_max_power);
$car_aug_power = "";

if ($car_max_power = mysqli_fetch_assoc($atlasa_car_max_power)) {

    $car_aug_power = $car_max_power['max_power'];
    
}

?>


