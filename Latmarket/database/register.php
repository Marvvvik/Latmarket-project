<?php

require "con_db_l.php";
session_start();

$response = [];

$config = require 'config.php';
define('ENCRYPTION_KEY', $config['encryption_key']);
define('ENCRYPTION_METHOD', 'AES-256-CBC');

function encryptData($data) {
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length(ENCRYPTION_METHOD));
    $encrypted = openssl_encrypt($data, ENCRYPTION_METHOD, ENCRYPTION_KEY, 0, $iv);
    return base64_encode($iv . $encrypted);
}

$lietotajvards = htmlspecialchars($_POST['username']);
$parole1 = htmlspecialchars($_POST['rpassword1']);
$parole2 = htmlspecialchars($_POST['rpassword2']);
$avatar = isset($_FILES['avatar']) ? $_FILES['avatar'] : null;

$vards = "Unknown";
$uzvards = "Unknown";
$epasts = "Unknown";
$telefons = "Unknown";

$vards_db = encryptData($vards);
$uzvards_db = encryptData($uzvards);
$epasts_db = encryptData($epasts);
$telefons_db = encryptData($telefons);

function validatePassword($password) {
    return preg_match('/[a-z]/', $password) &&
           preg_match('/[A-Z]/', $password) &&
           preg_match('/\d/', $password) &&
           preg_match('/[^a-zA-Z0-9\s]/', $password) &&
           strlen($password) >= 8 && strlen($password) <= 20;
}

if (!empty($lietotajvards) && !empty($parole1) && !empty($parole2)) { 
    if ($parole1 === $parole2) { 
        if (validatePassword($parole1)) { 

            $vaicajums = $savienojums->prepare("SELECT * FROM lietotaji WHERE username = ?");
            $vaicajums->bind_param("s", $lietotajvards);
            $vaicajums->execute();
            $rezultats = $vaicajums->get_result();

            if ($rezultats->num_rows > 0) { 
                $response['success'] = false;
                $response['error'] = "Lietotājs ar šādu vārdu jau pastāv!";
            } else {
                $hashedPassword = password_hash($parole1, PASSWORD_BCRYPT); 

                if ($avatar && $avatar['error'] == UPLOAD_ERR_OK) {  
                    $avatarData = file_get_contents($avatar['tmp_name']);
                } else {
                    $avatarData = file_get_contents('../image/Unknown_person.jpg');
                }

                $null = NULL;
                $vaicajums = $savienojums->prepare("INSERT INTO lietotaji (username, parole, vards, uzvards, epasts, telefons, avatar) VALUES (?, ?, ?, ?, ?, ?, ?)");
                $vaicajums->bind_param("ssssssb", $lietotajvards, $hashedPassword, $vards_db, $uzvards_db, $epasts_db, $telefons_db, $null);
                $vaicajums->send_long_data(6, $avatarData);

                if ($vaicajums->execute()) {
                    $response['success'] = true;
                    $response['message'] = "Lietotājs veiksmīgi izveidots!";
                } else {
                    $response['success'] = false;
                    $response['error'] = "Kļūda sistēmā! " . $vaicajums->error;
                }
            }
            $vaicajums->close();
        } else {
            $response['success'] = false;
            $response['error'] = "Parole neatbilst prasībām!";
        }
    } else {
        $response['success'] = false;
        $response['error'] = "Paroles nesakrīt!";
    }
} else {
    $response['success'] = false;
    $response['error'] = "Visi lauki nav aizpildīti!";
}

$savienojums->close();
echo json_encode($response);

?>
