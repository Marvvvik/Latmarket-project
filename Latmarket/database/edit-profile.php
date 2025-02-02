<?php

require "con_db_l.php";
session_start();

$response = [];

$liet_id = htmlspecialchars($_POST['liet_id']);
$vards = htmlspecialchars($_POST['vards']);
$uzvards = htmlspecialchars($_POST['uzvards']);
$epsts = htmlspecialchars($_POST['epasts']);
$telefons = htmlspecialchars($_POST['telefons']);


$vaicajums = $savienojums->prepare("UPDATE lietotaji SET vards = ?, uzvards = ?, epasts = ?, telefons = ? WHERE lietotaji_id = ?");
$vaicajums->bind_param("ssssi", $vards, $uzvards, $epsts, $telefons, $liet_id);

if ($vaicajums->execute()) {
    $response['success'] = true;
    $response['message'] = "Informācija veiksmīgi atjaunota!";
} else {
    $response['success'] = false;
    $response['error'] = "Kļūda sistēmā! " . $vaicajums->error;
}

$vaicajums->close();
$savienojums->close();
echo json_encode($response);

?>
