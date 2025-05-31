<?php

session_start();

require 'con_klix.php';
require "../database/con_db_l.php";

$purchaseId = $_SESSION['purchase_id'] ?? null;
$table = $_GET['table'] ?? null;
$announcement = $_GET['announcement'] ?? null;

try {
    $purchase = $client->getPurchase($purchaseId);
    $status = $purchase->status ?? null;

    if ($status === 'paid') {
        $stmt = $savienojums->prepare("UPDATE $table SET Statuss = 'active' WHERE Cars_ID = ?");
        $stmt->bind_param("i", $announcement);
        $stmt->execute();
        $stmt->close();

        header("location: ../");
        exit;
        
    } else {
        echo "Оплата не завершена. Текущий статус: " . htmlspecialchars($status);
    }
} catch (Exception $e) {
    echo "Ошибка при проверке статуса платежа: " . $e->getMessage();
}
?>

    <!-- <div class="payment-container">
        <div class="payment-info">
            <i class="fas fa-times close-Modal" id="closePayment"></i>
            <h1>Maksājuma čeks</h1>

            <div class="paymeny-id">
                <p>Pirkums: <span>FJG345KJGHB34GGJK5</span></p>
                <p>Pakalpojums: <span>Sludinājuma izvietošana</span></p>
                <p>Cena: <span>5.00 EUR</span></p>
                <p>Kopā apmaksai: <span>5.00 EUR</span></p>
            </div>

            <div class="success-animation">
                <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52"><circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none" /><path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8" /></svg>
            </div>

            <div class="line"></div>

            <p>Jūsu sludinājums ir veiksmīgi ievietots!</p>

            <p>Paldies, ka izmantojat Latmarket! </p>

        </div>
    </div> -->