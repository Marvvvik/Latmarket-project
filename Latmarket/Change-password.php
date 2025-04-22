<?php
session_start();

if(!isset($_SESSION['lietotajvardsHOMIK'])) {

?>

<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Latmarket || Aizmirsi paroli</title>
    <link rel="shortcut icon" href="image/Latmarket-logo-mini.png" type="image/png">
    <link rel="stylesheet" href="assets/style-main.css">
    <link rel="stylesheet" href="assets/style-changePass.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <script src="assets/script-ajax.js" defer></script>
    <script src="assets/script-main.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</head>

<body>

<?php

require "header.php";

?>

<section class="changePass">

    <div class="btnback"><a href="/index.php"><i class="fas fa-angle-left"></i>Atgriezties uz sākumlapu</a></div>
    <div class="selectUser">

        <h1>Paroles atjaunošana</h1>

        <P>Ievadiet lietotājvārdu, norādīto reģistrācijas laikā, vai e-pasta adresi, kas norādīta konta iestatījumos.</P>

        <form>

            <div class="user-email">
                <label>Lietotājvārds vai e-pasts</label>
                <input type="text" placeholder="Ievadiet lietotājvārdu vai e-pastu...">
            </div>

            <button><i class="fas fa-paper-plane"></i>Nosūtīt instrukcijas</button>

        </form>

    </div>

</section>

</body>

<?php

}else{

header("Location: ../");
exit();

}

?>

</html>