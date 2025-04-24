<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Latmarket || atsaukmes</title>
    <link rel="shortcut icon" href="image/Latmarket-logo-mini.png" type="image/png">
    <link rel="stylesheet" href="assets/style-main.css">
    <link rel="stylesheet" href="assets/style-atsakmes.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <script src="assets/script-main.js" defer></script>
    <script src="assets/script-atsaukmes.js" defer></script>
    <script src="assets/script-ajax.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</head>
<body>

<?php 

require "header.php";
session_start();

if(isset($_SESSION['lietotajvardsHOMIK'])){

?>

<section class="atsaukmes">

    <h1><i class="far fa-comment"></i>Atsakmes:</h1>

    <div class="atsakmesForm">

        <form id="atsakmes-form">

            <div class="stars">

                <i class="fas fa-star active" data-index="1"></i>
                <i class="fas fa-star" data-index="2"></i>
                <i class="fas fa-star" data-index="3"></i>
                <i class="fas fa-star" data-index="4"></i>
                <i class="fas fa-star" data-index="5"></i>

                <input type="hidden" id="rating-value" value="1">

                <input type="hidden" id="atsaukmes-vards" value="<?php echo $_SESSION['vardsHOMIK']; ?>">

                <input type="hidden" id="atsaukmes-uzvards" value="<?php echo $_SESSION['UzvardsHOMIK']; ?>">

                <input type="hidden" id="atsaukmes-lit-id" value="<?php echo $_SESSION['IdHOMIK']; ?>">

                <input type="hidden" id="atsaukmes-avatar" value="<?php echo $_SESSION['avatarHOMIK']; ?>">

            </div>

            <div class="textarea-long">

                <textarea maxlength="800" id="atsaukmes-text" placeholder="Uzraksti komentāru..."></textarea>

                <div class="long"></div>

            </div>
            
            <button class="atbtn" id="atbtn"><i class="fas fa-paper-plane"></i>Iesniegt</button>

        </form>

    </div>


</section>

<?php

};

?>

<section class="atsakmes-izvade">

    <div class="atsaukmes-container" id="atsaukmes-container">


    </div>

</section>

</body>
</html>
