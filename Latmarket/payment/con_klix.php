<?php

require __DIR__ . '../../vendor/autoload.php'; 

use Klix\KlixApi;

$brandId = '702314b8-dd86-41fa-9a22-510fdd71fa92';
$secretKey = 'No51P_Dq4jQGeha6_eQpfjAFe67u3QYHEO95jrcCux0zPfByd8x9poSa6xINQPz1hyUGKNYoxa16rnUkSUI_MA==';

$client = new KlixApi($brandId, $secretKey);

// echo "Klix SDK успешно подключен!";