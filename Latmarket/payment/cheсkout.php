<?php

// require_once '../../../klix/klix-sdk-php/KlixApi.php'; 
require_once 'con_klix.php'; 
session_start();

error_reporting(E_ALL & ~E_DEPRECATED);

$price = htmlspecialchars($_GET['price']);

try {
    $purchaseResponse = $client->createPurchase([
        'amount' => $price, 
        "language" => "lv",
        "success_callback" => "https://latmarket.ddev.site/payment/success.php",
        "success_redirect" => "https://latmarket.ddev.site/", 
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

    header('Location: ' . $purchaseResponse->checkout_url);
    exit;

} catch (Exception $e) {
    echo "Произошла ошибка: " . $e->getMessage();
}

?>