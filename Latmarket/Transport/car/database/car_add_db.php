<?php
require "con_db_transports.php";
session_start();

$response = ['success' => false];

$marka = htmlspecialchars($_POST['marka']);
$modelis = htmlspecialchars($_POST['modelis']);
$gads = htmlspecialchars($_POST['gads']);
$virsBuve = htmlspecialchars($_POST['virsBuve']);
$tilpums = htmlspecialchars($_POST['tilpums']);
$tilpums_attirits = str_replace(',', '.', $tilpums);

$jauda = htmlspecialchars($_POST['jauda']);
$atrumkarba = htmlspecialchars($_POST['atrumkarba']);
$degviela = htmlspecialchars($_POST['degviela']);
$piedzina = htmlspecialchars($_POST['piedzina']);
$nobraukums = htmlspecialchars($_POST['nobraukums']);
$krasa = htmlspecialchars($_POST['krasa']);
$apskate = htmlspecialchars($_POST['apskate']);
$apskates_datums = new DateTime($apskate);
$aktualaisLaiks = new DateTime();
$aktualaisLaiks->setTime(0, 0, 0);

$apraksts = $_POST['apraksts'];
$apraksts_bez_tegiem = strip_tags($apraksts);
$garums = mb_strlen($apraksts_bez_tegiem, 'UTF-8');

$komplektacijas_json = $_POST['komplektacijas'] ?? '';
$komplektacijas = json_decode($komplektacijas_json, true);

$pilseta = htmlspecialchars($_POST['pilseta']);
$vin = strtoupper(trim(htmlspecialchars($_POST['vin'])));
$cena = strtoupper(trim(htmlspecialchars($_POST['cena'])));


$autors = $_SESSION['IdHOMIK'];
$status = "not paid";
$price = "500";
$table = "Cars";

$virsbuvesTypes = [
    "Sedans", "Kupē", "Hečbeks", "Liftbeks", "Fastbeks", "Universāls",
    "Krosovers", "Apvidus auto", "Pikaps", "Vieglā kravas automašīna",
    "Minivens", "Kompaktvans", "Mikrovens", "Kabriolets", "Rodsters",
    "Targa", "Lando", "Limuzīns"
];

$markaTypes = [
    "Acura", "Alfa Romeo", "Aston Martin", "Audi",
    "Bentley", "BMW", "Bugatti", "Buick", "BYD",
    "Cadillac", "Chevrolet", "Chrysler", "Citroën",
    "Daewoo", "Daihatsu", "Dodge",
    "Exeed",
    "Ferrari", "Fiat", "Ford",
    "GAZ", "Geely", "Genesis", "GMC", "Great Wall",
    "Haval", "Honda", "Hongqi", "Hyundai",
    "Infiniti",
    "JAC", "Jeep", "Jetour",
    "Kia", "Koenigsegg",
    "Lada", "Lamborghini", "Land Rover", "Lexus", "Lifan", "Lincoln", "Lotus",
    "Maserati", "Maybach", "Mazda", "McLaren", "Mercedes-Benz", "Mitsubishi",
    "Nissan",
    "Opel",
    "Pagani", "Peugeot", "Porsche",
    "Renault", "Rimac", "Rolls-Royce",
    "Seat", "Skoda", "Subaru", "Suzuki",
    "Tesla", "Toyota",
    "UAZ",
    "Volkswagen", "Volvo",
    "Zeekr"
];

$FuelTypes = [
    "Benzīns",
    "Benzīns/gāze",
    "Dīzelis",
    "Hybrīd",
    "Elektriskais"
];

$Drivetrains = [
    "Priekšējā piedziņa",
    "Aizmugurējā piedziņa",
    "Pilnpiedziņa"
];

$allowedColors = [
    "Melna",
    "Balta",
    "Brūna",
    "Sarkana",
    "Dzeltena",
    "Zila",
    "Oraņža",
    "Violeta",
    "Pelēka",
    "Sudraba"
];

$allowedLocations = [
    "Aizkraukle", "Aizpute", "Aknīste", "Aloja", "Alūksne", "Auce",
    "Balvi", "Bauska", "Brocēni", "Burtnieki",
    "Cēsis", "Cesvaine", "Carnikava",
    "Dagda", "Daugavpils", "Dobele", "Dundaga",
    "Gulbene",
    "Jēkabpils", "Jelgava", "Jūrmala",
    "Kandava", "Kārsava", "Koknese", "Krāslava", "Kuldīga",
    "Liepāja", "Līgatne", "Limbaži", "Līvāni", "Ludza",
    "Madona", "Mazsalaca", "Mazirbe",
    "Ogre", "Olaine",
    "Preiļi", "Pļaviņas",
    "Rēzekne", "Rīga", "Rojas novads", "Ropaži",
    "Salacgrīva", "Saldus", "Saulkrasti", "Sigulda", "Smiltene", "Strenči",
    "Talsi", "Tukums",
    "Valka", "Valmiera", "Varakļāni", "Ventspils", "Viļaka", "Viļāni"
];

function isValidVIN(string $vin): bool {
    $vin = strtoupper($vin);
    if (strlen($vin) !== 17 || !preg_match('/^[A-HJ-NPR-Z0-9]{17}$/', $vin)) {
        return false;
    }

    return true; 
}


if (empty($marka) || empty($gads) || empty($virsBuve) || empty($tilpums) || empty($atrumkarba) 
    || empty($degviela) || empty($piedzina) || empty($nobraukums) || empty($krasa) || 
    empty($pilseta) || empty($vin) || empty($cena) || empty($modelis) || $modelis === null || $modelis === "" || $modelis === "null") {
    $response['error'] = "Visi lauki nav aizpildīti!";
    echo json_encode($response);
    exit;
}

