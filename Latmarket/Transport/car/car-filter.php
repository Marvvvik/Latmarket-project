<?php

require "../con_db.php";

$Cars_selct_SQl = "SELECT DISTINCT Marka FROM Cars";

$atlasa_car_select = mysqli_query($savienojums, $Cars_selct_SQl);

$Car_brendss = "";

    while($car_brends = mysqli_fetch_assoc($atlasa_car_select)) {

        $Car_brendss .= "<label><input type='radio' name='marka' value='{$car_brends['Marka']}'><span>{$car_brends['Marka']}</span></lable>";

    }

?>
