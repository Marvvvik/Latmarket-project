<?php

require "con_db_l.php";
session_start();


$atsaukmesSQL = "SELECT * FROM Atsauksmes ORDER BY datums DESC";
$stmt = $savienojums->prepare($atsaukmesSQL);
$stmt->execute();
$atsakmesResult = $stmt->get_result();

while ($atsakmes = $atsakmesResult->fetch_assoc()) {

    $stars = $atsakmes['stars'];

    $starsHTML = '';
    for ($i = 1; $i <= 5; $i++) {
        $activeClass = $i <= $stars ? 'active' : '';
        $starsHTML .= "<i class='fas fa-star $activeClass'></i>";
    }

    $datums = date('Y-m-d', strtotime($atsakmes['datums']));

    echo "
    
    <div class='box'>

        <div class='at-info'>
            <div class='av-name-st'>
                <div class='avatar'>
                

                </div>

                <div class='name-star'><h1>{$atsakmes['vards']} {$atsakmes['uzvards']}</h1><div class='stars-at'>$starsHTML</div></div>
            </div>

            <div class='time'>

                <p>$datums</p>

            </div>

        </div>

        <div class='at-text'><p>{$atsakmes['at_text']}</p></div>

    </div>";
    
}

?>
