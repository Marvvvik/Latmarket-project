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
require "car-parskate-izvade.php";

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

                    <img src="<?php echo $autor_foto;?>" alt="">
        
                </div>

            </div>

            <div class="skat-info">

                <p>Skatijumi: <?php echo $Car['Skatijumi'];?></p>

                <p>Datums: <?php echo date('Y-m-d', strtotime($Car['datums'])); ?></p>

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