<?php
require "con_db_l.php";
session_start();

$response = [];

// Получаем данные из AJAX
$liet_id = htmlspecialchars($_POST['liet_id']);
$vards = htmlspecialchars($_POST['vards']);
$uzvards = htmlspecialchars($_POST['uzvards']);
$epasts = htmlspecialchars($_POST['epasts']);
$telefons = htmlspecialchars($_POST['telefons']);
$editParole1 = trim(htmlspecialchars($_POST['password1']));
$editParole2 = trim(htmlspecialchars($_POST['password2']));
$editPassActive = filter_var($_POST['editPassActive'], FILTER_VALIDATE_BOOLEAN);

$avatarData = null;
$null = NULL;
$base64Avatar = null;

if (isset($_FILES['newavatar']) && $_FILES['newavatar']['error'] == UPLOAD_ERR_OK) {
$avatarData = file_get_contents($_FILES['newavatar']['tmp_name']);
}

if (!empty($avatarData)) {
    $base64Avatar = 'data:image/jpeg;base64,' . base64_encode($avatarData); 
}

// Получаем данные из базы данных
$vaicajums = $savienojums->prepare("SELECT * FROM lietotaji WHERE lietotaji_id = ?");
$vaicajums->bind_param("i", $liet_id);
$vaicajums->execute();
$rezultats = $vaicajums->get_result();
$lietotajs = $rezultats->fetch_assoc();
$vaicajums->close();

if ($editPassActive) {
    if (!empty($editParole1) && !empty($editParole2)) {
        if ($editParole1 === $editParole2) {
            if (preg_match('/[a-z]/', $editParole1) && preg_match('/[A-Z]/', $editParole1) && preg_match('/\d/', $editParole1) && strlen($editParole1) >= 8) {
                $hashedPassword = password_hash($editParole1, PASSWORD_BCRYPT);
                $vards = !empty($vards) ? $vards : $lietotajs['vards'];
                $uzvards = !empty($uzvards) ? $uzvards : $lietotajs['uzvards'];
                $epasts = !empty($epasts) ? $epasts : $lietotajs['epasts'];
                $telefons = !empty($telefons) ? $telefons : $lietotajs['telefons'];
                $avatarData = !empty($avatarData) ? $avatarData : $lietotajs['avatar'];

                $vaicajums = $savienojums->prepare("UPDATE lietotaji SET vards = ?, uzvards = ?, epasts = ?, telefons = ?, parole = ?, avatar = ? WHERE lietotaji_id = ?");
                $vaicajums->bind_param("sssssbi", $vards, $uzvards, $epasts, $telefons, $hashedPassword, $null, $liet_id);
                $vaicajums->send_long_data(5, $avatarData);

                if ($vaicajums->execute()) {
                    $_SESSION['vardsHOMIK'] = $vards;
                    $_SESSION['UzvardsHOMIK'] = $uzvards;
                    $_SESSION['epastsHOMIK'] = $epasts;
                    $_SESSION['telefonsHOMIK'] = $telefons;
                    $_SESSION['avatarHOMIK'] = $base64Avatar;

                    $response['success'] = true;
                    $response['message'] = "Dati veiksmīgi atjaunoti!";
                } else {
                    $error = $vaicajums->error;
                    $response['success'] = false;
                    $response['error'] = "Sistēmas kļūda. Ошибка SQL: " . $error;
                }
            } else {
                $response['success'] = false;
                $response['error'] = "Parole neatbilst prasībām.";
            }
        } else {
            $response['success'] = false;
            $response['error'] = "Paroles nesakrīt.";
        }
    } else {
        $response['success'] = false;
        $response['error'] = "Parole nav ievadīta.";
    }
} else {
    // Если пароль не меняется, просто обновляем данные
    $vards = !empty($vards) ? $vards : $lietotajs['vards'];
    $uzvards = !empty($uzvards) ? $uzvards : $lietotajs['uzvards'];
    $epasts = !empty($epasts) ? $epasts : $lietotajs['epasts'];
    $telefons = !empty($telefons) ? $telefons : $lietotajs['telefons'];
    $avatarData = !empty($avatarData) ? $avatarData : $lietotajs['avatar'];

    $vaicajums = $savienojums->prepare("UPDATE lietotaji SET vards = ?, uzvards = ?, epasts = ?, telefons = ?, avatar = ? WHERE lietotaji_id = ?");
    $vaicajums->bind_param("ssssbi", $vards, $uzvards, $epasts, $telefons, $null, $liet_id);
    $vaicajums->send_long_data(4, $avatarData);

    if ($vaicajums->execute()) {
        $_SESSION['vardsHOMIK'] = $vards;
        $_SESSION['UzvardsHOMIK'] = $uzvards;
        $_SESSION['epastsHOMIK'] = $epasts;
        $_SESSION['telefonsHOMIK'] = $telefons;
        $_SESSION['avatarHOMIK'] = $base64Avatar;
        
        $response['success'] = true;
        $response['message'] = "Dati veiksmīgi atjaunoti!";
    } else {
        $error = $vaicajums->error;
        $response['success'] = false;
        $response['error'] = "Sistēmas kļūda. Ошибка SQL: " . $error;
    }
}

$savienojums->close();
echo json_encode($response);
exit;
?>

