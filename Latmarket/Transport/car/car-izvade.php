<?php

require "../con_db.php";


$marka = isset($_POST['marka']) ? $_POST['marka'] : null;
$binzina_tips = isset($_POST['benzina_tips']) ? $_POST['benzina_tips'] : null;
$atrumkarba = isset($_POST['atrumkarba']) ? $_POST['atrumkarba'] : null;
$virsbuve = isset($_POST['virsbuve']) ? $_POST['virsbuve'] : null;
$piezina = isset($_POST['piedzina']) ? $_POST['piedzina'] : null;
$tehniska_apskate = isset($_POST['tehniska_apskate']) ? $_POST['tehniska_apskate'] : null;
$krasa = isset($_POST['krasa']) ? $_POST['krasa'] : null;
$min_cena = $_POST['min_cena'] ? $_POST['min_cena'] : null;
$max_cena = $_POST['max_cena'] ? $_POST['max_cena'] : null;


$filtrets = [];


if ($marka) {

    $filtrets[] = "Marka = '$marka'";

}

if ($binzina_tips) {

    $filtrets[] = "Bezina_tips = '$binzina_tips'";

}

if ($atrumkarba) {

    $filtrets[] = "Atrumkarba_tips = '$atrumkarba'";

}

if ($virsbuve) {

    $filtrets[] = "Virsbuves_tips = '$virsbuve'";

}

if ($piezina) {

    $filtrets[] = "Piedzina = '$piezina'";

}

if ($krasa) {

    $filtrets[] = "Krasa = '$krasa'";

}

if ($tehniska_apskate) {

    if ($tehniska_apskate == 1) {

        $filtrets[] = "Tehniska_apskate != 0";

    }else if($tehniska_apskate == 2){

        $filtrets[] = "Tehniska_apskate = 0";
        
    }

}


if ($min_cena) {

    $filtrets[] = "Cena >= '$min_cena'";

}

if ($max_cena) {

    $filtrets[] = "Cena <= '$max_cena'";

}


if (count($filtrets) > 0) {

    $filterizvele = "WHERE " . implode(' AND ', $filtrets);

} else {

    $filterizvele = "";

}

$CarsSQl = "SELECT * FROM Cars $filterizvele";

$jauda_izvade = "";

$Atlasa_cars = mysqli_query($savienojums, $CarsSQl);

    while ($Cars = mysqli_fetch_assoc($Atlasa_cars)) {

        $formattedDzinejs = number_format($Cars['Dzinejs'], 1);
        $formtedCema = number_format($Cars['Cena'], 0, '', ' ').' €';

        if ($Cars['Jauda'] == 0) {

            $jauda_izvade = "-";
    
        } else {
    
            $jauda_izvade = $Cars['Jauda']." KW";
    
        }

        echo "
        <div class='carsbox'>

            <a href='car-parskate.php' class='cblink'></a>

            <div class='car-foto'>

                <img src='{$Cars['Foto_URL']}'>

            </div>

            <div class='carinfo'>

                <div class='carNosFlex'>

                    <div class='carNosakums'>

                        <h3>{$Cars['Marka']} {$Cars['Modelis']}</h3>

                        <p>{$Cars['Izladuma_gads']}</p>

                    </div>

                    <div class='carCena'>

                        <p>{$formtedCema}</p>

                    </div>

                </div>

                <div class='infotable'>

                    <div class='colon1'>

                        <div class='info-icon'>
                        
                            <img src='../../image/icons/car-engine-icon.png'>

                            <p> Tilpums: {$formattedDzinejs}</p>

                        </div>

                        <div class='info-icon'>
                        
                            <img src='../../image/icons/Odometr-icon.png'>

                            <p> Nobrakums: {$Cars['Nobrakums']} KM</p>

                        </div>

                        <div class='info-icon'>
                        
                            <img src='../../image/icons/Piedzinas-icon.png'>

                            <p> Piedziņa: {$Cars['Piedzina']}</p>

                        </div>

                        <div class='info-icon'>
                        
                            <img src='../../image/icons/Jauda-icon.png'>

                            <p> Jauda: {$jauda_izvade}</p>

                        </div>

                    </div>

                    <div class='colon2'>


                        <div class='info-icon'>
                        
                            <img src='../../image/icons/AKKP-icon.png'>

                            <p> Atrumkārba: {$Cars['Atrumkarba_tips']}</p>

                        </div>

                        <div class='info-icon'>
                        
                            <img src='../../image/icons/Oil-icon.png'>

                            <p> Degviela: {$Cars['Bezina_tips']}</p>

                        </div>

                        <div class='info-icon'>
                        
                            <img src='../../image/icons/Krasas-icon.png'>

                            <p> Krāsa: {$Cars['Krasa']}</p>

                        </div>

                        <div class='info-icon'>
                        
                            <img src='../../image/icons/Virsbuves-icon.png'>

                            <p> Virsbūves tips: {$Cars['Virsbuves_tips']}</p>

                        </div>

                    </div>

                </div>

            </div>

        </div>";

    }
?>