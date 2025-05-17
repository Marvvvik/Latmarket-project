<?php 

require "con_db_l.php"; 
session_start();

define('ENCRYPTION_KEY', $_SESSION['ENCRYPTION_KEY']);
define('ENCRYPTION_METHOD', 'AES-256-CBC');

function decryptData($data) {
    $data = base64_decode($data);
    $ivLength = openssl_cipher_iv_length(ENCRYPTION_METHOD);
    $iv = substr($data, 0, $ivLength);
    $encrypted = substr($data, $ivLength);
    return openssl_decrypt($encrypted, ENCRYPTION_METHOD, ENCRYPTION_KEY, 0, $iv);
}

if (isset($_POST['id'])) {
    $userId = intval($_POST['id']);

    $vaicajums = $savienojums->prepare("SELECT vards, uzvards, epasts, telefons, avatar FROM lietotaji WHERE lietotaji_id = ?");
    $vaicajums->bind_param("i", $userId);
    $vaicajums->execute();

    $rezultats = $vaicajums->get_result();

    if ($lietotajs = $rezultats->fetch_assoc()) {

        $vards = decryptData($lietotajs['vards']);
        $uzvards = decryptData($lietotajs['uzvards']);
        $epasts = decryptData($lietotajs['epasts']);
        $telefons = decryptData($lietotajs['telefons']);
        $avatarBase64 = 'data:image/jpeg;base64,' . base64_encode($lietotajs['avatar']);

        echo json_encode([
            "success" => true,
            "vards" => htmlspecialchars($vards),
            "uzvards" => htmlspecialchars($uzvards),
            "epasts" => htmlspecialchars($epasts),
            "telefons" => htmlspecialchars($telefons),
            "full_name" => htmlspecialchars($vards) . " " . htmlspecialchars($uzvards),
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
