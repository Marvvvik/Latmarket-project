<?php
require "con_db_l.php";
session_start();

$response = [];
$sludID = htmlspecialchars($_POST['sludID']);
$teg =  htmlspecialchars($_POST['teg']);
$table = "";
$idSlud = null;
$autorId = null;

if($teg == "Car"){ $table = "Cars"; } 


if ($sludID > 0 && !empty($table)) {

    $idSlud = ($table == "Cars") ? "Cars_ID" : (($table == "Moto") ? "Moto_ID" : "moto_id");
    $autorId = ($table == "Cars") ? "autora_id" : (($table == "Moto") ? "Moto_ID" : "lietotaja_id");

    $vaicajums = $savienojums->prepare("DELETE FROM $table WHERE $idSlud = ? AND $autorId = ?");
    $vaicajums->bind_param("ii", $sludID, $_SESSION['IdHOMIK']);

    if ($vaicajums->execute()) {
        if ($vaicajums->affected_rows > 0) {
            $response['success'] = true;
            $response['message'] = "Sludinājums veiksmīgi dzēsts.";
        } else {
            $response['success'] = false;
            $response['error'] = "Sludinājums nav atrasts vai nepieder jums.";
        }
    } else {
        $response['success'] = false;
        $response['error'] = "Sistēmas kļūda, mēģiniet vēlreiz.";
    }
} else {
    $response['success'] = false;
    $response['error'] = "Nepareizs sludinājumam ID.";
}

$savienojums->close();
echo json_encode($response);
exit;
?>