<?php
require "con_db_l.php";
session_start();

$response = [];
$atID = htmlspecialchars($_POST['atID']);

if ($atID > 0) {
    $vaicajums = $savienojums->prepare("DELETE FROM Atsauksmes WHERE atsakmes_id = ? AND lietotaja_id = ?");
    $vaicajums->bind_param("ii", $atID, $_SESSION['IdHOMIK']);

    if ($vaicajums->execute()) {
        if ($vaicajums->affected_rows > 0) {
            $response['success'] = true;
            $response['message'] = "Komentārs veiksmīgi dzēsts.";
        } else {
            $response['success'] = false;
            $response['error'] = "Komentārs nav atrasts vai nepieder jums.";
        }
    } else {
        $response['success'] = false;
        $response['error'] = "Sistēmas kļūda, mēģiniet vēlreiz.";
    }
} else {
    $response['success'] = false;
    $response['error'] = "Nepareizs komentāra ID.";
}

$savienojums->close();
echo json_encode($response);
exit;
?>