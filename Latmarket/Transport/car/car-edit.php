<?php
session_start(); 

if (
    session_status() === PHP_SESSION_ACTIVE &&
    isset($_SESSION['lietotajvardsHOMIK']) &&
    isset($_SESSION['rooleHOMIK']) &&
    $_SESSION['rooleHOMIK'] === 'user'
) {

require "database/car-parskate-izvade.php";

if($Car['autora_id'] == $_SESSION['IdHOMIK']){
?>

<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LatMarket || Vieglie auto</title>
    <link rel="shortcut icon" href="../../image/Latmarket-logo-mini.png" type="image/png">
    <link rel="stylesheet" href="../../assets/style-main.css">
    <link rel="stylesheet" href="assets/style-add.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <script src="assets/car-edit-script.js" defer></script>
    <script src="../../assets/script-main.js" defer></script>
    <script src="../../assets/script-ajax.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>

<?php
require "../../header.php";
require "database/con_db_transports.php";
?>

<section id="car-add">

    <form id="editCar">

    <div class="car-photo-container">

        <div class="car-slider">

            <?php echo $sliderPhotosHTML;?>

            <div class="slider-button slider-left"><i class="fas fa-angle-left"></i></div>
            <div class="slider-button slider-right"><i class="fas fa-angle-right"></i></div>
            <div class="add-photo">
                <input type="file" id="car-photos" name="photos[]" multiple accept="image/*" style="display: none;">
                <label for="car-photos" class="upload-btn">Pievienot foto</label>
            </div>
        </div>

        <div class="author-info">
            <div class="author-box">
                <div class="author-name">
                    <h1><?php echo $_SESSION['vardsHOMIK'] . " " . $_SESSION['UzvardsHOMIK']; ?></h1>
                </div>
                <div class="author-avatar">
                    <img src="<?php echo $_SESSION['avatarHOMIK']; ?>">
                </div>
            </div>
            <div class="post-date">
                <p>Datums: <?php echo date("d.m.Y"); ?></p>
            </div>
        </div>

    </div>

    <div class="car-info">

        <div class="info-table">

            <div class="info-row">
                <img src='../../image/icons/Car-icon.png'>
                <p>Marka:</p>
                <select required id="markaSelectEdit">
                    <option value="<?php echo $Car['Marka']?>" hidden><?php echo $Car['Marka']?></option>

                    <optgroup label="A">
                        <option value="Acura">Acura</option>
                        <option value="Alfa Romeo">Alfa Romeo</option>
                        <option value="Aston Martin">Aston Martin</option>
                        <option value="Audi">Audi</option>
                    </optgroup>

                    <optgroup label="B">
                        <option value="Bentley">Bentley</option>
                        <option value="BMW">BMW</option>
                        <option value="Bugatti">Bugatti</option>
                        <option value="Buick">Buick</option>
                        <option value="BYD">BYD</option>
                    </optgroup>

                    <optgroup label="C">
                        <option value="Cadillac">Cadillac</option>
                        <option value="Chevrolet">Chevrolet</option>
                        <option value="Chrysler">Chrysler</option>
                        <option value="Citroën">Citroën</option>
                    </optgroup>

                    <optgroup label="D">
                        <option value="Daewoo">Daewoo</option>
                        <option value="Daihatsu">Daihatsu</option>
                        <option value="Dodge">Dodge</option>
                    </optgroup>

                    <optgroup label="E">
                        <option value="Exeed">Exeed</option>
                    </optgroup>

                    <optgroup label="F">
                        <option value="Ferrari">Ferrari</option>
                        <option value="Fiat">Fiat</option>
                        <option value="Ford">Ford</option>
                    </optgroup>

                    <optgroup label="G">
                        <option value="GAZ">GAZ</option>
                        <option value="Geely">Geely</option>
                        <option value="Genesis">Genesis</option>
                        <option value="GMC">GMC</option>
                        <option value="Great Wall">Great Wall</option>
                    </optgroup>

                    <optgroup label="H">
                        <option value="Haval">Haval</option>
                        <option value="Honda">Honda</option>
                        <option value="Hongqi">Hongqi</option>
                        <option value="Hyundai">Hyundai</option>
                    </optgroup>

                    <optgroup label="I">
                        <option value="Infiniti">Infiniti</option>
                    </optgroup>

                    <optgroup label="J">
                        <option value="JAC">JAC</option>
                        <option value="Jeep">Jeep</option>
                        <option value="Jetour">Jetour</option>
                    </optgroup>

                    <optgroup label="K">
                        <option value="Kia">Kia</option>
                        <option value="Koenigsegg">Koenigsegg</option>
                    </optgroup>

                    <optgroup label="L">
                        <option value="Lada">Lada</option>
                        <option value="Lamborghini">Lamborghini</option>
                        <option value="Land Rover">Land Rover</option>
                        <option value="Lexus">Lexus</option>
                        <option value="Lifan">Lifan</option>
                        <option value="Lincoln">Lincoln</option>
                        <option value="Lotus">Lotus</option>
                    </optgroup>

                    <optgroup label="M">
                        <option value="Maserati">Maserati</option>
                        <option value="Maybach">Maybach</option>
                        <option value="Mazda">Mazda</option>
                        <option value="McLaren">McLaren</option>
                        <option value="Mercedes-Benz">Mercedes-Benz</option>
                        <option value="Mitsubishi">Mitsubishi</option>
                    </optgroup>

                    <optgroup label="N">
                        <option value="Nissan">Nissan</option>
                    </optgroup>

                    <optgroup label="O">
                        <option value="Opel">Opel</option>
                    </optgroup>

                    <optgroup label="P">
                        <option value="Pagani">Pagani</option>
                        <option value="Peugeot">Peugeot</option>
                        <option value="Porsche">Porsche</option>
                    </optgroup>

                    <optgroup label="R">
                        <option value="Renault">Renault</option>
                        <option value="Rimac">Rimac</option>
                        <option value="Rolls-Royce">Rolls-Royce</option>
                    </optgroup>

                    <optgroup label="S">
                        <option value="Seat">Seat</option>
                        <option value="Skoda">Skoda</option>
                        <option value="Subaru">Subaru</option>
                        <option value="Suzuki">Suzuki</option>
                    </optgroup>

                    <optgroup label="T">
                        <option value="Tesla">Tesla</option>
                        <option value="Toyota">Toyota</option>
                    </optgroup>

                    <optgroup label="U">
                        <option value="UAZ">UAZ</option>
                    </optgroup>

                    <optgroup label="V">
                        <option value="Volkswagen">Volkswagen</option>
                        <option value="Volvo">Volvo</option>
                    </optgroup>

                    <optgroup label="Z">
                        <option value="Zeekr">Zeekr</option>
                    </optgroup>
                </select>
            </div>

            <div class="info-row">
                <img src='../../image/icons/Car-icon.png'>
                <p>Modelis:</p>
                <select disabled id="modelSelectEdit">
                    <option value="<?php echo $Car['Modelis']?>" hidden><?php echo $Car['Modelis']?></option>

                </select>
            </div>

            <?php $currentYear = date("Y"); ?>
            <div class="info-row">
                <img src='../../image/icons/calendar-icon.png'>
                <p>Gads:</p>
                <input type="number"  min="1" max="<?= $currentYear ?>" required id="gadsInputEdit" placeholder="<?php echo $Car['Izladuma_gads']?>" value="<?php echo $Car['Izladuma_gads']?>">
            </div>

            <div class="info-row">
                <img src='../../image/icons/Virsbuves-icon.png'>
                <p>Virsbūves tips:</p>
                <select required id="virsSelectEdit">
                    <option value='<?php echo $Car['Virsbuves_tips']?>' hidden><?php echo $Car['Virsbuves_tips']?></option>
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

            <div class="info-row">
                <img src='../../image/icons/car-engine-icon.png'>
                <p>Tilpums:</p>
                <input type="text"  min="1" max="10" required id="tilInputEdit" placeholder="<?php echo number_format($Car['Dzinejs'], 1)?>" value="<?php echo number_format($Car['Dzinejs'], 1)?>">
                <p>L</p>
            </div>

            <div class="info-row">
                <img src='../../image/icons/Jauda-icon.png'>
                <p>Jauda:</p>
                <input type="number"  min="1" max="3000" required id="jauInputEdit" placeholder="<?php echo $Car['Jauda']?>" value="<?php echo $Car['Jauda']?>">
                <p>KW</p>
            </div>

            <div class="info-row">
                <img src='../../image/icons/AKKP-icon.png'>
                <p>Ātrumkārba:</p>
                <select required id="atrumSelectEdit">
                    <option value='<?php echo $Car['Atrumkarba_tips']?>' hidden><?php echo $Car['Atrumkarba_tips']?></option>
                    <option value="Automāts">Automāts</option>
                    <option value="Manuāla">Manuāla</option>
                </select>
            </div>

            <div class="info-row">
                <img src='../../image/icons/Oil-icon.png'>
                <p>Degviela: <span class="info-value"></span></p>
                <select required id="degSelectEdit">
                    <option value='<?php echo $Car['Bezina_tips']?>' hidden><?php echo $Car['Bezina_tips']?></option>
                    <option value="Benzīns">Benzīns</option>
                    <option value="Benzīns/gāze">Benzīns/gāze</option>
                    <option value="Dīzelis">Dīzelis</option>
                    <option value="Hybrīd">Hybrīd</option>
                    <option value="Elektriskais">Elektriskais</option>
                </select>
            </div>

            <div class="info-row">
                <img src='../../image/icons/Piedzinas-icon.png'>
                <p>Piedziņa: <span class="info-value"></span></p>
                <select required id="piedzSelectEdit">
                    <option value="<?php echo $Car['Piedzina']?>" hidden><?php echo $Car['Piedzina']?></option>
                    <option value="Priekšējā piedziņa">Priekšējā piedziņa</option>
                    <option value="Aizmugurējā piedziņa">Aizmugurējā piedziņa</option>
                    <option value="Pilnpiedziņa">Pilnpiedziņa</option>
                </select>
            </div>

            <div class="info-row">
                <img src='../../image/icons/Odometr-icon.png'>
                <p>Nobrakums: </p>
                <input type="number" min="1" required id="nobInputEdit" placeholder="<?php echo $Car['Nobrakums']?>" value="<?php echo $Car['Nobrakums']?>">
                <p>KM</p>
            </div>

            <div class="info-row">
                <img src='../../image/icons/Krasas-icon.png'>
                <p>Krāsa: <span class="info-value"></span></p>
                <select required id="krasSelectEdit">
                    <option value='<?php echo $Car['Krasa']?>' hidden><?php echo $Car['Krasa']?></option>
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

            <div class="info-row">
                <img src='../../image/icons/teh-icon.png'>
                <p>Tehniskā apskate: <span class="info-value"></span></p>
                <input type="date" id="apskateInputEdit" value="<?php echo $Car['Tehniska_apskate']?>">
            </div>

        </div>

    </div>

    <div class="car-description">
        <div class="edit-buttons">
            <button type="button" onclick="toggleFormat('bold')"><b>B</b></button>
            <button type="button" onclick="toggleHeading('h1')">H1</button>
            <button type="button" onclick="toggleHeading('h2')">H2</button>
        </div>
        <div class="contenteditable-box">
            <div class="contenteditable" id="car-description-Edit" contenteditable="true" oninput="handleInput()" onfocus="handleInput()" onblur="handleInput()"><?php echo $Car['Apraksts']?></div>
            <div class="placeholder-text" id="placeholder">Uzraksti aprakstu...</div>
            <div class="review_char-limit" id="char-count">0 / 2500</div>
        </div>
    </div>

    <div class="features-section">

        <div class="feature-box">
            <div class="feature-title"><h1>Komforts un salons</h1></div>

            <div class="checkbox-box">
                <input type="checkbox" id="feature-1" name="Komforts" value="1" <?= in_array(1, $active_ids) ? 'checked' : '' ?>>
                <label for="feature-1">Ādas salons</label>
            </div>
            <div class="checkbox-box">
                <input type="checkbox" id="feature-2" name="Komforts"  value="2" <?= in_array(2, $active_ids) ? 'checked' : '' ?>>
                <label for="feature-2">Auduma salons</label>
            </div>
            <div class="checkbox-box">
                <input type="checkbox" id="feature-3" name="Komforts"  value="3" <?= in_array(3, $active_ids) ? 'checked' : '' ?>>
                <label for="feature-3">Alcantara apdare</label>
            </div>
            <div class="checkbox-box">
                <input type="checkbox" id="feature-4" name="Komforts"  value="4" <?= in_array(4, $active_ids) ? 'checked' : '' ?>>
                <label for="feature-4">Elektriski regulējami sēdekļi</label>
            </div>
            <div class="checkbox-box">
                <input type="checkbox" id="feature-5" name="Komforts"  value="5" <?= in_array(5, $active_ids) ? 'checked' : '' ?>>
                <label for="feature-5">Sēdekļu atmiņas funkcija</label>
            </div>
            <div class="checkbox-box">
                <input type="checkbox" id="feature-6" name="Komforts"  value="6" <?= in_array(6, $active_ids) ? 'checked' : '' ?>>
                <label for="feature-6">Priekšējo sēdekļu apsilde</label>
            </div>
            <div class="checkbox-box">
                <input type="checkbox" id="feature-7" name="Komforts"  value="7" <?= in_array(7, $active_ids) ? 'checked' : '' ?>>
                <label for="feature-7">Aizmugurējo sēdekļu apsilde</label>
            </div>
            <div class="checkbox-box">
                <input type="checkbox" id="feature-8" name="Komforts"  value="8" <?= in_array(8, $active_ids) ? 'checked' : '' ?>>
                <label for="feature-8">Sēdekļu ventilācija</label>
            </div>
            <div class="checkbox-box">
                <input type="checkbox" id="feature-9" name="Komforts"  value="9" <?= in_array(9, $active_ids) ? 'checked' : '' ?>>
                <label for="feature-9">Sēdekļu masāža</label>
            </div>
            <div class="checkbox-box">
                <input type="checkbox" id="feature-10" name="Komforts"  value="10" <?= in_array(10, $active_ids) ? 'checked' : '' ?>>
                <label for="feature-10">Multikontūru sēdekļi</label>
            </div>
            <div class="checkbox-box">
                <input type="checkbox" id="feature-11" name="Komforts"  value="11" <?= in_array(11, $active_ids) ? 'checked' : '' ?>>
                <label for="feature-11">Koka apdare salonā</label>
            </div>
            <div class="checkbox-box">
                <input type="checkbox" id="feature-12" name="Komforts"  value="12" <?= in_array(12, $active_ids) ? 'checked' : '' ?>>
                <label for="feature-12">Stūres regulēšana</label>
            </div>
            <div class="checkbox-box">
                <input type="checkbox" id="feature-13" name="Komforts"  value="13" <?= in_array(13, $active_ids) ? 'checked' : '' ?>>
                <label for="feature-13">Stūres apsilde</label>
            </div>
            <div class="checkbox-box">
                <input type="checkbox" id="feature-14" name="Komforts"  value="14" <?= in_array(14, $active_ids) ? 'checked' : '' ?>>
                <label for="feature-14">Multifunkcionāla stūre</label>
            </div>
            <div class="checkbox-box">
                <input type="checkbox" id="feature-15" name="Komforts"  value="15" <?= in_array(15, $active_ids) ? 'checked' : '' ?>>
                <label for="feature-15">Kruīza kontrole</label>
            </div>
            <div class="checkbox-box">
                <input type="checkbox" id="feature-16" name="Komforts"  value="16" <?= in_array(16, $active_ids) ? 'checked' : '' ?>>
                <label for="feature-16">Adaptīvā kruīza kontrole</label>
            </div>
            <div class="checkbox-box">
                <input type="checkbox" id="feature-17" name="Komforts"  value="17" <?= in_array(17, $active_ids) ? 'checked' : '' ?>>
                <label for="feature-17">Klimata kontrole</label>
            </div>
            <div class="checkbox-box">
                <input type="checkbox" id="feature-18" name="Komforts"  value="18" <?= in_array(18, $active_ids) ? 'checked' : '' ?>>
                <label for="feature-18">Gaisa kondicionieris</label>
            </div>
            <div class="checkbox-box">
                <input type="checkbox" id="feature-19" name="Komforts"  value="19" <?= in_array(19, $active_ids) ? 'checked' : '' ?>>
                <label for="feature-19">Vējstikla apsilde</label>
            </div>
            <div class="checkbox-box">
                <input type="checkbox" id="feature-20" name="Komforts"  value="20" <?= in_array(20, $active_ids) ? 'checked' : '' ?>>
                <label for="feature-20">Apsildāmi spoguļi</label>
            </div>
            <div class="checkbox-box">
                <input type="checkbox" id="feature-21" name="Komforts"  value="21" <?= in_array(21, $active_ids) ? 'checked' : '' ?>>
                <label for="feature-21">Elektriskie logu pacēlāji</label>
            </div>
            <div class="checkbox-box">
                <input type="checkbox" id="feature-22" name="Komforts"  value="22" <?= in_array(22, $active_ids) ? 'checked' : '' ?>>
                <label for="feature-22">Elektriski regulējami spoguļi</label>
            </div>
            <div class="checkbox-box">
                <input type="checkbox" id="feature-23" name="Komforts"  value="23" <?= in_array(23, $active_ids) ? 'checked' : '' ?>>
                <label for="feature-23">Spoguļi ar automātisko aptumšošanos</label>
            </div>
            <div class="checkbox-box">
                <input type="checkbox" id="feature-24" name="Komforts"  value="24" <?= in_array(24, $active_ids) ? 'checked' : '' ?>>
                <label for="feature-24">Elektriska bagāžnieka atvēršana</label>
            </div>
            <div class="checkbox-box">
                <input type="checkbox" id="feature-25" name="Komforts"  value="25" <?= in_array(25, $active_ids) ? 'checked' : '' ?>>
                <label for="feature-25">Lūka</label>
            </div>
            <div class="checkbox-box">
                <input type="checkbox" id="feature-26" name="Komforts"  value="26" <?= in_array(26, $active_ids) ? 'checked' : '' ?>>
                <label for="feature-26">Saulessargi aizmugurējiem logiem</label>
            </div>
            <div class="checkbox-box">
                <input type="checkbox" id="feature-27" name="Komforts"  value="27" <?= in_array(27, $active_ids) ? 'checked' : '' ?>>
                <label for="feature-27">Ambient apgaismojums salonā</label>
            </div>
        </div>

        <div class="feature-box">
            <div class="feature-title"><h1>Multivide un navigācija</h1></div>

            <div class="checkbox-box">
                <input type="checkbox" id="feature-28" name="Komforts"  value="28" <?= in_array(28, $active_ids) ? 'checked' : '' ?>>
                <label for="feature-28">Audio sistēma</label>
            </div>
            <div class="checkbox-box">
                <input type="checkbox" id="feature-29" name="Komforts"  value="29" <?= in_array(29, $active_ids) ? 'checked' : '' ?>>
                <label for="feature-29">CD / MP3 atskaņotājs</label>
            </div>
            <div class="checkbox-box">
                <input type="checkbox" id="feature-30" name="Komforts"  value="30" <?= in_array(30, $active_ids) ? 'checked' : '' ?>>
                <label for="feature-30">Bluetooth</label>
            </div>
            <div class="checkbox-box">
                <input type="checkbox" id="feature-31" name="Komforts"  value="31" <?= in_array(31, $active_ids) ? 'checked' : '' ?>>
                <label for="feature-31">AUX pieslēgums</label>
            </div>
            <div class="checkbox-box">
                <input type="checkbox" id="feature-32" name="Komforts"  value="32" <?= in_array(32, $active_ids) ? 'checked' : '' ?>>
                <label for="feature-32">USB pieslēgums</label>
            </div>
            <div class="checkbox-box">
                <input type="checkbox" id="feature-33" name="Komforts"  value="33" <?= in_array(33, $active_ids) ? 'checked' : '' ?>>
                <label for="feature-33">Navigācijas sistēma</label>
            </div>
            <div class="checkbox-box">
                <input type="checkbox" id="feature-34" name="Komforts"  value="34" <?= in_array(34, $active_ids) ? 'checked' : '' ?>>
                <label for="feature-34">Skārienjutīgs ekrāns</label>
            </div>
            <div class="checkbox-box">
                <input type="checkbox" id="feature-35" name="Komforts"  value="35" <?= in_array(35, $active_ids) ? 'checked' : '' ?>>
                <label for="feature-35">Android Auto / Apple CarPlay</label>
            </div>
            <div class="checkbox-box">
                <input type="checkbox" id="feature-36" name="Komforts"  value="36" <?= in_array(36, $active_ids) ? 'checked' : '' ?>>
                <label for="feature-36">TV uztvērējs</label>
            </div>
            <div class="checkbox-box">
                <input type="checkbox" id="feature-37" name="Komforts"  value="37" <?= in_array(37, $active_ids) ? 'checked' : '' ?>>
                <label for="feature-37">Multivide aizmugurējiem pasažieriem</label>
            </div>
            <div class="checkbox-box">
                <input type="checkbox" id="feature-38" name="Komforts"  value="38" <?= in_array(38, $active_ids) ? 'checked' : '' ?>>
                <label for="feature-38">Atpakaļskata kamera</label>
            </div>
            <div class="checkbox-box">
                <input type="checkbox" id="feature-39" name="Komforts"  value="39" <?= in_array(39, $active_ids) ? 'checked' : '' ?>>
                <label for="feature-39">360° skata kameras</label>
            </div>
            <div class="checkbox-box">
                <input type="checkbox" id="feature-40" name="Komforts"  value="40" <?= in_array(40, $active_ids) ? 'checked' : '' ?>>
                <label for="feature-40">Projekcija uz vējstikla</label>
            </div>
            <div class="checkbox-box">
                <input type="checkbox" id="feature-41" name="Komforts"  value="41" <?= in_array(41, $active_ids) ? 'checked' : '' ?>>
                <label for="feature-41">Iebūvēta sakaru sistēma</label>
            </div>
        </div>

        <div class="feature-box">
            <div class="feature-title"><h1>Drošība</h1></div>

            <div class="checkbox-box">
                <input type="checkbox" id="feature-42" name="Komforts"  value="42" <?= in_array(42, $active_ids) ? 'checked' : '' ?>>
                <label for="feature-42">ABS</label>
            </div>
            <div class="checkbox-box">
                <input type="checkbox" id="feature-43" name="Komforts"  value="43" <?= in_array(43, $active_ids) ? 'checked' : '' ?>>
                <label for="feature-43">ESP</label>
            </div>
            <div class="checkbox-box">
                <input type="checkbox" id="feature-44" name="Komforts"  value="44" <?= in_array(44, $active_ids) ? 'checked' : '' ?>>
                <label for="feature-44">EBD</label>
            </div>
            <div class="checkbox-box">
                <input type="checkbox" id="feature-45" name="Komforts"  value="45" <?= in_array(45, $active_ids) ? 'checked' : '' ?>>
                <label for="feature-45">Automātiskā parkošanās sistēma</label>
            </div>
            <div class="checkbox-box">
                <input type="checkbox" id="feature-46" name="Komforts"  value="46" <?= in_array(46, $active_ids) ? 'checked' : '' ?>>
                <label for="feature-46">Parkošanās sensori</label>
            </div>
            <div class="checkbox-box">
                <input type="checkbox" id="feature-47" name="Komforts"  value="47" <?= in_array(47, $active_ids) ? 'checked' : '' ?>>
                <label for="feature-47">Joslas saglabāšanas asistents</label>
            </div>
            <div class="checkbox-box">
                <input type="checkbox" id="feature-48" name="Komforts"  value="48" <?= in_array(48, $active_ids) ? 'checked' : '' ?>>
                <label for="feature-48">Aklās zonas uzraudzība</label>
            </div>
            <div class="checkbox-box">
                <input type="checkbox" id="feature-49" name="Komforts"  value="49" <?= in_array(49, $active_ids) ? 'checked' : '' ?>>
                <label for="feature-49">Adaptīvās gaismas</label>
            </div>
            <div class="checkbox-box">
                <input type="checkbox" id="feature-50" name="Komforts"  value="50" <?= in_array(50, $active_ids) ? 'checked' : '' ?>>
                <label for="feature-50">Automātiska tālo gaismu pārslēgšana</label>
            </div>
            <div class="checkbox-box">
                <input type="checkbox" id="feature-51" name="Komforts"  value="51" <?= in_array(51, $active_ids) ? 'checked' : '' ?>>
                <label for="feature-51">Automātiskā bremzēšana</label>
            </div>
            <div class="checkbox-box">
                <input type="checkbox" id="feature-52" name="Komforts"  value="52" <?= in_array(52, $active_ids) ? 'checked' : '' ?>>
                <label for="feature-52">Noguruma detektors</label>
            </div>
            <div class="checkbox-box">
                <input type="checkbox" id="feature-53" name="Komforts"  value="53" <?= in_array(53, $active_ids) ? 'checked' : '' ?>>
                <label for="feature-53">Gaisa spilveni</label>
            </div>
            <div class="checkbox-box">
                <input type="checkbox" id="feature-54" name="Komforts"  value="54" <?= in_array(54, $active_ids) ? 'checked' : '' ?>>
                <label for="feature-54">ISOFIX stiprinājumi</label>
            </div>
            <div class="checkbox-box">
                <input type="checkbox" id="feature-55" name="Komforts"  value="55" <?= in_array(55, $active_ids) ? 'checked' : '' ?>>
                <label for="feature-55">Imobilaizers</label>
            </div>
            <div class="checkbox-box">
                <input type="checkbox" id="feature-56" name="Komforts"  value="56" <?= in_array(56, $active_ids) ? 'checked' : '' ?>>
                <label for="feature-56">Signalizācija</label>
            </div>
            <div class="checkbox-box">
                <input type="checkbox" id="feature-57" name="Komforts"  value="57" <?= in_array(57, $active_ids) ? 'checked' : '' ?>>
                <label for="feature-57">Centrālā atslēga</label>
            </div>
            <div class="checkbox-box">
                <input type="checkbox" id="feature-58" name="Komforts"  value="58" <?= in_array(58, $active_ids) ? 'checked' : '' ?>>
                <label for="feature-58">Riepu spiediena kontrole</label>
            </div>
        </div>

    </div>

    <div class="car-info-contacts">
        <div class="contacts-details">
            <div class="contacts-box">
                <p>Pilsēta:</p>                
                <select name="location" required id="pilsetaSelectEdit">
                    <option value="<?php echo $Car['Pilseta']?>" hidden><?php echo $Car['Pilseta']?></option>

                    <optgroup label="A">
                        <option value="Aizkraukle">Aizkraukle</option>
                        <option value="Aizpute">Aizpute</option>
                        <option value="Aknīste">Aknīste</option>
                        <option value="Aloja">Aloja</option>
                        <option value="Alūksne">Alūksne</option>
                        <option value="Auce">Auce</option>
                    </optgroup>

                    <optgroup label="B">
                        <option value="Balvi">Balvi</option>
                        <option value="Bauska">Bauska</option>
                        <option value="Brocēni">Brocēni</option>
                        <option value="Burtnieki">Burtnieki</option>
                    </optgroup>

                    <optgroup label="C">
                        <option value="Cēsis">Cēsis</option>
                        <option value="Cesvaine">Cesvaine</option>
                        <option value="Carnikava">Carnikava</option>
                    </optgroup>

                    <optgroup label="D">
                        <option value="Dagda">Dagda</option>
                        <option value="Daugavpils">Daugavpils</option>
                        <option value="Dobele">Dobele</option>
                        <option value="Dundaga">Dundaga</option>
                    </optgroup>

                    <optgroup label="G">
                        <option value="Gulbene">Gulbene</option>
                    </optgroup>

                    <optgroup label="J">
                        <option value="Jēkabpils">Jēkabpils</option>
                        <option value="Jelgava">Jelgava</option>
                        <option value="Jūrmala">Jūrmala</option>
                    </optgroup>

                    <optgroup label="K">
                        <option value="Kandava">Kandava</option>
                        <option value="Kārsava">Kārsava</option>
                        <option value="Koknese">Koknese</option>
                        <option value="Krāslava">Krāslava</option>
                        <option value="Kuldīga">Kuldīga</option>
                    </optgroup>

                    <optgroup label="L">
                        <option value="Liepāja">Liepāja</option>
                        <option value="Līgatne">Līgatne</option>
                        <option value="Limbaži">Limbaži</option>
                        <option value="Līvāni">Līvāni</option>
                        <option value="Ludza">Ludza</option>
                    </optgroup>

                    <optgroup label="M">
                        <option value="Madona">Madona</option>
                        <option value="Mazsalaca">Mazsalaca</option>
                        <option value="Mazirbe">Mazirbe</option>
                    </optgroup>

                    <optgroup label="O">
                        <option value="Ogre">Ogre</option>
                        <option value="Olaine">Olaine</option>
                    </optgroup>

                    <optgroup label="P">
                        <option value="Preiļi">Preiļi</option>
                        <option value="Pļaviņas">Pļaviņas</option>
                    </optgroup>

                    <optgroup label="R">
                        <option value="Rēzekne">Rēzekne</option>
                        <option value="Rīga">Rīga</option>
                        <option value="Rojas novads">Rojas novads</option>
                        <option value="Ropaži">Ropaži</option>
                    </optgroup>

                    <optgroup label="S">
                        <option value="Salacgrīva">Salacgrīva</option>
                        <option value="Saldus">Saldus</option>
                        <option value="Saulkrasti">Saulkrasti</option>
                        <option value="Sigulda">Sigulda</option>
                        <option value="Smiltene">Smiltene</option>
                        <option value="Strenči">Strenči</option>
                    </optgroup>

                    <optgroup label="T">
                        <option value="Talsi">Talsi</option>
                        <option value="Tukums">Tukums</option>
                    </optgroup>

                    <optgroup label="V">
                        <option value="Valka">Valka</option>
                        <option value="Valmiera">Valmiera</option>
                        <option value="Varakļāni">Varakļāni</option>
                        <option value="Ventspils">Ventspils</option>
                        <option value="Viļaka">Viļaka</option>
                        <option value="Viļāni">Viļāni</option>
                    </optgroup>
                </select>
            </div>
            <div class="contacts-box">
                <p>VIN:</p>
                <input type="text" required id="winInput" placeholder="<?php echo $Car['Vin']?>" value="<?php echo $Car['Vin']?>">
            </div>
            <div class="contacts-box">
                <p>Tālrunis: <span><?php echo $_SESSION['telefonsHOMIK'];?></span></p>
            </div> 
            <div class="contacts-box">
                <p>Cena:</p>
                <input type="number" required id="cenaInput" placeholder="<?php echo $Car['Cena']?>" value="<?php echo $Car['Cena']?>">
                <p>€</p>
            </div>
        </div>

        <input type="hidden" value="<?php echo $Car['Cars_ID']?>" id="CarInputEdint">
        <button id="redButton"><i class="fas fa-pen"></i>Rediģēt</button>

    </div>

    </form>

</section>

<?php 

require "../../footer.php"; 

}else{
header("Location: /");
exit;
}

}else{
header("Location: /");
exit;
}
?>
