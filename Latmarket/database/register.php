<?php

require "con_db_l.php";
session_start();

$response = [];

// получаем данные с ajax 

$lietotajvards = htmlspecialchars($_POST['username']);
$parole1 = htmlspecialchars($_POST['rpassword1']);
$parole2 = htmlspecialchars($_POST['rpassword2']);
$avatar = isset($_FILES['avatar']) ? $_FILES['avatar'] : null;

// функция для проверки пароля по критериям 

function validatePassword($password) {
    return preg_match('/[a-z]/', $password) &&
           preg_match('/[A-Z]/', $password) &&
           preg_match('/\d/', $password) &&
           preg_match('/[^a-zA-Z0-9\s]/', $password) &&
           strlen($password) >= 8 && strlen($password) <= 20;
}

if (!empty($lietotajvards) && !empty($parole1) && !empty($parole2)) { // проверяю не пустые ли поля 
    if ($parole1 === $parole2) { // проверяю совподают ли пароли  
        if (validatePassword($parole1)) { // проверпяю соответствует ли пароль критериям 

            $vaicajums = $savienojums->prepare("SELECT * FROM lietotaji WHERE username = ?");
            $vaicajums->bind_param("s", $lietotajvards);
            $vaicajums->execute();
            $rezultats = $vaicajums->get_result();

            if ($rezultats->num_rows > 0) {  // проверяю ести ли уже пользователь с таким ником 
                $response['success'] = false;
                $response['error'] = "Lietotājs ar šādu vārdu jau pastāv!";
            } else {
                $hashedPassword = password_hash($parole1, PASSWORD_BCRYPT);  // хеширую пароль

                if ($avatar && $avatar['error'] == UPLOAD_ERR_OK) {   // добавляю базовую аватарку
                    $avatarData = file_get_contents($avatar['tmp_name']);
                } else {
                    $avatarData = file_get_contents('../image/Unknown_person.jpg');
                }

                $vaicajums = $savienojums->prepare("INSERT INTO lietotaji (username, parole, avatar) VALUES (?, ?, ?)"); // добавляю данные в базу данных
                $null = NULL;
                $vaicajums->bind_param("ssb", $lietotajvards, $hashedPassword, $null);
                $vaicajums->send_long_data(2, $avatarData);

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
