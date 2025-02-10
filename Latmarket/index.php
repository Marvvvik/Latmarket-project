<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LatMarket</title>
    <link rel="shortcut icon" href="image/Latmarket-logo-mini.png" type="image/png">
    <link rel="stylesheet" href="assets/style-main.css">
    <link rel="stylesheet" href="assets/style-index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <script src="assets/script-main.js" defer></script>
    <script src="assets/script-index.js" defer></script>
    <script src="assets/script-ajax.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</head>
<body>

<?php

require "header.php";

?>

<section class="search" id="search">

    <div class="searchbox">

        <div class="box active">

            <div class="neo-line"></div>

            <h2>Transports</h2>

            <div class="marker"></div>

        </div>

        <div class="box">

            <div class="neo-line"></div>

            <h2>Darbs un bizness</h2>

            <div class="marker"></div>

        </div>

        <div class="box">

            <div class="neo-line"></div>

            <h2>Nekustamie īpašumi</h2>

            <div class="marker"></div>

        </div>

        <div class="box">

            <div class="neo-line"></div>

            <h2>Celtniecība</h2>

            <div class="marker"></div>

        </div>

        <div class="box">

            <div class="neo-line"></div>

            <h2>Elektrotehnika</h2>

            <div class="marker"></div>

        </div>

        <div class="box">

            <div class="neo-line"></div>

            <h2>Drēbes</h2>

            <div class="marker"></div>

        </div>

        <div class="box">

            <div class="neo-line"></div>

            <h2>Mājai</h2>

            <div class="marker"></div>

        </div>

        <div class="box">

            <div class="neo-line"></div>

            <h2>Ražošana</h2>

            <div class="marker"></div>

        </div>

        <div class="box">

            <div class="neo-line"></div>

            <h2>Bērniem</h2>

            <div class="marker"></div>

        </div>

        <div class="box">

            <div class="neo-line"></div>

            <h2>Dzīvnieki</h2>

            <div class="marker"></div>

        </div>

    </div>

    <div class="dynamic-line">

        <div class="dline"></div>

        <i class="fas fa-caret-up triangle"></i>

    </div>

    <div class="grupbox active" id="carbox">

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

    <div class="grupbox" id="darbbox">

        <div class="box">

            <i class="fas fa-briefcase"></i>

            <p>Vakances</p>

        </div>


        <div class="box">

            <i class="fas fa-search"></i>

            <p>Meklē darbu</p>

        </div>

        <div class="box">

            <i class="fas fa-chalkboard-teacher"></i>

            <p>Kursi</p>

        </div>

    </div>

    <div class="grupbox" id="nekustbox">

        <div class="box">

            <i class="fas fa-building"></i>

            <p>Dzīvokļi, Mājas</p>

        </div>


        <div class="box">

            <i class="fas fa-globe"></i>

            <p>Zeme</p>

        </div>

        <div class="box">

            <i class="fas fa-door-open"></i>

            <p>Telpas</p>

        </div>

    </div>


    <div class="grupbox" id="celtbox">

        <div class="box">

            <i class="fas fa-hard-hat"></i>

            <p>Būvmateriāli</p>

        </div>

        <div class="box">

            <i class="fas fa-wrench"></i>

            <p>Instrumenti</p>

        </div>

        <div class="box">

            <i class="fas fa-bath"></i>

            <p>Santehnika</p>

        </div>

        <div class="box">

            <i class="fas fa-leaf"></i>

            <p>Dārza tehnika</p>

        </div>

    </div>

    <div class="grupbox" id="elektrobox">

        <div class="box">

            <i class="fas fa-mobile-alt"></i>

            <p>Telefoni</p>

        </div>

        <div class="box">

            <i class="fas fa-cogs"></i>

            <p>Sadzīves tehnika</p>

        </div>

        <div class="box">

            <i class="fas fa-laptop"></i>

            <p>Datori</p>

        </div>

        <div class="box">

            <i class="fas fa-headphones-alt"></i>

            <p>Audio tehnika</p>

        </div>

        <div class="box">

            <i class="fas fa-camera"></i>

            <p>Foto tehnika</p>

        </div>

        <div class="box">

            <i class="fas fa-plug"></i>

            <p>Elektronika</p>

        </div>

        <div class="box">

            <i class="fas fa-tv"></i>

            <p>TV, Ekrani</p>

        </div>

    </div>

    <div class="grupbox" id="drebbox">

        <div class="box">

            <i class="fas fa-female"></i>

            <p>Sieviešu apģērbi</p>

        </div>

        <div class="box">

            <i class="fas fa-male"></i>

            <p>Vīriešu apģērbi</p>

        </div>

        <div class="box">

            <i class="fas fa-child"></i>

            <p>Bērnu apģērbi</p>

        </div>

        <div class="box">

            <i class="fas fa-user-tie"></i>

            <p>Specapģērbi</p>

        </div>

    </div>

    <div class="grupbox" id="majbox">

        <div class="box">

            <i class="fas fa-couch"></i>

            <p>Mēbeles</p>

        </div>

        <div class="box">

            <i class="fas fa-gift"></i>

            <p>Suvenīri</p>

        </div>

        <div class="box">

            <i class="fa-regular fa-hand"></i>

            <p>Roku izstrādājumi</p>

        </div>

        <div class="box">

            <i class="fas fa-coffee"></i>

            <p>Trauki</p>

        </div>

        <div class="box">

            <i class="fas fa-seedling"></i>

            <p>Mājas augi</p>

        </div>


    </div>

</section>


<section class="stats">

    <div class="neon"></div>

    <div class="statboxs">

        <div class="box">

            <h1>8967</h1>
                
            <h2>Sludinājumu</h2>

        </div>

        <div class="box">

            <h1>105784</h1>
                
            <h2>Lietotaju</h2>
            
        </div>

        <div class="box">

            <h1>13664</h1>
                
            <h2>Mašinu</h2>
            
        </div>

        <div class="box">

            <h1>88525</h1>
                
            <h2>DZivokļu</h2>
            
        </div>
        
    </div>

</section>


<?php

require "footer.php";

?>
    
</body>
</html>