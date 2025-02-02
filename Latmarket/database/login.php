<?php

require "con_db_l.php";

if (isset($_POST["ielogoties"])) {

    session_start();

    $lietotajvards = htmlspecialchars($_POST['lietotajvards']);
    $parole = $_POST['parole']; 

    $vaicajums = $savienojums->prepare("SELECT * FROM lietotaji WHERE username = ?");
    $vaicajums->bind_param("s", $lietotajvards);
    $vaicajums->execute();

    $resultats = $vaicajums->get_result();
    $lietotajs = $resultats->fetch_assoc();

    if(!empty($lietotajvards) && !empty($parole)){

        if ($lietotajs && password_verify($parole, $lietotajs['parole'])) {

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
    

    header('Location: ../');
    $vaicajums->close();
    $savienojums->close();
}
?>
