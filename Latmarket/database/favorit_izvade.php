<?php

require "con_db_l.php";
session_start();

// ---------------------------------------------------- page

$limit = 3;
$page = isset($_POST['page']) ? (int)$_POST['page'] : 1;
$offset = ($page - 1) * $limit;
$FavoriteHTML = '';

$countQuery = "SELECT COUNT(*) AS total FROM favoriti WHERE lietotaja_id = ?";
$count = $savienojums->prepare($countQuery);
$count->bind_param("i", $_SESSION['IdHOMIK']);
$count->execute();
$countResult = $count->get_result();
$totalRows = $countResult->fetch_assoc()['total'];
$totalPages = ceil($totalRows / $limit);

// ---------------------------------------------------- Izvade

$favoritSQL = "SELECT * FROM favoriti WHERE lietotaja_id = ? LIMIT ? OFFSET ?";
$favoriti = $savienojums->prepare($favoritSQL);
$favoriti->bind_param("iii", $_SESSION['IdHOMIK'], $limit, $offset);
$favoriti->execute();
$favoritResult = $favoriti->get_result();

while ($favorit = $favoritResult->fetch_assoc()) {
    
    $tableName = $favorit['table_name']; 
    $itemId = $favorit['item_id'];

    $CarfavIzvadeSQL = "SELECT * FROM $tableName WHERE Cars_ID = ?";
    $Car = $savienojums->prepare($CarfavIzvadeSQL);
    $Car->bind_param("i", $itemId);
    $Car->execute();
    $FavIzvadeResult = $Car->get_result();

    
    while ($Favizvade = $FavIzvadeResult->fetch_assoc()) {

        $car_id_p = $Favizvade['Cars_ID'];

        // ----------------------------------------photo

        $photosSQL = "SELECT photo FROM Cars_photos WHERE car_id = ? LIMIT 1";
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
        }

        // ----------------------------------------fomated

        $formattedDzinejs = number_format($Favizvade['Dzinejs'], 1);

        // ----------------------------------------izvade

        $FavoriteHTML .= "
        
        <div class='box'>
            $photoHTML

            <h1>{$Favizvade['Marka']} {$Favizvade['Modelis']} {$Favizvade['Izladuma_gads']}</h1>

            <div class='info'>

                <p>Tilpums: {$formattedDzinejs}</p>

                <p>Nobrakums: {$Favizvade['Nobrakums']} KM</p>

                <p>Jauda: {$Favizvade['Jauda']} KW</p>

                <p>Pilsēta: {$Favizvade['Pilseta']}</p>

            </div>
            
            <div class='cena'>

                <p>{$Favizvade['Cena']} €</p>

            </div>

            <div class='controle-buttons'>

                <form class='favoriti' id='deletForm'>
                    <input type='hidden' class='tb_name' value='Cars'>
                    <input type='hidden' class='item_id' value='{$Favizvade['Cars_ID']}'>
                    <button><i class='fas fa-trash-alt'></i></button>
                </form>

                <form id='viewForm' method='POST' action='/Transport/car/car-parskate.php'> 
                    <button type='submit' value='{$Favizvade['Cars_ID']}' name='carizvele'><i class='fa fa-eye'></i></button>
                </form>

            </div>

        </div>";

    }
}

echo json_encode([
    'favorite' => $FavoriteHTML,
    'totalPages' => $totalPages
]);

?>
