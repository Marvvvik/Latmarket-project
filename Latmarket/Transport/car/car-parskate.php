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

        <div class="slide-show">

            <?php echo $photoHTML;?>

            <div class="slide-btn left"><i class="fas fa-angle-left"></i></div>
            <div class="slide-btn right"><i class="fas fa-angle-right"></i></div>

        </div>

        <div class="slide-show-rewiev">

            <i class="fas fa-close close-Modal" id="closeSlider"></i>
                
            <div class="slider-main">
                <?php echo $photoHTML;?>
            </div>

            <div class="slide-btn main left"><i class="fas fa-angle-left"></i></div>
            <div class="slide-btn main right"><i class="fas fa-angle-right"></i></div>
        </div>

        <div class="ator-info">

            <div class="autrobox">

                <div class="autor-name-phone">
                    <h1><?php echo $Izvade_vards." ".$Izvade_Uzvards;?></h1>

                    <?php echo $chatBtn;?>
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

    <div class="komplektacijas_section">

        <div class="box">

            <div class="komplektacijas-Title">

                <h1>Komforts un salons</h1>

            </div>
            <p id="feature-1" class="<?= in_array(1, $active_ids) ? 'active' : '' ?>">Ādas salons</p>
            <p id="feature-2" class="<?= in_array(2, $active_ids) ? 'active' : '' ?>">Auduma salons</p>
            <p id="feature-3" class="<?= in_array(3, $active_ids) ? 'active' : '' ?>">Alcantara apdare</p>
            <p id="feature-4" class="<?= in_array(4, $active_ids) ? 'active' : '' ?>">Elektriski regulējami sēdekļi</p>
            <p id="feature-5" class="<?= in_array(5, $active_ids) ? 'active' : '' ?>">Sēdekļu atmiņas funkcija</p>
            <p id="feature-6" class="<?= in_array(6, $active_ids) ? 'active' : '' ?>">Priekšējo sēdekļu apsilde</p>
            <p id="feature-7" class="<?= in_array(7, $active_ids) ? 'active' : '' ?>">Aizmugurējo sēdekļu apsilde</p>
            <p id="feature-8" class="<?= in_array(8, $active_ids) ? 'active' : '' ?>">Sēdekļu ventilācija</p>
            <p id="feature-9" class="<?= in_array(9, $active_ids) ? 'active' : '' ?>">Sēdekļu masāža</p>
            <p id="feature-10" class="<?= in_array(10, $active_ids) ? 'active' : '' ?>">Multikontūru sēdekļi</p>
            <p id="feature-11" class="<?= in_array(11, $active_ids) ? 'active' : '' ?>">Koka apdare salonā</p>
            <p id="feature-12" class="<?= in_array(12, $active_ids) ? 'active' : '' ?>">Stūres regulēšana</p>
            <p id="feature-13" class="<?= in_array(13, $active_ids) ? 'active' : '' ?>">Stūres apsilde</p>
            <p id="feature-14" class="<?= in_array(14, $active_ids) ? 'active' : '' ?>">Multifunkcionāla stūre</p>
            <p id="feature-15" class="<?= in_array(15, $active_ids) ? 'active' : '' ?>">Kruīza kontrole</p>
            <p id="feature-16" class="<?= in_array(16, $active_ids) ? 'active' : '' ?>">Adaptīvā kruīza kontrole</p>
            <p id="feature-17" class="<?= in_array(17, $active_ids) ? 'active' : '' ?>">Klimata kontrole</p>
            <p id="feature-18" class="<?= in_array(18, $active_ids) ? 'active' : '' ?>">Gaisa kondicionieris</p>
            <p id="feature-19" class="<?= in_array(19, $active_ids) ? 'active' : '' ?>">Vējstikla apsilde</p>
            <p id="feature-20" class="<?= in_array(20, $active_ids) ? 'active' : '' ?>">Apsildāmi spoguļi</p>
            <p id="feature-21" class="<?= in_array(21, $active_ids) ? 'active' : '' ?>">Elektriskie logu pacēlāji</p>
            <p id="feature-22" class="<?= in_array(22, $active_ids) ? 'active' : '' ?>">Elektriski regulējami spoguļi</p>
            <p id="feature-23" class="<?= in_array(23, $active_ids) ? 'active' : '' ?>">Spoguļi ar automātisko aptumšošanos</p>
            <p id="feature-24" class="<?= in_array(24, $active_ids) ? 'active' : '' ?>">Elektriska bagāžnieka atvēršana</p>
            <p id="feature-25" class="<?= in_array(25, $active_ids) ? 'active' : '' ?>">Lūka</p>
            <p id="feature-26" class="<?= in_array(26, $active_ids) ? 'active' : '' ?>">Saulessargi aizmugurējiem logiem</p>
            <p id="feature-27" class="<?= in_array(27, $active_ids) ? 'active' : '' ?>">Ambient apgaismojums salonā</p>

        </div>

        <div class="box">

            <div class="komplektacijas-Title">
                
                <h1>Multivide un navigācija</h1>

            </div>
            <p id="feature-28" class="<?= in_array(28, $active_ids) ? 'active' : '' ?>">Audio sistēma</p>
            <p id="feature-29" class="<?= in_array(29, $active_ids) ? 'active' : '' ?>">CD / MP3 atskaņotājs</p>
            <p id="feature-30" class="<?= in_array(30, $active_ids) ? 'active' : '' ?>">Bluetooth</p>
            <p id="feature-31" class="<?= in_array(31, $active_ids) ? 'active' : '' ?>">AUX pieslēgums</p>
            <p id="feature-32" class="<?= in_array(32, $active_ids) ? 'active' : '' ?>">USB pieslēgums</p>
            <p id="feature-33" class="<?= in_array(33, $active_ids) ? 'active' : '' ?>">Navigācijas sistēma</p>
            <p id="feature-34" class="<?= in_array(34, $active_ids) ? 'active' : '' ?>">Skārienjutīgs ekrāns</p>
            <p id="feature-35" class="<?= in_array(35, $active_ids) ? 'active' : '' ?>">Android Auto / Apple CarPlay</p>
            <p id="feature-36" class="<?= in_array(36, $active_ids) ? 'active' : '' ?>">TV uztvērējs</p>
            <p id="feature-37" class="<?= in_array(37, $active_ids) ? 'active' : '' ?>">Multivide aizmugurējiem pasažieriem</p>
            <p id="feature-38" class="<?= in_array(38, $active_ids) ? 'active' : '' ?>">Atpakaļskata kamera</p>
            <p id="feature-39" class="<?= in_array(39, $active_ids) ? 'active' : '' ?>">360° skata kameras</p>
            <p id="feature-40" class="<?= in_array(40, $active_ids) ? 'active' : '' ?>">Projekcija uz vējstikla</p>
            <p id="feature-41" class="<?= in_array(41, $active_ids) ? 'active' : '' ?>">Iebūvēta sakaru sistēma</p>

        </div>

        <div class="box">

            <div class="komplektacijas-Title">
                
                <h1>Drošība</h1>

            </div>
            <p id="feature-42" class="<?= in_array(42, $active_ids) ? 'active' : '' ?>">ABS</p>
            <p id="feature-43" class="<?= in_array(43, $active_ids) ? 'active' : '' ?>">ESP</p>
            <p id="feature-44" class="<?= in_array(44, $active_ids) ? 'active' : '' ?>">EBD</p>
            <p id="feature-45" class="<?= in_array(45, $active_ids) ? 'active' : '' ?>">Automātiskā parkošanās sistēma</p>
            <p id="feature-46" class="<?= in_array(46, $active_ids) ? 'active' : '' ?>">Parkošanās sensori</p>
            <p id="feature-47" class="<?= in_array(47, $active_ids) ? 'active' : '' ?>">Braukšanas joslas saglabāšanas asistents</p>
            <p id="feature-48" class="<?= in_array(48, $active_ids) ? 'active' : '' ?>">Aklo zonu uzraudzības sistēma</p>
            <p id="feature-49" class="<?= in_array(49, $active_ids) ? 'active' : '' ?>">Adaptīvās gaismas</p>
            <p id="feature-50" class="<?= in_array(50, $active_ids) ? 'active' : '' ?>">Automātiska tālo gaismu pārslēgšana</p>
            <p id="feature-51" class="<?= in_array(51, $active_ids) ? 'active' : '' ?>">Automātiskā bremzēšana</p>
            <p id="feature-52" class="<?= in_array(52, $active_ids) ? 'active' : '' ?>">Vadītāja noguruma detektors</p>
            <p id="feature-53" class="<?= in_array(53, $active_ids) ? 'active' : '' ?>">Gaisa spilveni</p>
            <p id="feature-54" class="<?= in_array(54, $active_ids) ? 'active' : '' ?>">ISOFIX stiprinājumi</p>
            <p id="feature-55" class="<?= in_array(55, $active_ids) ? 'active' : '' ?>">Imobilaizers</p>
            <p id="feature-56" class="<?= in_array(56, $active_ids) ? 'active' : '' ?>">Signalizācija</p>
            <p id="feature-57" class="<?= in_array(57, $active_ids) ? 'active' : '' ?>">Centrālā atslēga</p>
            <p id="feature-58" class="<?= in_array(58, $active_ids) ? 'active' : '' ?>">Riepu spiediena kontroles sistēma</p>

        </div>

    </div>

    <div class="price-Info-Section">

        <div class="info-container">

            <p>Pilsēta: <span><?php echo $Car['Pilseta']?></span></p>

            <p>Vin: <span><?php echo $Car['Vin']?></span></p>

            <p>Tel: <span><?php echo $Izvade_telefons; ?></span></p>

            <p id="price">Cena: <?php echo $Car['Cena']?> €</p>

        </div>

    </div>

</section>

<?php require "../../footer.php"; ?>