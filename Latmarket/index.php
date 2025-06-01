<?php session_start(); ?>

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>

<?php require "header.php"; ?>

<section class="category-selection" id="category-selection">
    <h1>Izvēlieties kategoriju</h1>
    <p>Atrodiet to, ko meklējat, vajadzīgajā kategorijā</p>

    <div class="category-grid active">

        <div class="category-card" id="categoryTransport">
            <img src="image/transport.jpg" class="category-image" alt="Transports">
            <div class="category-content">
                <div class="category-title">
                    <div class="category-icon"><img src="image/icons/w-car.png" alt="Auto ikona"></div>
                    <h2>Transports</h2>
                </div>
                <p>Pirkt un pārdot jaunas un lietotas automašīnas</p>
            </div>
        </div>

        <div class="category-card" id="categoryDarbs">
            <img src="image/darbs.jpg" class="category-image" alt="Darbs un bizness">
            <div class="category-content">
                <div class="category-title">
                    <div class="category-icon"><img src="image/icons/w-bag.png" alt="Darbs ikona"></div>
                    <h2>Darbs un bizness</h2>
                </div>
                <p>Darba piedāvājumi, uzņēmējdarbība un pakalpojumi</p>
            </div>
        </div>

        <div class="category-card" id="categoryElektrotehnika">
            <img src="image/elektronika.jpg" class="category-image" alt="Elektronika">
            <div class="category-content">
                <div class="category-title">
                    <div class="category-icon"><img src="image/icons/w-phone.png" alt="Tehnika ikona"></div>
                    <h2>Elektronika</h2>
                </div>
                <p>Mobilie telefoni, datori un cita tehnika</p>
            </div>
        </div>

        <div class="category-card">
            <img src="image/Majas.jpg" class="category-image" alt="Nekustamais īpašums">
            <div class="category-content">
                <div class="category-title">
                    <div class="category-icon"><img src="image/icons/w-home.png" alt="Māja ikona"></div>
                    <h2>Nekustamais īpašums</h2>
                </div>
                <p>Dzīvokļi, mājas un komerciālais nekustamais īpašums</p>
            </div>
        </div>

        <div class="category-card">
            <img src="image/mebeles.jpg" class="category-image" alt="Mēbeles">
            <div class="category-content">
                <div class="category-title">
                    <div class="category-icon"><img src="image/icons/w-bed.png" alt="Gulta ikona"></div>
                    <h2>Mēbeles</h2>
                </div>
                <p>Mēbeles mājai un birojam</p>
            </div>
        </div>

        <div class="category-card">
            <img src="image/drebes.jpg" class="category-image" alt="Apģērbi">
            <div class="category-content">
                <div class="category-title">
                    <div class="category-icon"><img src="image/icons/w-tshirt.png" alt="Apģērbu ikona"></div>
                    <h2>Apģērbi</h2>
                </div>
                <p>Apģērbi, apavi un aksesuāri</p>
            </div>
        </div>

        <div class="category-card">
            <img src="image/celtnieciba.jpg" class="category-image" alt="Celtniecība">
            <div class="category-content">
                <div class="category-title">
                    <div class="category-icon"><img src="image/icons/w-helmet.png" alt="Celtnieka ķivere"></div>
                    <h2>Celtniecība</h2>
                </div>
                <p>Būvmateriāli un celtniecības pakalpojumi</p>
            </div>
        </div>

        <div class="category-card">
            <img src="image/berni.jpg" class="category-image" alt="Bērniem">
            <div class="category-content">
                <div class="category-title">
                    <div class="category-icon"><img src="image/icons/w-toy.png" alt="Rotaļlietu ikona"></div>
                    <h2>Bērniem</h2>
                </div>
                <p>Rotaļlietas, apģērbi un aprīkojums bērniem</p>
            </div>
        </div>

        <div class="category-card">
            <img src="image/dzivnieki.jpg" class="category-image" alt="Dzīvnieki">
            <div class="category-content">
                <div class="category-title">
                    <div class="category-icon"><img src="image/icons/w-dog.png" alt="Suņa ikona"></div>
                    <h2>Dzīvnieki</h2>
                </div>
                <p>Mājdzīvnieki un piederumi</p>
            </div>
        </div>

        <div class="category-card">
            <img src="image/lauksaimnieciba.jpg" class="category-image" alt="Lauksaimniecība">
            <div class="category-content">
                <div class="category-title">
                    <div class="category-icon"><img src="image/icons/w-tractor.png" alt="Traktora ikona"></div>
                    <h2>Lauksaimniecība</h2>
                </div>
                <p>Lauksaimniecības tehnika un aprīkojums</p>
            </div>
        </div>

        <div class="stats-container">
            <div class="stats-card">
                <h1>8967</h1>
                <h2>Sludinājumu</h2>
            </div>
            <div class="stats-card">
                <h1>105784</h1>
                <h2>Lietotāju</h2>
            </div>
            <div class="stats-card">
                <h1>13664</h1>
                <h2>Mašīnu</h2>
            </div>
            <div class="stats-card">
                <h1>88525</h1>
                <h2>Dzīvokļu</h2>
            </div>
        </div>
    </div>

    <div class="group-grid" id="transportSection">

        <div class="back-Button">
            <button><i class="fas fa-angle-left"></i> Atgriezties</button>
        </div>

        <div class="category-card">
            <a href="Transport/car/car.php"></a>
            <img src="image/auto.jpg" class="category-image" alt="Transports">
            <div class="category-content">
                <div class="category-title">
                    <div class="category-icon"><img src="image/icons/w-car.png" alt="Auto ikona"></div>
                    <h2>Vieglie auto</h2>
                </div>
                <p>Pirkt un pārdot jaunas un lietotas automašīnas</p>
            </div>
        </div>

        <div class="category-card">
            <a href="#"></a>
            <img src="image/kravasauto.jpg" class="category-image" alt="Lauksaimniecība">
            <div class="category-content">
                <div class="category-title">
                    <div class="category-icon"><img src="image/icons/w-truck.png" alt="Traktora ikona"></div>
                    <h2>Kravas automašīnas</h2>
                </div>
                <p>Sludinājumi par kravas automobiļu pirkšanu un pārdošanu</p>
            </div>
        </div>

        <div class="category-card">
            <a href="#"></a>
            <img src="image/moto.jpg" class="category-image" alt="Lauksaimniecība">
            <div class="category-content">
                <div class="category-title">
                    <div class="category-icon"><img src="image/icons/w-moto.png" alt="Traktora ikona"></div>
                    <h2>Moto transports</h2>
                </div>
                <p>Motocikli, mopēdi</p>
            </div>
        </div>

        <div class="category-card">
            <a href="#"></a>
            <img src="image/velo.jpg" class="category-image" alt="Lauksaimniecība">
            <div class="category-content">
                <div class="category-title">
                    <div class="category-icon"><img src="image/icons/w-velo.png" alt="Traktora ikona"></div>
                    <h2>Velosipēdi</h2>
                </div>
                <p>Jauni un lietoti velosipēdi</p>
            </div>
        </div>

        <div class="category-card">
            <a href="#"></a>
            <img src="image/parts.jpg" class="category-image" alt="Lauksaimniecība">
            <div class="category-content">
                <div class="category-title">
                    <div class="category-icon"><img src="image/icons/w-gear.png" alt="Traktora ikona"></div>
                    <h2>Remonts un rezerves daļas</h2>
                </div>
                <p>Auto daļas un piederumi</p>
            </div>
        </div>

        <div class="category-card">
            <a href="#"></a>
            <img src="image/noma.jpg" class="category-image" alt="Lauksaimniecība">
            <div class="category-content">
                <div class="category-title">
                    <div class="category-icon"><img src="image/icons/w-key.png" alt="Traktora ikona"></div>
                    <h2>Transporta noma</h2>
                </div>
                <p>Auto, mikroautobusu un cita transporta īre</p>
            </div>
        </div>

    </div>

    <div class="group-grid" id="DarbsSection">

        <div class="back-Button">
            <button><i class="fas fa-angle-left"></i> Atgriezties</button>
        </div>

        <div class="category-card">
            <a href="Transport/car/car.php"></a>
            <img src="image/office.jpg" class="category-image" alt="Transports">
            <div class="category-content">
                <div class="category-title">
                    <div class="category-icon"><img src="image/icons/w-bag.png" alt="Auto ikona"></div>
                    <h2>Vakances</h2>
                </div>
                <p>Aktuālās darba iespējas dažādās nozarēs</p>
            </div>
        </div>

        <div class="category-card">
            <a href="#"></a>
            <img src="image/work.jpg" class="category-image" alt="Lauksaimniecība">
            <div class="category-content">
                <div class="category-title">
                    <div class="category-icon"><img src="image/icons/w-loop.png" alt="Traktora ikona"></div>
                    <h2>Meklē darbu</h2>
                </div>
                <p>Darba meklētāju sludinājumi un piedāvājumi</p>
            </div>
        </div>

        <div class="category-card">
            <a href="#"></a>
            <img src="image/school.jpg" class="category-image" alt="Lauksaimniecība">
            <div class="category-content">
                <div class="category-title">
                    <div class="category-icon"><img src="image/icons/w-book.png" alt="Traktora ikona"></div>
                    <h2>Kursi, izglītība</h2>
                </div>
                <p>Apmācības, kvalifikācijas celšana un izglītības iespējas</p>
            </div>
        </div>

    </div>

    <div class="group-grid" id="ElektrotehnikaSection">

        <div class="back-Button">
            <button><i class="fas fa-angle-left"></i> Atgriezties</button>
        </div>

        <div class="category-card">
            <a href="Transport/car/car.php"></a>
            <img src="image/phone.png" class="category-image" alt="Transports">
            <div class="category-content">
                <div class="category-title">
                    <div class="category-icon"><img src="image/icons/w-car.png" alt="Auto ikona"></div>
                    <h2>Telefoni</h2>
                </div>
                <p>Viedtālruņi, mobilie telefoni un to aksesuāri</p>
            </div>
        </div>

        <div class="category-card">
            <a href="#"></a>
            <img src="image/sadzive.jpg" class="category-image" alt="Lauksaimniecība">
            <div class="category-content">
                <div class="category-title">
                    <div class="category-icon"><img src="image/icons/w-wash.png" alt="Traktora ikona"></div>
                    <h2>Sadzīves tehnika</h2>
                </div>
                <p>Veļas mašīnas, ledusskapji, plītis un cita sadzīves tehnika</p>
            </div>
        </div>

        <div class="category-card">
            <a href="#"></a>
            <img src="image/pc.jpg" class="category-image" alt="Lauksaimniecība">
            <div class="category-content">
                <div class="category-title">
                    <div class="category-icon"><img src="image/icons/w-pc.png" alt="Traktora ikona"></div>
                    <h2>Datori</h2>
                </div>
                <p>Galda datori, portatīvie un datortehnika</p>
            </div>
        </div>

        <div class="category-card">
            <a href="#"></a>
            <img src="image/audio.jpg" class="category-image" alt="Lauksaimniecība">
            <div class="category-content">
                <div class="category-title">
                    <div class="category-icon"><img src="image/icons/w-moto.png" alt="Traktora ikona"></div>
                    <h2>Audio</h2>
                </div>
                <p>Skaļruņi, pastiprinātāji, austiņas un citi audio risinājumi</p>
            </div>
        </div>

        <div class="category-card">
            <a href="#"></a>
            <img src="image/tv.jpg" class="category-image" alt="Lauksaimniecība">
            <div class="category-content">
                <div class="category-title">
                    <div class="category-icon"><img src="image/icons/w-tv.png" alt="Traktora ikona"></div>
                    <h2>Televizori un monitori</h2>
                </div>
                <p>Plakanie ekrāni, viedie televizori un datora monitori</p>
            </div>
        </div>

        <div class="category-card">
            <a href="#"></a>
            <img src="image/photo.jpg" class="category-image" alt="Lauksaimniecība">
            <div class="category-content">
                <div class="category-title">
                    <div class="category-icon"><img src="image/icons/w-moto.png" alt="Traktora ikona"></div>
                    <h2>Foto un optika</h2>
                </div>
                <p>Digitālās kameras, objektīvi un optiskās ierīces</p>
            </div>
        </div>

        <div class="category-card">
            <a href="#"></a>
            <img src="image/dalas.jpg" class="category-image" alt="Lauksaimniecība">
            <div class="category-content">
                <div class="category-title">
                    <div class="category-icon"><img src="image/icons/w-moto.png" alt="Traktora ikona"></div>
                    <h2>Elektro detaļas</h2>
                </div>
                <p>Kabeļi, savienotāji, barošanas bloki un citas detaļas</p>
            </div>
        </div>

    </div>

</section>

<?php 
if (isset($_SESSION['Maksājums'])) {
    echo $_SESSION['Maksājums'];
    unset($_SESSION['Maksājums']);
}
?>

<?php require "footer.php"; ?>

</body>
</html>
