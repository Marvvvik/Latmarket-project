<?php

if(isset($_POST['carizvele'])){
    $car_ID = $_POST['carizvele']; 
    
    $atlasit_Car_SQL = "SELECT * FROM Cars WHERE Cars_ID = ?";
    $car_izvade = $savienojums->prepare($atlasit_Car_SQL);
    $car_izvade->bind_param("i", $car_ID);
    $car_izvade->execute();
    $CarResult = $car_izvade->get_result();
    $Car = $CarResult->fetch_assoc(); 

    $autoruSQL = "SELECT * FROM lietotaji WHERE lietotaji_id = ?";
    $car_autor = $savienojums->prepare($autoruSQL);
    $car_autor->bind_param("i", $Car['autora_id']);
    $car_autor->execute();
    $autorsResult = $car_autor->get_result();
    $autors = $autorsResult->fetch_assoc(); 

    $autor_foto = 'data:image/jpeg;base64,' . base64_encode($autors['avatar']);
    
    $photosSQL = "SELECT photo FROM Cars_photos WHERE car_id = ?";
    $car_photo = $savienojums->prepare($photosSQL);
    $car_photo->bind_param("i", $car_ID);
    $car_photo->execute();
    $photosResult = $car_photo->get_result();

    $carfoto_id = 1;
    $photoHTML = ""; 
    while ($photo = $photosResult->fetch_assoc()) {
        $base64Image = base64_encode($photo['photo']);
        $photoHTML .= "<img src='data:image/jpeg;base64,{$base64Image}' alt='Car Photo'/>";
    }

    $photosSQL_2 = "SELECT photo FROM Cars_photos WHERE car_id = ? LIMIT 4";
    $stmt = $savienojums->prepare($photosSQL_2);
    $stmt->bind_param("i", $car_ID);
    $stmt->execute();
    $photosResult_2 = $stmt->get_result();

    $carfoto_id = 1;
    $photoHTML_2 = ""; 
    while ($photo = $photosResult_2->fetch_assoc()) {
        $base64Image = base64_encode($photo['photo']);
        $photoHTML_2 .= "<img src='data:image/jpeg;base64,{$base64Image}' alt='Car Photo'/>";
    }

    
    $tehniska_apskate_izvade = ($Car['Tehniska_apskate'] == 0) ? "Nav" : $Car['Tehniska_apskate'];
    
    
    $jauda_izvade = ($Car['Jauda'] == 0) ? "-" : $Car['Jauda']." KW";

}

?>