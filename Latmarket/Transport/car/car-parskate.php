<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LatMarket  || Car</title>
    <link rel="shortcut icon" href="../../image/Latmarket-logo-mini.png" type="image/png">
    <link rel="stylesheet" href="../../assets/style-main.css">
    <link rel="stylesheet" href="assets/style-apskate.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <script src="assets/filter-ajax.js" defer></script>
    <script src="assets/car-script.js" defer></script>
    <script src="../../assets/script-main.js" defer></script>
    <script src="../../assets/script-ajax.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


</head>
<body>

<?php

require "../../header.php";
require "../con_db_transports.php";
require "../con_db_lietotaji.php";

if(isset($_POST['carizvele'])){
    $car_ID = $_POST['carizvele']; 
    
    $atlasit_Car_SQL = "SELECT * FROM Cars WHERE Cars_ID = ?";
    $car_izvade = $savienojums->prepare($atlasit_Car_SQL);
    $car_izvade->bind_param("i", $car_ID);
    $car_izvade->execute();
    $CarResult = $car_izvade->get_result();
    $Car = $CarResult->fetch_assoc(); 

    $autoruSQL = "SELECT * FROM lietotaji WHERE lietotaji_id = ?";
    $car_autor = $savienojumsL->prepare($autoruSQL);
    $car_autor->bind_param("i", $Car['autora_id']);
    $car_autor->execute();
    $autorsResult = $car_autor->get_result();
    $autors = $autorsResult->fetch_assoc(); 

    
    $photosSQL = "SELECT photo FROM Cars_photos WHERE car_id = ?";
    $car_photo = $savienojums->prepare($photosSQL);
    $car_photo->bind_param("i", $car_ID);
    $car_photo->execute();
    $photosResult = $car_photo->get_result();

    $carfoto_id = 1;
    $photoHTML = ""; 
    while ($photo = $photosResult->fetch_assoc()) {
        $base64Image = base64_encode($photo['photo']);
        $photoHTML .= "<img src='data:image/jpeg;base64,{$base64Image}' alt='Car Photo'/>";
    }

    $photosSQL_2 = "SELECT photo FROM Cars_photos WHERE car_id = ? LIMIT 4";
    $stmt = $savienojums->prepare($photosSQL_2);
    $stmt->bind_param("i", $car_ID);
    $stmt->execute();
    $photosResult_2 = $stmt->get_result();

    $carfoto_id = 1;
    $photoHTML_2 = ""; 
    while ($photo = $photosResult_2->fetch_assoc()) {
        $base64Image = base64_encode($photo['photo']);
        $photoHTML_2 .= "<img src='data:image/jpeg;base64,{$base64Image}' alt='Car Photo'/>";
    }

    
    $tehniska_apskate_izvade = ($Car['Tehniska_apskate'] == 0) ? "Nav" : $Car['Tehniska_apskate'];
    
    
    $jauda_izvade = ($Car['Jauda'] == 0) ? "-" : $Car['Jauda']." KW";



}
?>

<section id="apskate"> 

    <div class="Car_foto_a">

        <div class="slidersbox">

            <div class="sliders">

                <div class="slide-show">

                    <?php echo $photoHTML;?>

                </div>

                <div class="mini-slider">

                    <?php echo $photoHTML_2;?>

                </div>

            </div>

        </div>

        <div class="ator-info">

            <div class="autrobox">

                <div class="autor-name-phone">
                    <h1><?php echo $autors['vards']." ".$autors['uzvards'];?></h1>

                    <p><?php echo $autors['telefons'];?></p>
                </div>

                <div class="autor-avatar">


        
                </div>

            </div>

        </div>

    </div>

    <div class="car_info_a">

        <div class="info-table">

            <div class='table-block'>

                <img src='../../image/icons/Car-icon.png'>

                <p> Marka: <span class="apskateSpan"><?php echo $Car['Marka']?></span></p>

            </div>

            <div class='table-block'>

                <img src='../../image/icons/Car-icon.png'>

                <p> Modelis: <span class="apskateSpan"><?php echo $Car['Modelis']?></span></p>

            </div>

            <div class='table-block'>

                <img src='../../image/icons/calendar-icon.png'>

                <p>Gads: <span class="apskateSpan"><?php echo $Car['Izladuma_gads']?></span></p>

            </div>

            <div class='table-block'>

                <img src='../../image/icons/Virsbuves-icon.png'>

                <p> Virsbūves tips: <span class="apskateSpan"><?php echo $Car['Virsbuves_tips']?></span></p>

            </div>

            <div class='table-block'>

                <img src='../../image/icons/car-engine-icon.png'>

                <p> Tilpums: <span class="apskateSpan"><?php echo number_format($Car['Dzinejs'], 1)?></span></p>

            </div>

            <div class='table-block'>

                <img src='../../image/icons/Jauda-icon.png'>

                <p> Jauda: <span class="apskateSpan"><?php echo $jauda_izvade?></span></p>

            </div>

            <div class='table-block'>

                <img src='../../image/icons/AKKP-icon.png'>

                <p> Ātrumkārba: <span class="apskateSpan"><?php echo $Car['Atrumkarba_tips']?></span></p>

            </div>

            <div class='table-block'>

                <img src='../../image/icons/Oil-icon.png'>

                <p> Degviela: <span class="apskateSpan"><?php echo $Car['Bezina_tips']?></span></p>

            </div>

            <div class='table-block'>

                <img src='../../image/icons/Piedzinas-icon.png'>

                <p> Piedziņa: <span class="apskateSpan"><?php echo $Car['Piedzina']?></span></p>

            </div>

            <div class='table-block'>

                <img src='../../image/icons/Odometr-icon.png'>

                <p> Nobrakums: <span class="apskateSpan"><?php echo $Car['Nobrakums']?> KM</span></p>

            </div>

            <div class='table-block'>

                <img src='../../image/icons/Krasas-icon.png'>

                <p> Krāsa: <span class="apskateSpan"><?php echo $Car['Krasa']?></span></p>

            </div>

            <div class='table-block'>

                <img src='../../image/icons/calendar-icon.png'>

                <p> Tehniskā apskate: <span class="apskateSpan"><?php echo $tehniska_apskate_izvade?></span></p>

            </div>

        </div>

    </div>

    <div class="car_apraksts_a">

        <?php echo $Car['Apraksts']?>

    </div>

</section>

<?php require "../../footer.php"; ?>