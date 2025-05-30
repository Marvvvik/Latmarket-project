# Klix PHP library #

## Requirements ##

PHP 7.2 and later.

The following PHP extensions are required:

* curl
* json
* openssl

## Installation ##

## Composer ##

To install the bindings via [Composer](http://getcomposer.org/), add the following to `composer.json`:

```json
{
  "require": {
    "klix/klix-sdk-php": "*@dev"
  }
}
```

Then run

```bash
composer install
```

## Manual Installation ##

Download the files and include `autoload.php`:

```php
require_once('/path/to/klix-sdk-php/vendor/autoload.php');
```

## Getting Started ##

Simple usage looks like:

```php
<?php
require_once 'vendor/autoload.php';
$klix = new \Klix\KlixApi($config['brand_id'], $config['api_key'], $config['endpoint']);
$client = new \Klix\Model\ClientDetails();
$client->email = 'test@example.com';
$purchase = new \Klix\Model\Purchase();
$purchase->client = $client;
$details = new \Klix\Model\PurchaseDetails();
$product = new \Klix\Model\Product();
$product->name = 'Test';
$product->price = 100;
$details->products = [$product];
$purchase->purchase = $details;
$purchase->brand_id = $config['brand_id'];
$purchase->success_redirect = 'https://portal.klix.app/api/v1/?success=1';
$purchase->failure_redirect = 'https://portal.klix.app/api/v1/?success=0';

$result = $klix->createPurchase($purchase);

if ($result && $result->checkout_url) {
	// Redirect user to checkout
	header("Location: " . $result->checkout_url);
	exit;
}
```

Bulk payment initiation looks like:

```php
<?php
require_once 'vendor/autoload.php';
$klix = new \Klix\KlixApi($config['brand_id'], $config['api_key'], $config['endpoint']);
$client = new \Klix\Model\ClientDetails();
$client->email = 'test@example.com';
$purchase = new \Klix\Model\Purchase();
$purchase->client = $client;
$details = new \Klix\Model\PurchaseDetails();
$paymentToFirstIbanProduct = new \Klix\Model\Product();
$paymentToFirstIbanProduct->name = 'Payment to first IBAN';
$paymentToFirstIbanProduct->price = 100;
$paymentToSecondIbanProduct = new \Klix\Model\Product();
$paymentToSecondIbanProduct->name = 'Payment to second IBAN';
$paymentToSecondIbanProduct->price = 200;
$details->products = [$paymentToFirstIbanProduct, $paymentToSecondIbanProduct];
$paymentMethodDetails = new \Klix\Model\PaymentMethodDetails();
$firstCreditor = new \Klix\Model\PisBulkPurchase();
$firstCreditor->creditor_name = 'John Doe';
$firstCreditor->creditor_iban = 'LVXXPARX0000000000001';
$secondCreditor = new \Klix\Model\PisBulkPurchase();
$secondCreditor->creditor_name = 'Jane Doe';
$secondCreditor->creditor_iban = 'LVXXHABA0000000000001';
$paymentMethodDetails->pis_bulk_purchase = [$firstCreditor, $secondCreditor];
$details->payment_method_details = $paymentMethodDetails;
$purchase->purchase = $details;
$purchase->brand_id = $config['brand_id'];
$purchase->payment_method_whitelist = ['swedbank_lv_pis'];
$purchase->success_redirect = 'https://portal.klix.app/api/v1/?success=1';
$purchase->failure_redirect = 'https://portal.klix.app/api/v1/?success=0';

$result = $klix->createPurchase($purchase);

if ($result && $result->checkout_url) {
	// Redirect user to checkout
	header("Location: " . $result->checkout_url);
	exit;
}
```

## Testing ##

```bash
./vendor/bin/phpunit tests 
```
