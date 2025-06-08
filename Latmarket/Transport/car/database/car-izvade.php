<?php
require "con_db_transports.php";
session_start();

$modelis = $_POST['modelis'] ?? null;
$marka = $_POST['marka'] ?? null;
$benzina_tips = $_POST['benzina_tips'] ?? null;
$atrumkarba = $_POST['atrumkarba'] ?? null;
$virsbuve = $_POST['virsbuve'] ?? null;
$piedzina = $_POST['piedzina'] ?? null;
$krasa = $_POST['krasa'] ?? null;
$min_cena = $_POST['min_cena'] ?? null;
$max_cena = $_POST['max_cena'] ?? null;
$min_gads = $_POST['min_gads'] ?? null;
$max_gads = $_POST['max_gads'] ?? null;
$min_nobrakums = $_POST['min_nobrakums'] ?? null;
$max_nobrakums = $_POST['max_nobrakums'] ?? null;
$min_jauda = $_POST['min_jauda'] ?? null;
$max_jauda = $_POST['max_jauda'] ?? null;
$tehniska_apskate = $_POST['tehniska_apskate'] ?? null;
$dtp = $_POST['dtp'] ?? null;
$jauda_m = $_POST['jauda_m'] ?? 1;
$nobrakums_m = $_POST['nobrakums_m'] ?? 1;
$asc_filter = $_POST['asc_filter'] ?? null;


$filtrets = [];
$params = [];
$types = "";
$carsHTML = "";
$orderByClause = '';
$limit = 5;
$page = isset($_POST['page']) ? (int)$_POST['page'] : 1;
$offset = ($page - 1) * $limit;
$statusCondition = "Statuss = 'active'";

// ----------------------------------------Filter

function addFilter(&$filtrets, &$params, &$types, $column, $value, $operator = "=") {
    if ($value !== null && $value !== "") {
        $filtrets[] = "$column $operator ?";
        $params[] = $value;
        $types .= is_numeric($value) ? 'i' : 's';
    }
}

addFilter($filtrets, $params, $types, "Modelis", $modelis);
addFilter($filtrets, $params, $types, "Marka", $marka);
addFilter($filtrets, $params, $types, "Bezina_tips", $benzina_tips);
addFilter($filtrets, $params, $types, "Atrumkarba_tips", $atrumkarba);
addFilter($filtrets, $params, $types, "Virsbuves_tips", $virsbuve);
addFilter($filtrets, $params, $types, "Piedzina", $piedzina);
addFilter($filtrets, $params, $types, "Krasa", $krasa);
addFilter($filtrets, $params, $types, "Cena", $min_cena, ">=");
addFilter($filtrets, $params, $types, "Cena", $max_cena, "<=");
addFilter($filtrets, $params, $types, "Izladuma_gads", $min_gads, ">=");
addFilter($filtrets, $params, $types, "Izladuma_gads", $max_gads, "<=");
addFilter($filtrets, $params, $types, "Nobrakums", $min_nobrakums, ">=");
addFilter($filtrets, $params, $types, "Nobrakums", $max_nobrakums, "<=");
addFilter($filtrets, $params, $types, "Jauda", $min_jauda, ">=");
addFilter($filtrets, $params, $types, "Jauda", $max_jauda, "<=");

if ($tehniska_apskate == 1) { $filtrets[] = "Tehniska_apskate != 0"; }
if ($tehniska_apskate == 2) { $filtrets[] = "Tehniska_apskate = 0"; }
if ($dtp == 1) { $filtrets[] = "dtp != 0"; }
if ($dtp == 2) { $filtrets[] = "dtp = 0"; }

if ($asc_filter == "datums_desc"){ $orderByColumn = "datums"; $orderByDirection = "DESC"; }
if ($asc_filter == "datums_asc"){ $orderByColumn = "datums"; $orderByDirection = "ASC"; }
if ($asc_filter == "cena_asc"){ $orderByColumn = "Cena"; $orderByDirection = "ASC"; }
if ($asc_filter == "cena_desc"){ $orderByColumn = "Cena"; $orderByDirection = "DESC"; }
if ($asc_filter == "gads_desc"){ $orderByColumn = "Izladuma_gads"; $orderByDirection = "DESC"; }
if ($asc_filter == "gads_asc"){ $orderByColumn = "Izladuma_gads"; $orderByDirection = "ASC"; }
if ($asc_filter == "nobraukums_asc"){ $orderByColumn = "Nobrakums"; $orderByDirection = "ASC"; }
if ($asc_filter == "nobraukums_desc"){ $orderByColumn = "Nobrakums"; $orderByDirection = "DESC"; }
if ($asc_filter == "Tilpums_asc"){ $orderByColumn = "Dzinejs"; $orderByDirection = "ASC"; }
if ($asc_filter == "Tilpums_desc"){ $orderByColumn = "Dzinejs"; $orderByDirection = "DESC"; }
if ($asc_filter == "Jauda_asc"){ $orderByColumn = "Jauda"; $orderByDirection = "ASC"; }
if ($asc_filter == "Jauda_desc"){ $orderByColumn = "Jauda"; $orderByDirection = "DESC"; }

if (!empty($orderByColumn)) {
    $orderByClause = "ORDER BY " . $orderByColumn . " " . $orderByDirection;
}

if (count($filtrets) > 0) {
    $whereClause = "WHERE " . implode(" AND ", $filtrets) . " AND " . $statusCondition;
} else {
    $whereClause = "WHERE " . $statusCondition;
}

// ----------------------------------------Page count

