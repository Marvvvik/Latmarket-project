<?php

require "con_db_l.php";

if (isset($_POST["ielogoties"])) {

    session_start();

    // получаем данные с формы

    $lietotajvards = htmlspecialchars($_POST['lietotajvards']);
    $parole = $_POST['parole']; 

    // получаем данных пользователя с базы данных
    $vaicajums = $savienojums->prepare("SELECT * FROM lietotaji WHERE username = ?");
    $vaicajums->bind_param("s", $lietotajvards);
    $vaicajums->execute();

    $resultats = $vaicajums->get_result();
    $lietotajs = $resultats->fetch_assoc();

    if(!empty($lietotajvards) && !empty($parole)){  // проверяюб не пустые ли поля 

        if ($lietotajs && password_verify($parole, $lietotajs['parole'])) {  // проверяюб совпадение данных

            $_SESSION['IdHOMIK'] = $lietotajs['lietotaji_id'];

            $_SESSION['lietotajvardsHOMIK'] = $lietotajs['username'];

            $_SESSION['vardsHOMIK'] = $lietotajs['vards'];

            $_SESSION['UzvardsHOMIK'] = $lietotajs['uzvards'];

            $_SESSION['epastsHOMIK'] = $lietotajs['epasts'];

            $_SESSION['telefonsHOMIK'] = $lietotajs['telefons'];

            $_SESSION['avatarHOMIK'] = 'data:image/jpeg;base64,' . base64_encode($lietotajs['avatar']);

        } else {
        
            echo $_SESSION['log_paz'] = "Nepareizs logins vai parole!";

        }

    }else{
        
        echo $_SESSION['log_paz'] = "Visi lauki nav aizpilditi!";

    }

    if (isset($_POST['redirect']) && !empty($_POST['redirect'])) {
        $redirect_url = $_POST['redirect'];
    } else {
        $redirect_url = '../';
    }
    

    header('Location: ' . $redirect_url);
    $vaicajums->close();
    $savienojums->close();
}
?>
