<?php
require "con_db_transports.php";
session_start();

$response = [];

$marka = htmlspecialchars($_POST['marka']);
// $modelis = htmlspecialchars($_POST['modelis']);
$gads = htmlspecialchars($_POST['gads']);
$virsBuve = htmlspecialchars($_POST['virsBuve']);
$tilpums = htmlspecialchars($_POST['tilpums']);
$jauda = htmlspecialchars($_POST['jauda']);
$atrumkarba = htmlspecialchars($_POST['atrumkarba']);
$degviela = htmlspecialchars($_POST['degviela']);
$piedzina = htmlspecialchars($_POST['piedzina']);
$nobraukums = htmlspecialchars($_POST['nobraukums']);
$krasa = htmlspecialchars($_POST['krasa']);
$apskate = htmlspecialchars($_POST['apskate']);
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

if (!empty($marka) && !empty($gads) && !empty($virsBuve) && !empty($tilpums) && 
    !empty($jauda) && !empty($atrumkarba) && !empty($degviela) && !empty($piedzina) 
    && !empty($nobraukums) && !empty($krasa) && !empty($krasa) && !empty($pilseta) 
    && !empty($vin) && !empty($cena)) { 

    if (in_array($marka, $markaTypes)) { 
        if ($gads >= 1950 && $gads <= date("Y")) { 
            if (in_array($virsBuve, $virsbuvesTypes)) { 
                if (filter_var($jauda, FILTER_VALIDATE_INT, ["options" => ["min_range" => 1,"max_range" => 3000]])){
                    if ($atrumkarba == "Automāts" || $atrumkarba == "Manuāla") { 
                        if (in_array($degviela, $FuelTypes)) {
                            if (in_array($piedzina, $Drivetrains)) {
                                if (filter_var($nobraukums, FILTER_VALIDATE_INT, ["options" => ["min_range" => 0,"max_range" => 1500000]])) {
                                    if (in_array($krasa, $allowedColors)) {
                                        if (in_array($pilseta, $allowedLocations)) {
                                            if (isValidVIN($vin)) {
                                                if (is_numeric($cena)) {
                                                    if (floatval($cena) >= 0) {
                                                        if (filter_var($tilpums, FILTER_VALIDATE_INT, ["options" => ["min_range" => 1,"max_range" => 10]])){

                                                            $vaicajums = $savienojums->prepare("INSERT INTO Cars (Marka, Izladuma_gads, Virsbuves_tips, Dzinejs, Jauda, Atrumkarba_tips, Bezina_tips, Piedzina, Nobrakums, Krasa, Pilseta, Vin, Cena, autora_id, Statuss) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                                                            $vaicajums->bind_param("sisdisssisisdis", $marka, $gads, $virsBuve, $tilpums, $jauda, $atrumkarba, $degviela, $piedzina, $nobraukums, $krasa, $pilseta, $vin, $cena, $autors, $status);

                                                            if ($vaicajums->execute()) {
                                                                $insertedId = $savienojums->insert_id;
                                                                $paymentUrl = "/payment/cheсkout.php?announcement=" . $insertedId . "&price=" . urlencode($price) . "&table=" . urlencode($table);
                                                                
                                                                $response['success'] = true;
                                                                $response['message'] = "Auto veiksmīgi pievienots.";
                                                                $response['payment_url'] = $paymentUrl;
                                                            } else {
                                                                $response['success'] = false;
                                                                $response['error'] = "Sistēmas kļūda.";
                                                            }

                                                        } else {
                                                            $response['success'] = false;
                                                            $response['error'] = "Nav noradīta korekti Tilpums!"; 
                                                        } 
                                                    } else {
                                                        $response['success'] = false;
                                                        $response['error'] = "Cenai jābūt lielākai par nulli!"; 
                                                    }
                                                } else {
                                                    $response['success'] = false;
                                                    $response['error'] = "Cenai jābūt skaitlim!";
                                                }
                                            } else {
                                                $response['success'] = false;
                                                $response['error'] = "Nav noradīta korekti VIN!"; 
                                            }
                                        } else {
                                            $response['success'] = false;
                                            $response['error'] = "Nav noradīta korekti pilsēta!";
                                        }
                                    } else {
                                        $response['success'] = false;
                                        $response['error'] = "Nav noradīta korekti krāsa!";
                                    }
                                } else {
                                    $response['success'] = false;
                                    $response['error'] = "Nav noradīta korekti nobrakums!";
                                }
                            } else {
                                $response['success'] = false;
                                $response['error'] = "Nav noradīta korekti piedziņa!";
                            }
                        } else {
                            $response['success'] = false;
                            $response['error'] = "Nav noradīta korekti degviela!";
                        }
                    } else {
                        $response['success'] = false;
                        $response['error'] = "Nav noradīta korekti ātrumkārba!";
                    }
                } else {
                    $response['success'] = false;
                    $response['error'] = "Nav noradīta korekti jauda!";
                }
            } else {
                $response['success'] = false;
                $response['error'] = "Nav noradīti korekti virsbūves tips!";
            }
        } else {
            $response['success'] = false;
            $response['error'] = "Nav noradīts pareizs izlaiduma gads!";
        }
    }else {
            $response['success'] = false;
            $response['error'] = "Nav noradīti korekti Marka!";
        }
} else {
    $response['success'] = false;
    $response['error'] = "Visi lauki nav aizpilditi!";
}

$savienojums->close();
echo json_encode($response);
exit;
?>