$countSQL = "SELECT COUNT(*) AS total FROM Cars $whereClause";
$countStmt = $savienojums->prepare($countSQL);
if (!empty($params)) {
    $countStmt->bind_param($types, ...$params);
}
$countStmt->execute();
$countResult = $countStmt->get_result();
$totalRows = $countResult->fetch_assoc()['total'];
$totalPages = ceil($totalRows / $limit);

$params[] = $limit;
$params[] = $offset;
$types .= "ii";
$starIcon = "";

// ----------------------------------------Izvade

$carsSQL = "SELECT * FROM Cars $whereClause $orderByClause LIMIT ? OFFSET ?";
$carsStmt = $savienojums->prepare($carsSQL);
$carsStmt->bind_param($types, ...$params);
$carsStmt->execute();
$result = $carsStmt->get_result();

while ($Cars = $result->fetch_assoc()) {

    // ----------------------------------------Favorit icon

    if (session_status() === PHP_SESSION_ACTIVE && isset($_SESSION['lietotajvardsHOMIK'])) {

        $starIcon = "<i class='far fa-star fav'></i>";
        $favoritSQL = "SELECT * FROM favoriti WHERE lietotaja_id = ? AND table_name = 'Cars' AND item_id = ?";
        $favorit = $savienojums->prepare($favoritSQL);
        $favorit->bind_param("ii", $_SESSION['IdHOMIK'], $Cars['Cars_ID']);
        $favorit->execute();
        $favoritResult = $favorit->get_result();
        if ($favoritResult->num_rows > 0) {
            $starIcon = "<i class='fa fa-star fav'></i>";
        }
    }
    // ----------------------------------------fomated

    $formattedDzinejs = number_format($Cars['Dzinejs'], 1);
    $formtedCema = number_format($Cars['Cena'], 0, '', ' ') . ' €';

    $jauda_izvade = $Cars['Jauda'] == 0 ? '-' : (
        $jauda_m == 2 ? round($Cars['Jauda'] * 1.34102) . " HP" : $Cars['Jauda'] . " KW"
    );

    $nobraukums_izvade = $nobrakums_m == 2 ?
        round($Cars['Nobrakums'] * 0.621371) . " MPH" :
        $Cars['Nobrakums'] . " KM";

    // ----------------------------------------Photo

    $car_id_p = $Cars['Cars_ID'];
    $photosSQL = "SELECT photo FROM Cars_photos WHERE car_id = ? LIMIT 5";
    $photo = $savienojums->prepare($photosSQL);
    $photo->bind_param("i", $car_id_p);
    $photo->execute();
    $photosResult = $photo->get_result();

    $photoHTML = '';
    $buttonsHTML = '';
    $photoCount = 0;

    while ($photo = $photosResult->fetch_assoc()) {
        $base64Image = base64_encode($photo['photo']);
        $photoHTML .= "<img src='data:image/jpeg;base64,{$base64Image}'/>";
        $photoCount++;
    }

    for ($i = 0; $i < $photoCount; $i++) {
        $activeClass = ($i == 0) ? 'active' : '';
        $buttonsHTML .= "<button class='$activeClass'></button>";
    }

    // ----------------------------------------izvade

    $carsHTML .= "
    <div class='carsbox'>
        <div class='car-foto'>
            <form method='POST' action='car-parskate.php'>
                <button type='submit' name='carizvele' value='{$Cars['Cars_ID']}' class='cblink'></button>
            </form>
            <div class='photos-container' id='{$Cars['Cars_ID']}'>
                $photoHTML
            </div>
            <div class='photobtn' id='{$Cars['Cars_ID']}'>
                $buttonsHTML
            </div>
        </div>

        <div class='carinfo'>
            <div class='carNosFlex'>
                <div class='carNosakums'>
                    <h3>{$Cars['Marka']} {$Cars['Modelis']}</h3>
                    <div class='gads-fav'>
                        <p>{$Cars['Izladuma_gads']}</p>
                        <div class='favorits'>
                            <form class='favoriti'>
                                <input type='hidden' class='tb_name' value='Cars'>
                                <input type='hidden' class='item_id' value='{$Cars['Cars_ID']}'>
                                <button class='favBtn' title='Pievienot favorītos'>$starIcon</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class='carCena'>
                    <p>{$formtedCema}</p>
                </div>
            </div>

            <div class='infotable'>
                <div class='colon1'>
                    <div class='info-icon'><img src='../../image/icons/car-engine-icon.png'><p> Tilpums: {$formattedDzinejs}</p></div>
                    <div class='info-icon'><img src='../../image/icons/Odometr-icon.png'><p> Nobrakums: {$nobraukums_izvade}</p></div>
                    <div class='info-icon'><img src='../../image/icons/Piedzinas-icon.png'><p> Piedziņa: {$Cars['Piedzina']}</p></div>
                    <div class='info-icon'><img src='../../image/icons/Jauda-icon.png'><p> Jauda: {$jauda_izvade}</p></div>
                </div>
                <div class='colon2'>
                    <div class='info-icon'><img src='../../image/icons/AKKP-icon.png'><p> Atrumkārba: {$Cars['Atrumkarba_tips']}</p></div>
                    <div class='info-icon'><img src='../../image/icons/Oil-icon.png'><p> Degviela: {$Cars['Bezina_tips']}</p></div>
                    <div class='info-icon'><img src='../../image/icons/Krasas-icon.png'><p> Krāsa: {$Cars['Krasa']}</p></div>
                    <div class='info-icon'><img src='../../image/icons/Virsbuves-icon.png'><p> Virsbūves tips: {$Cars['Virsbuves_tips']}</p></div>
                </div>
            </div>
        </div>
    </div>";
}

echo json_encode([
    'cars' => $carsHTML,
    'totalPages' => $totalPages
]);
?>