if (!in_array($marka, $markaTypes)) {
    $response['error'] = "Nav norādīti korekti Marka!";
    echo json_encode($response);
    exit;
}

if ($gads < 1950 || $gads > date("Y")) {
    $response['error'] = "Nav norādīts pareizs izlaiduma gads!";
    echo json_encode($response);
    exit;
}

if (!in_array($virsBuve, $virsbuvesTypes)) {
    $response['error'] = "Nav norādīts korekts virsbūves tips!";
    echo json_encode($response);
    exit;
}

if (!filter_var($jauda, FILTER_VALIDATE_INT, ["options" => ["min_range" => 1, "max_range" => 3000]])) {
    $response['error'] = "Nav norādīta korekta jauda!";
    echo json_encode($response);
    exit;
}

if ($atrumkarba !== "Automāts" && $atrumkarba !== "Manuāla") {
    $response['error'] = "Nav norādīta korekta ātrumkārba!";
    echo json_encode($response);
    exit;
}

if (!in_array($degviela, $FuelTypes)) {
    $response['error'] = "Nav norādīta korekta degviela!";
    echo json_encode($response);
    exit;
}

if (!in_array($piedzina, $Drivetrains)) {
    $response['error'] = "Nav norādīta korekta piedziņa!";
    echo json_encode($response);
    exit;
}

if (!filter_var($nobraukums, FILTER_VALIDATE_INT, ["options" => ["min_range" => 0, "max_range" => 1500000]])) {
    $response['error'] = "Nav norādīts korekts nobraukums!";
    echo json_encode($response);
    exit;
}

if (!in_array($krasa, $allowedColors)) {
    $response['error'] = "Nav norādīta korekta krāsa!";
    echo json_encode($response);
    exit;
}

if (!in_array($pilseta, $allowedLocations)) {
    $response['error'] = "Nav norādīta korekta pilsēta!";
    echo json_encode($response);
    exit;
}

if (!isValidVIN($vin)) {
    $response['error'] = "Nav norādīts korekts VIN!";
    echo json_encode($response);
    exit;
}

if (!is_numeric($cena) || floatval($cena) < 0) {
    $response['error'] = "Cena jābūt skaitlim un lielāka vai vienāda ar nulli!";
    echo json_encode($response);
    exit;
}

if (!preg_match('/^(?:[1-9]|10)(?:\.\d{1})?$/', $tilpums_attirits)) {
    $response['error'] = "Lūdzu, norādiet korektu dzinēja tilpumu (piemēram, 1.5, 3.0)!";
    echo json_encode($response);
    exit;
}

$tilpums_skaitlis = floatval($tilpums_attirits);

if ($tilpums_skaitlis < 1 || $tilpums_skaitlis > 10) {
    $response['error'] = "Dzinēja tilpumam jābūt diapazonā no 1 līdz 10!";
    echo json_encode($response);
    exit;
}

if (fmod($tilpums_skaitlis, 1) == 0) {
    $tilpums_db = intval($tilpums_skaitlis); 
} else {
    $tilpums_db = round($tilpums_skaitlis, 1); 
}

if ($komplektacijas === null) {
    $response = ['success' => false, 'error' => 'Nepareizs konfigurācijas datu formāts!'];
    echo json_encode($response);
    exit();
}

if ($apskates_datums < $aktualaisLaiks) {
    $response['error'] = "Tehniskās apskates datums nevar būt pagātnē!";
    echo json_encode($response);
    exit;
}

if ($garums > 5000) {
    $response['error'] = "Apraksts nedrīkst būt garāks par 5000 simboliem!";
    echo json_encode($response);
    exit;
}


$vaicajums = $savienojums->prepare("INSERT INTO Cars (Marka, Modelis, Izladuma_gads, Virsbuves_tips, Dzinejs, Jauda, Atrumkarba_tips, Bezina_tips, Piedzina, Nobrakums, Krasa, Pilseta, Vin, Cena, autora_id, Statuss, Tehniska_apskate, Apraksts) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$vaicajums->bind_param("ssisdisssisssdisss", $marka, $modelis, $gads, $virsBuve, $tilpums_db, $jauda, $atrumkarba, $degviela, $piedzina, $nobraukums, $krasa, $pilseta, $vin, $cena, $autors, $status, $apskate, $apraksts);

if ($vaicajums->execute()) {
    $car_id = $savienojums->insert_id;
    $komplektacijas_pievienotas = true;

    $komplektacija = $savienojums->prepare("INSERT INTO Car_komplektacija (Car_ID, Komplektacijas_id) VALUES (?, ?)");
    $komplektacija->bind_param("ii", $car_id, $komplektacijas_id);

    foreach ($komplektacijas as $komplektacijas_id) {
        if (!$komplektacija->execute()) {
            $komplektacijas_pievienotas = false;
            $response['error'] = "Kļūda, pievienojot komplektācijas.";
            break; 
        }
    }

    if ($komplektacijas_pievienotas) {
        $paymentUrl = "/payment/cheсkout.php?announcement=" . $car_id . "&price=" . urlencode($price) . "&table=" . urlencode($table);
        $response['success'] = true;
        $response['message'] = "Auto un komplektācijas veiksmīgi pievienotas.";
        $response['payment_url'] = $paymentUrl;
    } else if (!isset($response['error'])) {
        $response['success'] = true;
        $response['message'] = "Auto veiksmīgi pievienots.";
        $paymentUrl = "/payment/cheсkout.php?announcement=" . $car_id . "&price=" . urlencode($price) . "&table=" . urlencode($table);
        $response['payment_url'] = $paymentUrl;
    }

    $komplektacija->close();

} else {
    $response['error'] = "Sistēmas kļūda.";
}

$savienojums->close();
echo json_encode($response);
exit;
?>
