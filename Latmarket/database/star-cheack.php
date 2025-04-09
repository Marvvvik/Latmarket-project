<?php

require "../con_db_l.php";

session_start();


$CarSQL = "SELECT * FROM Cars";
$stmt = $savienojums->prepare($CarSQL);
$stmt->execute();
$carResult = $stmt->get_result();

while ($Car = $carResult->fetch_assoc()) {

    $favoritSQL = "SELECT * FROM favoriti WHERE lietotaja_id = ?";
    $stmt = $savienojums->prepare($favoritSQL);
    $stmt->bind_param("i", $_SESSION['IdHOMIK']);
    $stmt->execute();
    $favoritResult = $stmt->get_result();

    $starResult = "";

    while ($favorit = $favoritResult->fetch_assoc()) {


        if($favorit['table_name'] === "Cars" && $favorit['item_id'] == $Car['Cars_ID']){

            $starResult = "<i class='fa fa-star fav'></i>";

        }else{

            $starResult = "<i class='far fa-star fav'></i>";

        }

    }


}


?>