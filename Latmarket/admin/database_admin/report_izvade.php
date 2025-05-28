<?php

require "con_db_l.php";
session_start();

$limit = 5;
$page = isset($_POST['page']) ? (int)$_POST['page'] : 1;
$offset = ($page - 1) * $limit;

$countQuery = "SELECT COUNT(*) AS total FROM Atsauksmes_Report";
$countResult = $savienojums->query($countQuery);
$totalRows = $countResult->fetch_assoc()['total'];
$totalPages = ceil($totalRows / $limit);

$reportSQL = "SELECT * FROM Atsauksmes_Report ORDER BY datums DESC LIMIT ? OFFSET ?";
$report = $savienojums->prepare($reportSQL);
$report->bind_param("ii", $limit, $offset);
$report->execute();
$reportResult = $report->get_result();

$atsaukmesHTML = '';

while ($reports = $reportResult->fetch_assoc()) {
    
    $config = require 'config.php';
    $encryptionKey = $config['encryption_key'];

    define('ENCRYPTION_KEY', $encryptionKey); 
    define('ENCRYPTION_METHOD', 'AES-256-CBC');

    function decryptData($data) {
        $data = base64_decode($data);
        $ivLength = openssl_cipher_iv_length(ENCRYPTION_METHOD);
        $iv = substr($data, 0, $ivLength);
        $encrypted = substr($data, $ivLength);
        return openssl_decrypt($encrypted, ENCRYPTION_METHOD, ENCRYPTION_KEY, 0, $iv);
    }

    $autoruSQL = "SELECT * FROM lietotaji WHERE lietotaji_id = ?";
    $reportAutor = $savienojums->prepare($autoruSQL);
    $reportAutor->bind_param("i", $reports['autora_id']);
    $reportAutor->execute();
    $autorsResult = $reportAutor->get_result();
    $autors = $autorsResult->fetch_assoc(); 

    $Izvade_vards = decryptData($autors['vards']);
    $Izvade_Uzvards = decryptData($autors['uzvards']);

    $fotoUrl = 'data:image/jpeg;base64,' . base64_encode($autors['avatar']);

    $datums = date('Y-m-d', strtotime($reports['datums']));

    $atsaukmesHTML .= "
        <div class='box'>
            <div class='report-Info'>

                <div class='name-container'>

                    <div class='avatarAt'>
                        <img src='$fotoUrl'>
                    </div>

                    <h1>$Izvade_vards $Izvade_Uzvards</h1>

                </div>

                <div class='edit-buttons'>

                    <i class='fa fa-trash' id='delet'></i>

                </div>

            </div>

            <div class='report-text'>
            
                <h2>Kategorija: <span>{$reports['rep_title']}</sapn></h2>
                <p>{$reports['rep_text']}</p>
            
            </div>
            <div class='extraInfo'>

                <p>Profila ID: {$reports['autora_id']}</p>

                <p>Atsakmes ID: {$reports['atsaukmes_id']}</p>

                <p>Datums: $datums</p>

            </div>
        </div>";

}

echo json_encode([
    'comments' => $atsaukmesHTML,
    'totalPages' => $totalPages
]);
?>