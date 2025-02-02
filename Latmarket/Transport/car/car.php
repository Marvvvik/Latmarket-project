<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LatMarket  || Car</title>
    <link rel="shortcut icon" href="../../image/Latmarket-logo-mini.png" type="image/png">
    <link rel="stylesheet" href="../../assets/style-main.css">
    <link rel="stylesheet" href="assets/style-car.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <script src="assets/filter-ajax.js" defer></script>
    <script src="../../assets/script-main.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


</head>
<body>

<?php

require "../../header.php";

?>

<section class="search-line">

<div class="grupboxs active" id="carbox">

    <div class="box">

        <i class="fas fa-car-side"></i>

        <p>Vieglie auto</p>
        
        <a href="Transport/car/car.php" class="link"></a>

    </div>


    <div class="box">

        <i class="fas fa-truck"></i>

        <p>Kravas auto</p>

    </div>

    <div class="box">

        <i class="fas fa-motorcycle"></i>

        <p>Moto transports</p>

    </div>

    <div class="box">

        <i class="fas fa-bicycle"></i>

        <p>Velosipēdi</p>

    </div>

    <div class="box">

        <i class="fas fa-shuttle-van"></i>

        <p>Pasažieru auto</p>

    </div>

    <div class="box">

        <i class="fas fa-tools"></i>

        <p>Rezerves daļas</p>

    </div>

</div>

</section>

