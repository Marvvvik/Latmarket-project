<?php
require "con_db_l.php";
session_start();

$response = [];

$atsakmes_id = htmlspecialchars($_POST['atsakmes_id']);
$rep_title = htmlspecialchars($_POST['rep_title']);
$rep_text = htmlspecialchars($_POST['rep_text']);
$autora_id = $_SESSION['IdHOMIK'];

if (!empty($rep_title)) { 
    if (!empty($rep_text)) { 
        if (!empty($rep_text) && strlen($rep_text) <= 800) { 

            $check_query = $savienojums->prepare("SELECT COUNT(*) FROM Atsauksmes_Report WHERE atsaukmes_id = ? AND autora_id = ?");
            $check_query->bind_param("ii", $atsakmes_id, $autora_id);
            $check_query->execute();
            $check_query->bind_result($report_count);
            $check_query->fetch();
            $check_query->close();
            
            if ($report_count > 0) {
                $response['success'] = false;
                $response['error'] = "Jūs jau ir aktīvs ziņojums uz šo atsauksmi!";
            } else {
                $vaicajums = $savienojums->prepare("INSERT INTO Atsauksmes_Report (atsaukmes_id, rep_title, rep_text, autora_id) VALUES (?, ?, ?, ?)");
                $vaicajums->bind_param("issi", $atsakmes_id, $rep_title, $rep_text, $autora_id);

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
