<?php 

require "con_db_l.php"; 

if (isset($_POST['id'])) {
    $userId = intval($_POST['id']);

    $vaicajums = $savienojums->prepare("SELECT vards, uzvards, epasts, telefons FROM lietotaji WHERE lietotaji_id = ?");
    $vaicajums->bind_param("i", $userId);
    $vaicajums->execute();

    
    $rezultats = $vaicajums->get_result();

    if ($lietotajs = $rezultats->fetch_assoc()) {
        
        echo json_encode([
            "success" => true,
            "vards" => htmlspecialchars($lietotajs['vards']),
            "uzvards" => htmlspecialchars($lietotajs['uzvards']),
            "epasts" => htmlspecialchars($lietotajs['epasts']),
            "telefons" => htmlspecialchars($lietotajs['telefons']),
        ]);
    } else {

        echo json_encode(["success" => false, "error" => "Lietotājs nav atrasts."]);

    }

    
    $vaicajums->close();
    $savienojums->close();
} else {

    echo json_encode(["success" => false, "error" => "Nav ID."]);
    
}
?>
