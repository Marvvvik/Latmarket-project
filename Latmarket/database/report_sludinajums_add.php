<?php
require "con_db_l.php";
session_start();

$response = [];

$slud_id = htmlspecialchars($_POST['Sludinajums']);
$rep_title = htmlspecialchars($_POST['rep_title']);
$rep_text = htmlspecialchars($_POST['rep_text']);
$Table_name = htmlspecialchars($_POST['SludinajumsKategori']);
$autora_id = $_SESSION['IdHOMIK'];

if($Table_name == "Car"){ $table = "Cars";}

if (!empty($rep_title)) { 
    if (!empty($rep_text)) { 
        if (!empty($rep_text) && strlen($rep_text) <= 800) { 

            $check_query = $savienojums->prepare("SELECT COUNT(*) FROM Sludinajumu_report WHERE Sludinajumu_id = ? AND autora_id = ? AND Table_name = ?");
            $check_query->bind_param("iis", $slud_id, $autora_id, $table);
            $check_query->execute();
            $check_query->bind_result($report_count);
            $check_query->fetch();
            $check_query->close();
            
            if ($report_count > 0) {
                $response['success'] = false;
                $response['error'] = "Jūs jau ir aktīvs ziņojums uz šo sludinājumu!";
            } else {
                $vaicajums = $savienojums->prepare("INSERT INTO Sludinajumu_report (Sludinajumu_id, Table_name, Report_title, Report_text, autora_id) VALUES (?, ?, ?, ?, ?)");
                $vaicajums->bind_param("isssi", $slud_id, $table, $rep_title, $rep_text, $autora_id);

                if ($vaicajums->execute()) {
                    $response['success'] = true;
                    $response['message'] = "Ziņojums veiksmīgi izvietota!";
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
        $response['error'] = "Nav ievadīts ziņojuma teksts!";
    }
} else {
    $response['success'] = false;
    $response['error'] = "Nav norādita ziņojuma kategorija!";
}

$savienojums->close();
echo json_encode($response);
exit;
?>
