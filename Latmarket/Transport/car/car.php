<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LatMarket  || Vieglie auto</title>
    <link rel="shortcut icon" href="../../image/Latmarket-logo-mini.png" type="image/png">
    <link rel="stylesheet" href="../../assets/style-main.css">
    <link rel="stylesheet" href="assets/style-car.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <script src="assets/filter-ajax.js" defer></script>
    <script src="../../assets/script-main.js" defer></script>
    <script src="../../assets/script-ajax.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


</head>
<body>

<?php

require "../../header.php";

?>

</section>

<section class="filter">
    <div class="filter-menu">
        <div class="select-Container">

            <div class="box">

                <div class= "filt-cont">
                    <div class="select">
                        <select id="Car_brends_select" name="Car_brends_select">

                            <option value='' id="name" hidden>Marka</option>
                            <option value='' id="clear">-</option>
                            <?php 
                                require "database/car-filter.php"; 
                                echo $Car_brendss; 
                            ?>
                            
                        </select>
                    </div>
                </div> 

            </div>
            
            <div class="box">

                <div class= "filt-cont">
                    <div class="select" >

                        <select id="car_modelis_select" name="car_modelis_select" disabled>
                            <option value='' id="name" hidden>Modelis</option>
                            <option value='' id="clear">-</option>

                        </select>
                    </div>
                </div>

            </div>

            <div class="box">

                <div class= "filt-cont">
                    <div class="select">
                        <select id="car_virsbuves_select" name="car_virsbuves_select">

                            <option value='' id="name" hidden>Virsbūves tips</option>
                            <option value='' id="clear">-</option>
                            <option value="Sedans">Sedans</option>
                            <option value="Kupē">Kupē</option>
                            <option value="Hečbeks">Hečbeks</option>
                            <option value="Liftbeks">Liftbeks</option>
                            <option value="Fastbeks">Fastbeks</option>
                            <option value="Universāls">Universāls</option>
                            <option value="Krosovers">Krosovers</option>
                            <option value="Apvidus auto">Apvidus auto</option>
                            <option value="Pikaps">Pikaps</option>
                            <option value="Vieglā kravas automašīna">Vieglā kravas automašīna</option>
                            <option value="Minivens">Minivens</option>
                            <option value="Kompaktvans">Kompaktvans</option>
                            <option value="Mikrovens">Mikrovens</option>
                            <option value="Kabriolets">Kabriolets</option>
                            <option value="Rodsters">Rodsters</option>
                            <option value="Targa">Targa</option>
                            <option value="Lando">Lando</option>
                            <option value="Limuzīns">Limuzīns</option>

                        </select>
                    </div>
                </div>

            </div>

            <div class="box">

                <div class= "filt-cont">
                    <div class="select">
                        <select id="car_Dzineja_tips_select" name="car_Dzineja_tips_select">

                            <option value='' id="name" hidden>Dzineja tips</option>
                            <option value='' id="clear">-</option>
                            <option value="Benzīns">Benzīns</option>
                            <option value="Benzīns/gāze">Benzīns/gāze</option>
                            <option value="Dīzelis">Dīzelis</option>
                            <option value="Hybrīd">Hybrīd</option>
                            <option value="Elektriskais">Elektriskais</option>

                        </select>
                    </div>
                </div>

            </div>
        
            <div class="box">

                <div class= "filt-cont">
                    <div class="select">
                        <select id="car_atrumkarba_select" name="car_atrumkarba_select">

                            <option value='' id="name" hidden>Ātrumkārba</option>
                            <option value='' id="clear">-</option>
                            <option value="Automāts">Automāts</option>
                            <option value="Manuāla">Manuāla</option>

                        </select>
                    </div>
                </div>

            </div>

            <div class="box">

                <div class= "filt-cont">
                    <div class="select">
                        <select id="car_krasa_select" name="car_krasa_select">

                            <option value='' id="name" hidden>Krāsa</option>
                            <option value='' id="clear">-</option>
                            <option value="Melna">Melna</option>
                            <option value="Balta">Balta</option>
                            <option value="Brūna">Brūna</option>
                            <option value="Sarkana">Sarkana</option>
                            <option value="Dzeltena">Dzeltena</option>
                            <option value="Zila">Zila</option>
                            <option value="Oraņža">Oraņža</option>
                            <option value="Violeta">Violeta</option>
                            <option value="Pelēka">Pelēka</option>
                            <option value="Sudraba">Sudraba</option>

                        </select>
                    </div>
                </div>

            </div>

            <div class="box">

                <div class= "filt-cont">
                    <div class="select">
                        <select id="car_piedzina_select" name="car_piedzina_select">

                            <option value='' id="name" hidden>Piedzina</option>
                            <option value='' id="clear">-</option>
                            <option value="Priekšējā piedziņa">Priekšējā piedziņa</option>
                            <option value="Aizmugurējā piedziņa">Aizmugurējā piedziņa</option>
                            <option value="Pilnpiedziņa">Pilnpiedziņa</option>

                        </select>
                    </div>
                </div>

            </div>

            <div class="box">

                <div class= "filt-cont">
                    <div class="select">
                        <select id="car_tehniska_apskate_select" name="car_tehniska_apskate_select">

                            <option value='' id="name" hidden>Tehniska apskate</option>
                            <option value='' id="clear">-</option>
                            <option value="1">Ir</option>
                            <option value="2">Nav</option>
                            <option value="Neizgai atkartoti">Neizgai atkartoti</option>

                        </select>
                    </div>
                </div>

            </div>

        </div>

        <div class="min-max-filter">

            <div class="filter-box" data-filter="price" data-gap="500">
                <div class="fil-box-nos">
                    <h1>Cena:</h1>
                </div>
                <div class="price-input">
                    <input type="number" class="input-min" placeholder="<?php echo $car_zem_cen;?>">
                    <p> - </p>
                    <input type="number" class="input-max" placeholder="<?php echo $car_aug_cen;?>">
                    <p> €</p>
                </div>
            </div>

            <div class="filter-box" data-filter="year" data-gap="1">
                <div class="fil-box-nos">
                    <h1>Gads:</h1>
                </div>
                <div class="price-input">
                    <input type="number" class="input-min" placeholder="<?php echo $car_zem_gads;?>">
                    <p> - </p>
                    <input type="number" class="input-max" placeholder="<?php echo $car_aug_gads;?>">
                </div>
            </div>

            <div class="filter-box" data-filter="mileage" data-gap="1000">
                <div class="fil-box-nos">
                    <h1>Nobrakums:</h1>
                </div>
                <div class="price-input">
                    <input type="number" class="input-min" placeholder="<?php echo $car_zem_mileage;?>">
                    <p> - </p>
                    <input type="number" class="input-max" placeholder="<?php echo $car_aug_mileage;?>">
                    <p> KM</p>
                </div>
            </div>

            <div class="filter-box" data-filter="power" data-gap="10">
                <div class="fil-box-nos">
                    <h1>Jauda:</h1>
                </div>
                <div class="price-input">
                    <input type="number" class="input-min" placeholder="<?php echo $car_zem_power;?>">
                    <p> - </p>
                    <input type="number" class="input-max" placeholder="<?php echo $car_aug_power;?>">
                    <p> KW</p>
                </div>
            </div>

        </div>


        <div class="radio-filter">
            <div class="box">
                <div class="rad-fil-nos"> <h1>Pec DTP: </h1> </div>
                <div class="wrapper">

                    <input type="radio" name="dtp" id="dtp-option-1" value="1">
                    <input type="radio" name="dtp" id="dtp-option-2" value="2">
                    <input type="radio" name="dtp" id="dtp-option-3" value="3" checked>

                    <label for="dtp-option-1" class="option dtp-option-1">
                        <div class="dot"></div>
                        <span>Jā</span>
                    </label>

                    <label for="dtp-option-2" class="option dtp-option-2">
                        <div class="dot"></div>
                        <span>Nē</span>
                    </label>

                    <label for="dtp-option-3" class="option dtp-option-3">
                        <div class="dot"></div>
                        <span>Visi</span>
                    </label>

                </div>

            </div>

            <div class="box">
                <div class="rad-fil-nos"> <h1>Jaudas mērvienība: </h1> </div>
                <div class="wrapper">

                    <input type="radio" name="jauda-m" id="jauda-option-1" value="1" checked>
                    <input type="radio" name="jauda-m" id="jauda-option-2" value="2">

                    <label for="jauda-option-1" class="option jauda-option-1">
                        <div class="dot"></div>
                        <span>KW</span>
                    </label>

                    <label for="jauda-option-2" class="option jauda-option-2">
                        <div class="dot"></div>
                        <span>HP</span>
                    </label>

                </div>

            </div>

            <div class="box">
                <div class="rad-fil-nos"> <h1>Nobraukuma mērvienība: </h1> </div>
                <div class="wrapper">

                    <input type="radio" name="nobrakums-m" id="nobraukums-option-1" value="1" checked>
                    <input type="radio" name="nobrakums-m" id="nobraukums-option-2" value="2">

                    <label for="nobraukums-option-1" class="option nobraukums-option-1">
                        <div class="dot"></div>
                        <span>KM</span>
                    </label>

                    <label for="nobraukums-option-2" class="option nobraukums-option-2">
                        <div class="dot"></div>
                        <span>Miles</span>
                    </label>

                </div>

            </div>
        </div>

        <div class="add-Filter">

            <div class="box-Container">

                <?php if(session_status() === PHP_SESSION_ACTIVE && isset($_SESSION['lietotajvardsHOMIK'])){ ?>
                <div class="box">
                    <a href="car-add.php"><i class="fa fa-plus"></i>Izveidot sludinājumu</a>
                </div>
                <?php }; ?>
                <div class="box">
                    <div class= "filt-cont">
                        <div class="select">
                            <select id="" name="">

                                <option value=''>Krāsa</option>
                                <option value="Melna">Melna</option>
                                <option value="Balta">Balta</option>
                                <option value="Brūna">Brūna</option>
                                <option value="Sarkana">Sarkana</option>
                                <option value="Dzeltena">Dzeltena</option>
                                <option value="Zila">Zila</option>
                                <option value="Oraņža">Oraņža</option>
                                 <option value="Violeta">Violeta</option>
                                <option value="Pelēka">Pelēka</option>
                                <option value="Sudraba">Sudraba</option>

                            </select>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<div class="offer-buttons"></div>

<section class="offers">
<div class="offerbox" id="carsContainer"></div>
</section>

<?php require "../../footer.php" ?>