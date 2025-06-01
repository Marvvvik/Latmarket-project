<?php
require "con_db_l.php";
session_start();

$response = ['success' => false, 'error' => ''];

$vards = $_SESSION['vardsHOMIK'];
$uzvards = $_SESSION['UzvardsHOMIK'];
$stars = htmlspecialchars($_POST['stars'] ?? '');
$text = htmlspecialchars($_POST['at_text'] ?? '');
$liet_id = $_SESSION['IdHOMIK'];
$avatarBase64 = $_SESSION['avatarHOMIK'];
$avatarData = $avatarBase64 ? base64_decode(str_replace('data:image/jpeg;base64,', '', $avatarBase64)) : null;

if (empty($vards) || $vards === "Unknown" || empty($uzvards) || $uzvards === "Unknown") {
    $response['error'] = "Iestatījumos nav norādīts Vārds vai Uzvārds!";
    echo json_encode($response);
    exit;
}

if (empty($text)) {
    $response['error'] = "Nav ievadīts atsaukmes teksts!";
    echo json_encode($response);
    exit;
}

if (strlen($text) > 800) {
    $response['error'] = "Teksts ir pārāk garš!";
    echo json_encode($response);
    exit;
}

$current_date = date('Y-m-d H:i:s');
$check_query = $savienojums->prepare("SELECT COUNT(*) FROM Atsauksmes WHERE lietotaja_id = ? AND datums >= NOW() - INTERVAL 1 WEEK");
$check_query->bind_param("i", $liet_id);
$check_query->execute();
$check_query->bind_result($comment_count);
$check_query->fetch();
$check_query->close();

if ($comment_count > 0) {
    $response['error'] = "Jūs varat atstāt tikai vienu atsauksmi nedēļā!";
    echo json_encode($response);
    exit;
}

$vaicajums = $savienojums->prepare("INSERT INTO Atsauksmes (vards, uzvards, stars, at_text, lietotaja_id, datums, avatar) VALUES (?, ?, ?, ?, ?, ?, ?)");
$vaicajums->bind_param("ssisisb", $vards, $uzvards, $stars, $text, $liet_id, $current_date, $avatarData);

if ($avatarData !== null) {
    $vaicajums->send_long_data(6, $avatarData);
}

if ($vaicajums->execute()) {
    $response['success'] = true;
    $response['message'] = "Atsauksme veiksmīgi izvietota!";
} else {
    $response['error'] = "Sistēmas kļūda.";
}

$savienojums->close();
echo json_encode($response);
exit;
?>