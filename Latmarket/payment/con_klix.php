<?php
session_start();

if (php_sapi_name() !== 'cli' && realpath(__FILE__) === realpath($_SERVER['SCRIPT_FILENAME'])) {
header('Location: /');
exit;
}

require __DIR__ . '../../vendor/autoload.php'; 

use Klix\KlixApi;

$brandId = '702314b8-dd86-41fa-9a22-510fdd71fa92';
$secretKey = 'IB-bzOdJLgJjbsaA34Qpxkg1TTIrW-iDuni6JuzbP--KgtsREHzvIvLLTH8E5T0CZcSbYM3qNmfeogpWW_RZaA==';

$client = new KlixApi($brandId, $secretKey);

// echo "Klix SDK успешно подключен!";