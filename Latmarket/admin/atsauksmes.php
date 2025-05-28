<?php
session_start();

if (
    session_status() === PHP_SESSION_ACTIVE &&
    isset($_SESSION['lietotajvardsHOMIK']) &&
    isset($_SESSION['rooleHOMIK']) &&
    $_SESSION['rooleHOMIK'] === 'admin'
) {
?>

<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Latmarket || Atsauksmes</title>
    <link rel="shortcut icon" href="../image/Latmarket-logo-mini.png" type="image/png">
    <link rel="stylesheet" href="assets/style-main.css">
    <link rel="stylesheet" href="assets/style-atsaukmes.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <script src="assets/script-ajax.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</head>
<body>

<?php 

require "navigation.php";

?>

<section id="atsaukmes">

    <div class="atsaukmes-contaner">

        <div class="box">

            <div class="box-title">

                <h1>Ziņojumi</h1>

            </div>

            <form>

                <div class="search-input">
                
                    <input type="text">

                    <i  class="fas fa-search"></i>

                </div>

            </form>

            <div class="report-button-container">


            </div>

            <div id="report-rewiew-container">


            </div>

        </div>

        <div class="box">

            <div class="box-title">

                <h1>Sludinajumi</h1>

            </div>

            <form>

                <div class="search-input">
                
                    <input type="text">

                    <i  class="fas fa-search"></i>

                </div>

            </form>

            <div class="atsauksmes-button-container">


            </div>

            <div id="atsauksmes-rewiew-container">


            </div>

        </div>

    </div>

</section>

</body>
</html>
<?php
} else {
    header("Location: /index.php");
    exit;
}
?>