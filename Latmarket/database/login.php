<?php

require "con_db_l.php";
session_start();

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

if (isset($_POST["login"])) {

    $lietotajvards = htmlspecialchars($_POST['username']);
    $parole = $_POST['password']; 

    $vaicajums = $savienojums->prepare("SELECT * FROM lietotaji WHERE username = ?");
    $vaicajums->bind_param("s", $lietotajvards);
    $vaicajums->execute();

    $resultats = $vaicajums->get_result();
    $lietotajs = $resultats->fetch_assoc();

    if (!empty($lietotajvards) && !empty($parole)) {
        if ($lietotajs && password_verify($parole, $lietotajs['parole'])) {

            $_SESSION['IdHOMIK'] = $lietotajs['lietotaji_id'];
            $_SESSION['lietotajvardsHOMIK'] = $lietotajs['username'];
            $_SESSION['vardsHOMIK'] = decryptData($lietotajs['vards']);
            $_SESSION['UzvardsHOMIK'] = decryptData($lietotajs['uzvards']);
            $_SESSION['epastsHOMIK'] = decryptData($lietotajs['epasts']);
            $_SESSION['telefonsHOMIK'] = decryptData($lietotajs['telefons']);
            $_SESSION['avatarHOMIK'] = 'data:image/jpeg;base64,' . base64_encode($lietotajs['avatar']);
            $_SESSION['rooleHOMIK'] = $lietotajs['roole'];

            if ($_SESSION['rooleHOMIK'] === 'admin') {
                header('Location: ../admin/index.php');
            } else {
                $redirect_url = !empty($_POST['redirect']) ? $_POST['redirect'] : '../';
                header('Location: ' . $redirect_url);
            }

            exit;

        } else {
            $_SESSION['log_paz'] = "Nepareizs logins vai parole!";
        }
    } else {
        $_SESSION['log_paz'] = "Visi lauki nav aizpildīti!";
    }
    
    $vaicajums->close();
    $savienojums->close();
}
?>