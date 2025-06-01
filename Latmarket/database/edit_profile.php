<?php
require "con_db_l.php";
session_start();

$config = require 'config.php';
define('ENCRYPTION_KEY', $config['encryption_key']);
define('ENCRYPTION_METHOD', 'AES-256-CBC');

function encryptData($data) {
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length(ENCRYPTION_METHOD));
    $encrypted = openssl_encrypt($data, ENCRYPTION_METHOD, ENCRYPTION_KEY, 0, $iv);
    return base64_encode($iv . $encrypted);
}

function decryptData($data) {
    $data = base64_decode($data);
    $ivLength = openssl_cipher_iv_length(ENCRYPTION_METHOD);
    $iv = substr($data, 0, $ivLength);
    $encrypted = substr($data, $ivLength);
    return openssl_decrypt($encrypted, ENCRYPTION_METHOD, ENCRYPTION_KEY, 0, $iv);
}

$response = ['success' => false, 'error' => ''];
$liet_id = $_SESSION['IdHOMIK'] ?? null;

if ($liet_id === null) {
    $response['error'] = "Nav atrasts lietotāja ID sesijā.";
    echo json_encode($response);
    exit;
}

$vards_input = htmlspecialchars($_POST['vards'] ?? '');
$uzvards_input = htmlspecialchars($_POST['uzvards'] ?? '');
$epasts_input = htmlspecialchars($_POST['epasts'] ?? '');
$telefons_input = htmlspecialchars($_POST['telefons'] ?? '');
$editParole1 = trim(htmlspecialchars($_POST['password1'] ?? ''));
$editParole2 = trim(htmlspecialchars($_POST['password2'] ?? ''));
$editPassActive = filter_var($_POST['editPassActive'] ?? false, FILTER_VALIDATE_BOOLEAN);

$avatarData = null;
$base64Avatar = null;

if (isset($_FILES['newavatar']) && $_FILES['newavatar']['error'] == UPLOAD_ERR_OK) {
    $avatarData = file_get_contents($_FILES['newavatar']['tmp_name']);
    $base64Avatar = 'data:image/jpeg;base64,' . base64_encode($avatarData);
}

$vaicajums_select = $savienojums->prepare("SELECT vards, uzvards, epasts, telefons, avatar FROM lietotaji WHERE lietotaji_id = ?");
$vaicajums_select->bind_param("i", $liet_id);
$vaicajums_select->execute();
$rezultats = $vaicajums_select->get_result();
$lietotajs = $rezultats->fetch_assoc() ?: [];
$vaicajums_select->close();

$lietotajs_decrypted = [
    'vards' => decryptData($lietotajs['vards'] ?? ''),
    'uzvards' => decryptData($lietotajs['uzvards'] ?? ''),
    'epasts' => decryptData($lietotajs['epasts'] ?? ''),
    'telefons' => decryptData($lietotajs['telefons'] ?? ''),
    'avatar' => $lietotajs['avatar'] ?? null,
];

$vards_db = encryptData(!empty($vards_input) ? $vards_input : $lietotajs_decrypted['vards']);
$uzvards_db = encryptData(!empty($uzvards_input) ? $uzvards_input : $lietotajs_decrypted['uzvards']);
$epasts_db = encryptData(!empty($epasts_input) ? $epasts_input : $lietotajs_decrypted['epasts']);
$telefons_db = encryptData(!empty($telefons_input) ? $telefons_input : $lietotajs_decrypted['telefons']);

$hashedPassword = null;

if ($editPassActive) {
    if (empty($editParole1) || empty($editParole2)) {
        $response['error'] = "Lūdzu, ievadiet abas paroles.";
        echo json_encode($response);
        exit;
    }
    if ($editParole1 !== $editParole2) {
        $response['error'] = "Paroles nesakrīt.";
        echo json_encode($response);
        exit;
    }
    if (!preg_match('/[a-z]/', $editParole1) || !preg_match('/[A-Z]/', $editParole1) || !preg_match('/\d/', $editParole1) || strlen($editParole1) < 8) {
        $response['error'] = "Parole neatbilst prasībām.";
        echo json_encode($response);
        exit;
    }
    $hashedPassword = password_hash($editParole1, PASSWORD_BCRYPT);

    if (!empty($avatarData)) {
        $vaicajums_update = $savienojums->prepare("UPDATE lietotaji SET vards = ?, uzvards = ?, epasts = ?, telefons = ?, parole = ?, avatar = ? WHERE lietotaji_id = ?");
        $vaicajums_update->bind_param("sssssbi", $vards_db, $uzvards_db, $epasts_db, $telefons_db, $hashedPassword, $null, $liet_id);
        $vaicajums_update->send_long_data(5, $avatarData);
    } else {
        $vaicajums_update = $savienojums->prepare("UPDATE lietotaji SET vards = ?, uzvards = ?, epasts = ?, telefons = ?, parole = ? WHERE lietotaji_id = ?");
        $vaicajums_update->bind_param("sssssi", $vards_db, $uzvards_db, $epasts_db, $telefons_db, $hashedPassword, $liet_id);
    }
} else {
    if (!empty($avatarData)) {
        $vaicajums_update = $savienojums->prepare("UPDATE lietotaji SET vards = ?, uzvards = ?, epasts = ?, telefons = ?, avatar = ? WHERE lietotaji_id = ?");
        $vaicajums_update->bind_param("ssssbi", $vards_db, $uzvards_db, $epasts_db, $telefons_db, $null, $liet_id);
        $vaicajums_update->send_long_data(4, $avatarData);
    } else {
        $vaicajums_update = $savienojums->prepare("UPDATE lietotaji SET vards = ?, uzvards = ?, epasts = ?, telefons = ? WHERE lietotaji_id = ?");
        $vaicajums_update->bind_param("ssssi", $vards_db, $uzvards_db, $epasts_db, $telefons_db, $liet_id);
    }
}

if ($vaicajums_update->execute()) {
    $_SESSION['vardsHOMIK'] = decryptData($vards_db);
    $_SESSION['UzvardsHOMIK'] = decryptData($uzvards_db);
    $_SESSION['epastsHOMIK'] = decryptData($epasts_db);
    $_SESSION['telefonsHOMIK'] = decryptData($telefons_db);
    if (!empty($avatarData)) {
        $_SESSION['avatarHOMIK'] = $base64Avatar;
    } else {
        $_SESSION['avatarHOMIK'] = 'data:image/jpeg;base64,' . base64_encode($lietotajs['avatar']);
    }
    $response['success'] = true;
    $response['message'] = "Dati veiksmīgi atjaunoti!";
} else {
    $response['error'] = "Sistēmas kļūda. SQL kļūda: " . $vaicajums_update->error;
}

$vaicajums_update->close();
$savienojums->close();
echo json_encode($response);
exit;
?>
