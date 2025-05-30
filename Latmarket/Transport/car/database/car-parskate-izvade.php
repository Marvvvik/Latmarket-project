<?php

require "con_db_transports.php";


if(isset($_POST['carizvele'])){
    $car_ID = $_POST['carizvele']; 
    
    $atlasit_Car_SQL = "SELECT * FROM Cars WHERE Cars_ID = ?";
    $car_izvade = $savienojums->prepare($atlasit_Car_SQL);
    $car_izvade->bind_param("i", $car_ID);
    $car_izvade->execute();
    $CarResult = $car_izvade->get_result();
    $Car = $CarResult->fetch_assoc(); 

    $chatBtn = null;
    if(session_status() === PHP_SESSION_ACTIVE && isset($_SESSION['IdHOMIK']) && $Car['autora_id'] !== $_SESSION['IdHOMIK']){

    $chatBtn = "<button class='chatBtn'>Uzrakstit</button>";
    
    }

    $config = require '../../database/config.php';
    $encryptionKey = $config['encryption_key'];

    define('ENCRYPTION_KEY', $encryptionKey); 
    define('ENCRYPTION_METHOD', 'AES-256-CBC');

    function decryptData($data) {
        $data = base64_decode($data);
        $ivLength = openssl_cipher_iv_length(ENCRYPTION_METHOD);
        $iv = substr($data, 0, $ivLength);
        $encrypted = substr($data, $ivLength);
        return openssl_decrypt($encrypted, ENCRYPTION_METHOD, ENCRYPTION_KEY, 0, $iv);
    }


    $autoruSQL = "SELECT * FROM lietotaji WHERE lietotaji_id = ?";
    $car_autor = $savienojums->prepare($autoruSQL);
    $car_autor->bind_param("i", $Car['autora_id']);
    $car_autor->execute();
    $autorsResult = $car_autor->get_result();
    $autors = $autorsResult->fetch_assoc(); 

    $autor_foto = 'data:image/jpeg;base64,' . base64_encode($autors['avatar']);
    $Izvade_vards = decryptData($autors['vards']);
    $Izvade_Uzvards = decryptData($autors['uzvards']);
    $Izvade_telefons = decryptData($autors['telefons']);

    $photosSQL = "SELECT photo FROM Cars_photos WHERE car_id = ?";
    $car_photo = $savienojums->prepare($photosSQL);
    $car_photo->bind_param("i", $car_ID);
    $car_photo->execute();
    $photosResult = $car_photo->get_result();

    $carfoto_id = 1;
    $photoHTML = ""; 
    $fotoSliderHtml = "";
    while ($photo = $photosResult->fetch_assoc()) {
        $base64Image = base64_encode($photo['photo']);
        $photoHTML .= "<img src='data:image/jpeg;base64,{$base64Image}' alt='Car Photo'/>";
        $fotoSliderHtml .="<div class='sliderFotos'><img src='data:image/jpeg;base64,{$base64Image}' alt='Car Photo'/></div>";
    }
    
    $tehniska_apskate_izvade = ($Car['Tehniska_apskate'] == 0) ? "Nav" : $Car['Tehniska_apskate'];
    $jauda_izvade = ($Car['Jauda'] == 0) ? "-" : $Car['Jauda']." KW";

    
    $featuresSQL = "SELECT Komplektacijas_id FROM Car_komplektacija WHERE Car_ID = ?";
    $features = $savienojums->prepare($featuresSQL);
    $features->bind_param("i", $car_ID);
    $features->execute();
    $featuresResult = $features->get_result();

    $active_ids = [];
    while ($row = $featuresResult->fetch_assoc()) {
        $active_ids[] = $row['Komplektacijas_id'];
    } 


}

?>