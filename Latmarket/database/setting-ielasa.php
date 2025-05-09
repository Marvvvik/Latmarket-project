<?php 

require "con_db_l.php"; 

// функция для вывода даннызх которые сейчас в базе данных

if (isset($_POST['id'])) {
    $userId = intval($_POST['id']);

    $vaicajums = $savienojums->prepare("SELECT vards, uzvards, epasts, telefons, avatar FROM lietotaji WHERE lietotaji_id = ?");
    $vaicajums->bind_param("i", $userId);
    $vaicajums->execute();

    $rezultats = $vaicajums->get_result();

    if ($lietotajs = $rezultats->fetch_assoc()) {

        $avatarBase64 = 'data:image/jpeg;base64,' . base64_encode($lietotajs['avatar']);

        echo json_encode([
            "success" => true,
            "vards" => htmlspecialchars($lietotajs['vards']),
            "uzvards" => htmlspecialchars($lietotajs['uzvards']),
            "epasts" => htmlspecialchars($lietotajs['epasts']),
            "telefons" => htmlspecialchars($lietotajs['telefons']),
            "full_name" => htmlspecialchars($lietotajs['vards']) . " " . htmlspecialchars($lietotajs['uzvards']),
            "avatar" => $avatarBase64,
        ]);
    } else {
        echo json_encode(["success" => false, "error" => "Lietotājs netika atrasts."]);
    }

    $vaicajums->close();
    $savienojums->close();
} else {
    echo json_encode(["success" => false, "error" => "Nav ID."]);
}
?>
