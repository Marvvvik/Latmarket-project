<?php
require "con_db_l.php";
session_start();

header("Content-Type: application/json");
$response = [];

// Saņemam datus no formas
$liet_id = htmlspecialchars($_POST['liet_id']);
$vards = htmlspecialchars($_POST['vards']);
$uzvards = htmlspecialchars($_POST['uzvards']);
$epasts = htmlspecialchars($_POST['epasts']);
$telefons = htmlspecialchars($_POST['telefons']);
$editParole1 = trim(htmlspecialchars($_POST['password1']));
$editParole2 = trim(htmlspecialchars($_POST['password2']));
$editPassActive = filter_var($_POST['editPassActive'], FILTER_VALIDATE_BOOLEAN);


$vaicajums = $savienojums->prepare("SELECT vards, uzvards, epasts, telefons FROM lietotaji WHERE lietotaji_id = ?");
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

                
                $vaicajums = $savienojums->prepare("UPDATE lietotaji SET vards = ?, uzvards = ?, epasts = ?, telefons = ?, parole = ? WHERE lietotaji_id = ?");
                $vaicajums->bind_param("sssssi", $vards, $uzvards, $epasts, $telefons, $hashedPassword, $liet_id);

                if ($vaicajums->execute()) {
                    
                    $_SESSION['vardsHOMIK'] = $vards;
                    $_SESSION['UzvardsHOMIK'] = $uzvards;
                    $_SESSION['epastsHOMIK'] = $epasts;
                    $_SESSION['telefonsHOMIK'] = $telefons;

                    $response['success'] = true;
                    $response['message'] = "Dati veiksmīgi atjaunoti!";
                } else {
                    $response['success'] = false;
                    $response['error'] = "Sistēmas kļūda.";
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
        $response['error'] = "Parole netika ievadīta.";
    }
} else {
   
    $vards = !empty($vards) ? $vards : $lietotajs['vards'];
    $uzvards = !empty($uzvards) ? $uzvards : $lietotajs['uzvards'];
    $epasts = !empty($epasts) ? $epasts : $lietotajs['epasts'];
    $telefons = !empty($telefons) ? $telefons : $lietotajs['telefons'];

    $vaicajums = $savienojums->prepare("UPDATE lietotaji SET vards = ?, uzvards = ?, epasts = ?, telefons = ? WHERE lietotaji_id = ?");
    $vaicajums->bind_param("ssssi", $vards, $uzvards, $epasts, $telefons, $liet_id);

    if ($vaicajums->execute()) {
        
        $_SESSION['vardsHOMIK'] = $vards;
        $_SESSION['UzvardsHOMIK'] = $uzvards;
        $_SESSION['epastsHOMIK'] = $epasts;
        $_SESSION['telefonsHOMIK'] = $telefons;

        $response['success'] = true;
        $response['message'] = "Dati veiksmīgi atjaunoti!";
    } else {
        $response['success'] = false;
        $response['error'] = "Sistēmas kļūda.";
    }
}

$savienojums->close();
echo json_encode($response);
exit;
?>
