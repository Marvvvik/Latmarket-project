<?php
require "con_db_l.php";
session_start();

$response = [];

$vards = htmlspecialchars($_POST['vards']);
$uzvards = htmlspecialchars($_POST['uzvards']);
$stars = htmlspecialchars($_POST['stars']);
$text = htmlspecialchars($_POST['at_text']);
$liet_id = htmlspecialchars($_POST['lietotaja_id']);
$avatarBase64 = $_POST['atsukmes_avatar'];
$avatarData = base64_decode(str_replace('data:image/jpeg;base64,', '', $avatarBase64));
$null = null;

if (!empty($vards) && !empty($uzvards) && $vards !== "Unknown" && $uzvards !== "Unknown") { 
    if (!empty($text)) { 
        if (!empty($text) && strlen($text) <= 800) { 

            $current_date = date('Y-m-d H:i:s');
            $check_query = $savienojums->prepare("SELECT COUNT(*) FROM Atsauksmes WHERE lietotaja_id = ? AND datums >= NOW() - INTERVAL 1 WEEK");
            $check_query->bind_param("i", $liet_id);
            $check_query->execute();
            $check_query->bind_result($comment_count);
            $check_query->fetch();
            $check_query->close();
            
            if ($comment_count > 0) {
                $response['success'] = false;
                $response['error'] = "Jūs varat atstāt tikai vienu atsauksmi nedēļā!";
            } else {
                $vaicajums = $savienojums->prepare("INSERT INTO Atsauksmes (vards, uzvards, stars, at_text, lietotaja_id, datums, avatar) VALUES (?, ?, ?, ?, ?, ?, ?)");
                $vaicajums->bind_param("ssisisb", $vards, $uzvards, $stars, $text, $liet_id, $current_date, $null);
                $vaicajums->send_long_data(6, $avatarData);

                if ($vaicajums->execute()) {
                    $response['success'] = true;
                    $response['message'] = "Atsauksme veiksmīgi izvietota!";
                } else {
                    $response['success'] = false;
                    $response['error'] = "Sistēmas kļūda.";
                }
            }
        } else {
            $response['success'] = false;
            $response['error'] = "Teksts ir pārāk garš!";
        }
    } else {
        $response['success'] = false;
        $response['error'] = "Nav ievadīts atsaukmes teksts!";
    }
} else {
    $response['success'] = false;
    $response['error'] = "Iestatījumos nav norādīts Vārds vai Uzvārds!";
}

$savienojums->close();
echo json_encode($response);
exit;
?>
