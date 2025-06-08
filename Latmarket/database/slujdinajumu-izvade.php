<?php

require "con_db_l.php";
session_start();

if (!isset($_SESSION['IdHOMIK'])) {
    echo json_encode(['error' => 'User not logged in']);
    exit;
}

$lietotajaId = $_SESSION['IdHOMIK'];
$allUserAds = [];
$adTables = ['Cars'];
$userAdsHTML = '';

foreach ($adTables as $tableName) {
    $userIdColumn = '';
    if ($tableName === 'Cars') {
        $userIdColumn = 'autora_id'; 
    } 

    if (!empty($userIdColumn)) {
        $sql = "SELECT * FROM $tableName WHERE $userIdColumn = ? AND Statuss = 'active'";
        $stmt = $savienojums->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("i", $lietotajaId);
            $stmt->execute();
            $result = $stmt->get_result();
            while ($ad = $result->fetch_assoc()) {
                $ad['table_name'] = $tableName;
                $allUserAds[] = $ad;
            }
            $stmt->close();
        } else {
            echo json_encode(['error' => 'Database error: ' . $savienojums->error]);
            exit;
        }
    }
}

// ---------------------------------------------------- Pagination

$limit = 3;
$totalRows = count($allUserAds);
$totalPages = ceil($totalRows / $limit);
$page = isset($_POST['page']) ? (int)$_POST['page'] : 1;
$offset = ($page - 1) * $limit;

// Get the subset of ads for the current page
$pagedUserAds = array_slice($allUserAds, $offset, $limit);

// ---------------------------------------------------- Output for the current page

foreach ($pagedUserAds as $ad) {
    $tableName = $ad['table_name'];
    $car_id_p = isset($ad['Cars_ID']) ? $ad['Cars_ID'] : (isset($ad['Moto_ID']) ? $ad['Moto_ID'] : null);

    if ($car_id_p !== null) {
        // ----------------------------------------photo
        $photoTable = $tableName . "_photos";
        $photoColumn = $tableName === 'Cars' ? 'car_id' : ($tableName === 'Moto' ? 'moto_id' : null);

        if ($photoColumn) {
            $photosSQL = "SELECT photo FROM $photoTable WHERE $photoColumn = ? LIMIT 1";
            $stmt_photo = $savienojums->prepare($photosSQL);
            if ($stmt_photo) {
                $stmt_photo->bind_param("i", $car_id_p);
                $stmt_photo->execute();
                $photosResult = $stmt_photo->get_result();
                $photoHTML = '';
                if ($photo = $photosResult->fetch_assoc()) {
                    $base64Image = base64_encode($photo['photo']);
                    $photoHTML .= "<img src='data:image/jpeg;base64,{$base64Image}'/>";
                }
                $stmt_photo->close();
            } else {
                $photoHTML = 'Error loading photo';
            }
        } else {
            $photoHTML = 'No photo available';
        }

        // ----------------------------------------formatted Dzinejs
        $formattedDzinejs = isset($ad['Dzinejs']) ? number_format($ad['Dzinejs'], 1) : '';

        // ----------------------------------------output
        $outputHTML = "
        <div class='box'>
            $photoHTML
            <h1>";
                $outputHTML .= isset($ad['Marka']) ? $ad['Marka'] . " " : "";
                $outputHTML .= isset($ad['Modelis']) ? $ad['Modelis'] . " " : "";
                $outputHTML .= isset($ad['Izladuma_gads']) ? $ad['Izladuma_gads'] : "";
                $outputHTML .= 
            "</h1>
            <div class='info'>";
                $outputHTML .= !empty($formattedDzinejs) ? "<p>Tilpums: {$formattedDzinejs}</p>" : "";
                $outputHTML .= isset($ad['Nobrakums']) ? "<p>Nobrakums: {$ad['Nobrakums']} KM</p>" : "";
                $outputHTML .= isset($ad['Jauda']) ? "<p>Jauda: {$ad['Jauda']} KW</p>" : "";
                $outputHTML .= isset($ad['Pilseta']) ? "<p>Pilsēta: {$ad['Pilseta']}</p>" : "";
                $outputHTML .= 
            "</div>
            <div class='cena'>";
                $outputHTML .= isset($ad['Cena']) ? "<p>{$ad['Cena']} €</p>" : "";
                
                $outputHTML .= "
            </div>
            <div class='controle-buttons'>
                <form id='viewForm' method='POST' action='/Transport/car/car-parskate.php'>"; 
                if ($tableName === 'Cars' && isset($ad['Cars_ID'])) {
                    $outputHTML .= "<button type='submit' value='{$ad['Cars_ID']}' name='carizvele'><i class='fa fa-eye'></i></button>";
                } elseif ($tableName === 'Moto' && isset($ad['Moto_ID'])) {
                    $outputHTML .= "<button type='submit' value='{$ad['Moto_ID']}' name='motoizvele'><i class='fa fa-eye'></i></button>";
                }
                    $outputHTML .= "
                </form>
                <form id='editForm' method='POST' action='/Transport/car/car-edit.php'>"; 
                if ($tableName === 'Cars' && isset($ad['Cars_ID'])) {
                    $outputHTML .= "<button type='submit' value='{$ad['Cars_ID']}' name='carizvele'><i class='fas fa-pen'></i></button>";
                } elseif ($tableName === 'Moto' && isset($ad['Moto_ID'])) {
                    $outputHTML .= "<button type='submit' value='{$ad['Moto_ID']}' name='motoizvele'><i class='fas fa-pen'></i></button>";
                }
                    $outputHTML .= "
                </form>";
                if ($tableName === 'Cars' && isset($ad['Cars_ID'])) {
                    $outputHTML .= "<button type='submit' class='deletButton' id='car-{$ad['Cars_ID']}'><i class='fas fa-trash-alt'></i></button>";
                } elseif ($tableName === 'Moto' && isset($ad['Moto_ID'])) {
                    $outputHTML .= "<button type='submit' value='{$ad['Moto_ID']}' name='motoizvele'><i class='fas fa-trash-alt'></i></button>";
                }

                    $outputHTML .= "
            </div>";

                if ($tableName === 'Cars' && isset($ad['Cars_ID'])) {
                        $outputHTML .= "<div class='slud-Delet-Modal' id='sludDeletModal-{$ad['Cars_ID']}'> 
                                            <div class='Slud-Del-Forma'>
                                                <form class='sludDelet'>
                                                    <p>Vai jūs tiešām gribat dzēst sludinājumu?</p>
                                                    <div class='form-Buttons'>
                                                        <input type='hidden' value='{$ad['Cars_ID']}' id='sludID'>
                                                        <input type='hidden' value='Car' id='teg'>
                                                        <button id='yes'>Jā</button>
                                                        <button type='button' id='no'>Nē</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>";
                    }
                $outputHTML .= "

        </div>";
        $userAdsHTML .= $outputHTML;
    }
}

echo json_encode([
    'userAds' => $userAdsHTML,
    'totalPages' => $totalPages
]);

?>