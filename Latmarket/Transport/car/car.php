<?php session_start(); ?>

<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LatMarket || Vieglie auto</title>
    <link rel="shortcut icon" href="../../image/Latmarket-logo-mini.png" type="image/png">
    <link rel="stylesheet" href="../../assets/style-main.css">
    <link rel="stylesheet" href="assets/style-car.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <script src="assets/filter-ajax.js" defer></script>
    <script src="../../assets/script-main.js" defer></script>
    <script src="../../assets/script-ajax.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>

<?php require "../../header.php"; ?>

<section class="car-filter">

    <h1 class="car-filter__title">Vieglie auto</h1>
    <p class="car-filter__subtitle">Atrodiet savu ideālo auto ātri un viegli!</p>

    <div class="car-filter__form">
        
        <div class="car-filter__select-group">

            <div class="car-filter__select-box">
                <div class= "filt-cont">
                    <select id="filter-brand" name="brand" class="car-filter__select">
                        <option value="" hidden id="name">Marka</option>
                        <option value="" id="clear">-</option>
                        <?php require "database/car-filter.php"; echo $Car_brendss; ?>
                    </select>
                    <div class="box-arrow"><i class="fas fa-angle-down"></i></div>
                </div>
            </div>

            <div class="car-filter__select-box">
                <div class= "filt-cont">
                    <select id="filter-model" name="model" class="car-filter__select" disabled>
                        <option value="" hidden>Modelis</option>
                        <option value="">-</option>
                    </select>
                    <div class="box-arrow"><i class="fas fa-angle-down"></i></div>
                </div>
            </div>

            <div class="car-filter__select-box">
                <div class= "filt-cont">
                    <select id="filter-body" name="body_type" class="car-filter__select">
                        <option value="" hidden id="name">Virsbūves tips</option>
                        <option value="" id="clear">-</option>
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
                    <div class="box-arrow"><i class="fas fa-angle-down"></i></div>
                </div>
            </div>

            <div class="car-filter__select-box">
                <div class= "filt-cont">
                    <select id="filter-engine" name="engine_type" class="car-filter__select">
                        <option value="" hidden id="name">Dzinēja tips</option>
                        <option value="" id="clear">-</option>
                        <option value="Benzīns">Benzīns</option>
                        <option value="Benzīns/gāze">Benzīns/gāze</option>
                        <option value="Dīzelis">Dīzelis</option>
                        <option value="Hybrīd">Hybrīd</option>
                        <option value="Elektriskais">Elektriskais</option>
                    </select>
                    <div class="box-arrow"><i class="fas fa-angle-down"></i></div>
                </div>
            </div>

            <div class="car-filter__select-box">
                <div class= "filt-cont">
                    <select id="filter-gearbox" name="gearbox" class="car-filter__select">
                        <option value="" hidden id="name">Ātrumkārba</option>
                        <option value="" id="clear">-</option>
                        <option value="Automāts">Automāts</option>
                        <option value="Manuāla">Manuāla</option>
                    </select>
                    <div class="box-arrow"><i class="fas fa-angle-down"></i></div>
                </div>
            </div>

            <div class="car-filter__select-box">
                <div class= "filt-cont">
                    <select id="filter-color" name="color" class="car-filter__select">
                        <option value="" hidden id="name">Krāsa</option>
                        <option value="" id="clear">-</option>
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
                    <div class="box-arrow"><i class="fas fa-angle-down"></i></div>
                </div>
            </div>

            <div class="car-filter__select-box">
                <div class= "filt-cont">
                    <select id="filter-drive" name="drive_type" class="car-filter__select">
                        <option value="" hidden id="name">Piedziņa</option>
                        <option value="" id="clear">-</option>
                        <option value="Priekšējā piedziņa">Priekšējā piedziņa</option>
                        <option value="Aizmugurējā piedziņa">Aizmugurējā piedziņa</option>
                        <option value="Pilnpiedziņa">Pilnpiedziņa</option>
                    </select>
                    <div class="box-arrow"><i class="fas fa-angle-down"></i></div>
                </div>
            </div>

            <div class="car-filter__select-box">
                <div class= "filt-cont">
                    <select id="filter-tech" name="tech_inspection" class="car-filter__select">
                        <option value="" hidden id="name">Tehniskā apskate</option>
                        <option value="" id="clear">-</option>
                        <option value="1">Ir</option>
                        <option value="2">Nav</option>
                    </select>
                    <div class="box-arrow"><i class="fas fa-angle-down"></i></div>
                </div>
            </div>
        </div>


        <div class="car-filter__range-group">

            <div class="car-filter__range-box">
                <div class="car-filter__range-label"><h1>Cena (€):</h1></div>

                <div class="car-filter__range-input">
                    <input type="number" class="car-filter__range-min" placeholder="<?php echo $car_zem_cen;?>" id="filter-Price-Min">
                    <span> - </span>
                    <input type="number" class="car-filter__range-max" placeholder="<?php echo $car_aug_cen;?>" id="filter-Price-Max">
                </div>
            </div>

            <div class="car-filter__range-box">
                <div class="car-filter__range-label"><h1>Gads:</h1></div>

                <div class="car-filter__range-input">
                    <input type="number" class="car-filter__range-min" placeholder="<?php echo $car_zem_gads; ?>" id="filter-Gads-Min">
                    <span> - </span>
                    <input type="number" class="car-filter__range-max" placeholder="<?php echo $car_aug_gads; ?>" id="filter-Gads-Max">
                </div>
            </div>

            <div class="car-filter__range-box">
                <div class="car-filter__range-label"><h1>Nobraukums (KM):</h1></div>

                <div class="car-filter__range-input">
                    <input type="number" class="car-filter__range-min" placeholder="<?php echo $car_zem_mileage; ?>" id="filter-Nob-Min">
                    <span> - </span>
                    <input type="number" class="car-filter__range-max" placeholder="<?php echo $car_aug_mileage; ?>" id="filter-Nob-Max">
                </div>
            </div>

            <div class="car-filter__range-box">
                <div class="car-filter__range-label"><h1>Tilpums (L):</h1></div>

                <div class="car-filter__range-input">
                    <input type="number" class="car-filter__range-min" placeholder="<?php echo $car_zem_power; ?>" id="filter-Price-Min">
                    <span> - </span>
                    <input type="number" class="car-filter__range-max" placeholder="<?php echo $car_aug_power; ?>" id="filter-Price-Min">
                </div>
            </div>

        </div>


        <div class="car-filter__radio-group">

            <div class="car-filter__radio-box">
                <div class="car-filter__radio-title"><h1>Pēc DTP:</h1></div>
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

            <div class="car-filter__radio-box">
                <div class="car-filter__radio-title"><h1>Jaudas mērvienība:</h1></div>
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

            <div class="car-filter__radio-box">
                <div class="car-filter__radio-title"><h1>Nobraukuma mērvienība:</h1></div>
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

        <div class="car-filter__actions">
            <?php if (session_status() === PHP_SESSION_ACTIVE && isset($_SESSION['lietotajvardsHOMIK'])): ?>
                <div class="box">
                    <a href="car-add.php"><i class="fa fa-plus"></i> Izveidot sludinājumu</a>
                </div>
            <?php endif; ?>

            <div class="box">
                <div class= "filt-cont">
                    <select id="filter-asc" name="color" class="car-filter__select">
                        <option value="datums_desc">Datums (jaunākie)</option>
                        <option value="datums_asc">Datums (vecākie)</option>
                        <option value="cena_asc">Cena (zemākā)</option>
                        <option value="cena_desc">Cena (augstākā)</option>
                        <option value="gads_desc">Gads (jaunākie)</option>
                        <option value="gads_asc">Gads (vecākie)</option>
                        <option value="nobraukums_asc">Nobraukums (mazākais)</option>
                        <option value="nobraukums_desc">Nobraukums (lielākais)</option>
                        <option value="Tilpums_asc">Tilpums (mazākais)</option>
                        <option value="Tilpums_desc">Tilpums (lielākais)</option>
                        <option value="Jauda_asc">Jauda (mazākais)</option>
                        <option value="Jauda_desc">Jauda (lielākais)</option>
                    </select>
                    <div class="box-arrow"><i class="fas fa-angle-down"></i></div>
                </div>
            </div>
        </div>

    </div>
</section>

<div class="offer-buttons"></div>

<section class="car-offers">
    <div class="car-offers__container" id="carsContainer"></div>
</section>

<?php require "../../footer.php"; ?>
</body>
</html>