<?php

require_once 'con_klix.php'; 
session_start();

error_reporting(E_ALL & ~E_DEPRECATED);

$price = htmlspecialchars($_GET['price']);
$table = htmlspecialchars($_GET['table']);
$announcement = htmlspecialchars($_GET['announcement']);

try {
    $purchaseResponse = $client->createPurchase([
        'amount' => $price, 
        'language' => 'lv',
        'success_redirect' => 'https://latmarket.ddev.site/payment/success.php?table=' . $table . '&announcement=' . $announcement . '&purchase_id=' . $purchaseResponse->id,
        'purchase' => [
            "products" => [
                [
                    "name" => 'Sludinājuma izvietošana',
                    "price" => $price, 
                ],
            ],
        ],
        "client" => [
            "email" => $_SESSION['epastsHOMIK'],
        ],
        
        "brand_id" => $brandId,
    ]);
    
    $_SESSION['purchase_id'] = $purchaseResponse->id;

    header('Location: ' . $purchaseResponse->checkout_url);
    exit;

} catch (Exception $e) {
    echo "Произошла ошибка: " . $e->getMessage();
}

?>