<section class="filter">
    
    <div class="filter-menu">

        <div class="filterbox">

            <div class="box">

                <div class="list-choice">

                    <div class="list-choice-title">Marka</div>

                    <div class="list-choice-objects">

                    <label>
                            
                        <input type="radio" name="marka" value=""><span></span>

                    </label>

                    <?php require "car-filter.php"; echo $Car_brendss; ?>

                    </div>
                    
                </div>

            </div>
            
            <div class="box">

                <div class="list-choice">

                    <div class="list-choice-title">Modelis</div>

                    <div class="list-choice-objects">
                    
                        <label>

                            <input type="radio" name="model" onclick="resetSelection()"><span> </span>

                        </label>

                        <label>

                            <input type="radio" name="model" onclick="updateTitle(this)"><span>AUDI</span>

                        </label>

                        <label>

                            <input type="radio" name="model" onclick="updateTitle(this)"><span>BMW</span>

                        </label>

                        <label>
                            
                            <input type="radio" name="model" onclick="updateTitle(this)"><span>MERCEDES</span>

                        </label>

                    </div>
                </div>
            </div>

            <div class="box">

                <div class="list-choice">

                    <div class="list-choice-title">Virsbūves tips</div>

                    <div class="list-choice-objects">

                        <label>
                            <input type="radio" name="v-tips" value=""><span></span>
                        </label>

                        <label>
                            <input type="radio" name="v-tips" value="Sedans"><span>Sedans</span>
                        </label>

                        <label>
                            <input type="radio" name="v-tips" value="Kupē"><span>Kupē</span>
                        </label>

                        <label>
                            <input type="radio" name="v-tips" value="Hečbeks"><span>Hečbeks</span>
                        </label>

                        <label>
                            <input type="radio" name="v-tips" value="Liftbeks"><span>Liftbeks</span>
                        </label>

                        <label>
                            <input type="radio" name="v-tips" value="Fastbeks"><span>Fastbeks</span>
                        </label>

                        <label>
                            <input type="radio" name="v-tips" value="Universāls"><span>Universāls</span>
                        </label>

                        <label>
                            <input type="radio" name="v-tips" value="Krosovers"><span>Krosovers</span>
                        </label>

                        <label>
                            <input type="radio" name="v-tips" value="Apvidus auto"><span>Apvidus auto</span>
                        </label>

                        <label>
                            <input type="radio" name="v-tips" value="Pikaps"><span>Pikaps</span>
                        </label>

                        <label>
                            <input type="radio" name="v-tips" value="Vieglā kravas automašīna"><span>Vieglā kravas automašīna</span>
                        </label>

                        <label>
                            <input type="radio" name="v-tips" value="Minivens"><span>Minivens</span>
                        </label>

                        <label>
                            <input type="radio" name="v-tips" value="Kompaktvans"><span>Kompaktvans</span>
                        </label>

                        <label>
                            <input type="radio" name="v-tips" value="Mikrovens"><span>Mikrovens</span>
                        </label>

                        <label>
                            <input type="radio" name="v-tips" value="Kabriolets"><span>Kabriolets</span>
                        </label>

                        <label>
                            <input type="radio" name="v-tips" value="Rodsters"><span>Rodsters</span>
                        </label>

                        <label>
                            <input type="radio" name="v-tips" value="Targa"><span>Targa</span>
                        </label>

                        <label>
                            <input type="radio" name="v-tips" value="Lando"><span>Lando</span>
                        </label>

                        <label>
                            <input type="radio" name="v-tips" value="Limuzīns"><span>Limuzīns</span>
                        </label>

                    </div>

                </div>

            </div>

            <div class="box">

                <div class="list-choice">

                    <div class="list-choice-title">Dzineja tips</div>

                    <div class="list-choice-objects">

                        <label>
                            <input type="radio" name="Dzineja" value=""><span></span>
                        </label>

                        <label>
                            <input type="radio" name="Dzineja" value="Benzīns"><span>Benzīns</span>
                        </label>

                        <label>
                            <input type="radio" name="Dzineja" value="Benzīns/gāze"><span>Benzīns/gāze</span>
                        </label>

                        <label>
                            <input type="radio" name="Dzineja" value="Dīzelis"><span>Dīzelis</span>
                        </label>

                        <label>
                            <input type="radio" name="Dzineja" value="Hybrīd"><span>Hybrīd</span>
                        </label>

                        <label>
                            <input type="radio" name="Dzineja" value="Elektriskais"><span>Elektriskais</span>
                        </label>

                    </div>

                </div>

            </div>
        
            <div class="box">

                <div class="list-choice">

                    <div class="list-choice-title">Ātrumkārba</div>

                    <div class="list-choice-objects">

                        <label>
                            <input type="radio" name="atrumkarba" value=""><span></span>
                        </label>

                        <label>
                            <input type="radio" name="atrumkarba" value="Automāts"><span>Automāts</span>
                        </label>

                        <label>
                            <input type="radio" name="atrumkarba" value="Manuāla"><span>Manuāla</span>
                        </label>

                    </div>

                </div>

            </div>

            <div class="box">

                <div class="list-choice">

                    <div class="list-choice-title">Krāsa</div>

                    <div class="list-choice-objects">

                        <label>
                            <input type="radio" name="Krasa" value=""><span></span>
                        </label>

                        <label>
                            <input type="radio" name="Krasa" value="Melna"><span>Melna</span>
                        </label>

                        <label>
                            <input type="radio" name="Krasa" value="Balta"><span>Balta</span>
                        </label>

                        <label>
                            <input type="radio" name="Krasa" value="Brūna"><span>Brūna</span>
                        </label>

                        <label>
                            <input type="radio" name="Krasa" value="Sarkana"><span>Sarkana</span>
                        </label>

                        <label>
                            <input type="radio" name="Krasa"value="Dzeltena"><span>Dzeltena</span>
                        </label>

                        <label>
                            <input type="radio" name="Krasa" value="Zila"><span>Zila</span>
                        </label>

                        <label>
                            <input type="radio" name="Krasa" value="Oraņža"><span>Oraņža</span>
                        </label>

                        <label>
                            <input type="radio" name="Krasa" value="Violeta"><span>Violeta</span>
                        </label>

                        <label>
                            <input type="radio" name="Krasa" value="Pelēka"><span>Pelēka</span>
                        </label>

                        <label>
                            <input type="radio" name="Krasa" value="Sudraba"><span>Sudraba</span>
                        </label>

                    </div>

                </div>

            </div>

            <div class="box">

                <div class="list-choice">

                    <div class="list-choice-title">Piedzina</div>

                    <div class="list-choice-objects">

                    <label>
                        <input type="radio" name="Piedzina" value=""><span></span>
                    </label>

                    <label>
                        <input type="radio" name="Piedzina" value="Priekšējā piedziņa"><span>Priekšējā piedziņa</span>
                    </label>

                    <label>
                        <input type="radio" name="Piedzina" value="Aizmugurējā piedziņa"><span>Aizmugurējā piedziņa</span>
                    </label>

                    <label>
                        <input type="radio" name="Piedzina" value="Pilnpiedziņa"><span>Pilnpiedziņa</span>
                    </label>

                    </div>

                </div>

            </div>

            <div class="box">

                <div class="list-choice">

                    <div class="list-choice-title">Tehniska apskate</div>

                    <div class="list-choice-objects">

                    <label>
                        <input type="radio" name="Tehniska" value=""><span></span>
                    </label>

                    <label>
                        <input type="radio" name="Tehniska" value="1"><span>Ir</span>
                    </label>

                    <label>
                        <input type="radio" name="Tehniska" value="2"><span>Nav</span>
                    </label>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

<?php if(isset($_SESSION['lietotajvardsHOMIK'])){ ?>

<section class="sludinajumabtn">

<a href="#search" class="btna sludbtn">

<div class="slud-btn-box">

    <i class="fas fa-plus"></i>

    <span>Izvedot sludinajumu</span>

</div>

</a>

</section>

<?php } ?>


<section class="offers">

    <div class="offerbox" id="cars-container">

        <?php

            require "car-izvade.php";

        ?>

    </div>

</section>


<?php

require "../../footer.php"

?>