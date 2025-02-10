<?php

require "../con_db.php";


$marka = isset($_POST['marka']) ? $_POST['marka'] : null;
$modelis = isset($_POST['modelis']) ? $_POST['modelis'] : null;
$binzina_tips = isset($_POST['benzina_tips']) ? $_POST['benzina_tips'] : null;
$atrumkarba = isset($_POST['atrumkarba']) ? $_POST['atrumkarba'] : null;
$virsbuve = isset($_POST['virsbuve']) ? $_POST['virsbuve'] : null;
$piezina = isset($_POST['piedzina']) ? $_POST['piedzina'] : null;
$tehniska_apskate = isset($_POST['tehniska_apskate']) ? $_POST['tehniska_apskate'] : null;
$krasa = isset($_POST['krasa']) ? $_POST['krasa'] : null;
$min_cena = $_POST['min_cena'] ? $_POST['min_cena'] : null;
$max_cena = $_POST['max_cena'] ? $_POST['max_cena'] : null;
$min_gads = $_POST['min_gads'] ? $_POST['min_gads'] : null;
$max_gads = $_POST['max_gads'] ? $_POST['max_gads'] : null;
$min_nobrakums = $_POST['min_nobrakums'] ? $_POST['min_nobrakums'] : null;
$max_nobraukums = $_POST['max_nobrakums'] ? $_POST['max_nobrakums'] : null;
$min_jauda = $_POST['min_jauda'] ? $_POST['min_jauda'] : null;
$max_jauda = $_POST['max_jauda'] ? $_POST['max_jauda'] : null;
$dtp = $_POST['dtp'] ? $_POST['dtp'] : null;
$jauda_m = $_POST['jauda_m'] ? $_POST['jauda_m'] : null;
$nobrakums_m = $_POST['nobrakums_m'] ? $_POST['nobrakums_m'] : null;




$filtrets = [];


if ($modelis) {

    $filtrets[] = "Modelis = '$modelis'";

}

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

if ($dtp) {

    if ($dtp == 1) {

        $filtrets[] = "dtp != 0";

    }else if($dtp == 2){

        $filtrets[] = "dtp = 0";
    
    }

}


if ($min_cena) {

    $filtrets[] = "Cena >= '$min_cena'";

}

if ($max_cena) {

    $filtrets[] = "Cena <= '$max_cena'";

}

if ($min_gads) {

    $filtrets[] = "Izladuma_gads >= '$min_gads'";

}

if ($max_gads) {

    $filtrets[] = "Izladuma_gads <= '$max_gads'";

}

if ($min_nobrakums) {

    $filtrets[] = "Nobrakums >= '$min_nobrakums'";

}

if ($max_nobraukums) {

    $filtrets[] = "Nobrakums <= '$max_nobraukums'";

}

if ($min_jauda) {

    $filtrets[] = "Jauda >= '$min_jauda'";

}

if ($max_jauda) {

    $filtrets[] = "Jauda <= '$max_jauda'";

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
            if($jauda_m == 2){

                $jauda_aprekin = round($Cars['Jauda'] * 1.34102);

                $jauda_izvade = $jauda_aprekin." HP";

            }else{
    
                $jauda_izvade = $Cars['Jauda']." KW";

            }
        }

        if($nobrakums_m == 2){

            $nobrakums_aprekin = round($Cars['Nobrakums'] * 0.621371);

            $nobraukums_izvade = $nobrakums_aprekin." MPH";

        }else{

            $nobraukums_izvade = $Cars['Nobrakums']." KM";

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

                            <p> Nobrakums: {$nobraukums_izvade}</p>

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