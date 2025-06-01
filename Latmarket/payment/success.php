<?php

session_start();

require 'con_klix.php';
require "../database/con_db_l.php";

$purchaseId = $_SESSION['purchase_id'] ?? null;
$table = $_GET['table'] ?? null;
$announcement = $_GET['announcement'] ?? null;
$price = $_GET['price'] ?? null;
$lietaju_id = $_SESSION['IdHOMIK'] ;

if (!$purchaseId ||!$table ||!$announcement ||!$price ||!$lietaju_id) {
    header("Location: /");
    exit;
}

$allowedTables = ['Cars'];

if (!in_array($table, $allowedTables)) {
    header("Location: /");
    exit;
}

if ($price !== null) {
    $formattedPrice = number_format($price / 100, 2, '.', '');
}


try {
    $purchase = $client->getPurchase($purchaseId);
    $status = $purchase->status ?? null;

    if ($status === 'paid') {
        $slud = $savienojums->prepare("UPDATE $table SET Statuss = 'active' WHERE Cars_ID = ?");
        $slud->bind_param("i", $announcement);
        $slud->execute();
        $slud->close();

        $checkStmt = $savienojums->prepare("SELECT 1 FROM maksajumi WHERE maksajuma_id = ?");
        $checkStmt->bind_param("s", $purchaseId);
        $checkStmt->execute();
        $checkStmt->store_result();

        if ($checkStmt->num_rows === 0) {
            $maksajums = $savienojums->prepare("INSERT INTO maksajumi (maksajuma_id, statuss, table_name, slud_id, lietotaja_id, apmaksats) VALUES (?, ?, ?, ?, ?, ?)");
            $maksajums->bind_param("sssiid", $purchaseId, $status, $table, $announcement, $lietaju_id, $formattedPrice);
            $maksajums->execute();
            $maksajums->close();
        }
        $checkStmt->close();

        $purchaseIdUpeer = strtoupper($purchaseId);

        $check = "<div class='payment-container'>
                    <div class='payment-info'>
                        <i class='fas fa-times close-Modal' id='closePayment'></i>
                        <h1>Maksājuma čeks</h1>

                        <div class='paymeny-id'>
                            <p>Pirkums: <span>{$purchaseIdUpeer}</span></p>
                            <p>Pakalpojums: <span>Sludinājuma izvietošana</span></p>
                            <p>Cena: <span>{$formattedPrice} EUR</span></p>
                            <p>Kopā apmaksai: <span>{$formattedPrice} EUR</span></p>
                        </div>

                        <div class='success-animation'>
                            <svg class='checkmark' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 52 52'><circle class='checkmark__circle' cx='26' cy='26' r='25' fill='none' /><path class='checkmark__check' fill='none' d='M14.1 27.2l7.1 7.2 16.7-16.8' /></svg>
                        </div>

                        <div class='line'></div>

                        <p>Jūsu sludinājums ir veiksmīgi ievietots!</p>

                        <p>Paldies, ka izmantojat Latmarket! </p>

                    </div>
                </div>";

        $_SESSION['Maksājums'] = $check;
        unset($_SESSION['purchase_id']);

        header("location: ../");
        exit;
        
    } else {
        echo "Оплата не завершена. Текущий статус: " . htmlspecialchars($status);
    }
} catch (Exception $e) {
    echo "Ошибка при проверке статуса платежа: " . $e->getMessage();
}
?>
