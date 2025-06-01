<?php

require_once 'con_klix.php'; 

session_start();

error_reporting(E_ALL & ~E_DEPRECATED);

$price = htmlspecialchars($_GET['price']);
$table = htmlspecialchars($_GET['table']);
$announcement = htmlspecialchars($_GET['announcement']);

if (!$price ||!$table ||!$announcement) {
    header("Location: /");
    exit;
}

try {
    $purchaseResponse = $client->createPurchase([
        'amount' => $price, 
        'language' => 'lv',
        'success_redirect' => 'https://latmarket.ddev.site/payment/success.php?table=' . $table . '&announcement=' . $announcement . '&price=' . $price,
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