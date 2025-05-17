<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Latmarket || atsaukmes</title>
    <link rel="shortcut icon" href="image/Latmarket-logo-mini.png" type="image/png">
    <link rel="stylesheet" href="assets/style-main.css">
    <link rel="stylesheet" href="assets/style-atsauksmes.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <script src="assets/script-main.js" defer></script>
    <script src="assets/script-atsaukmes.js" defer></script>
    <script src="assets/script-ajax.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</head>
<body>

<?php 
require "header.php";
if(session_status() === PHP_SESSION_ACTIVE && isset($_SESSION['lietotajvardsHOMIK'])){
?>

<section class="review">

  <h1 class="review__title"><i class="far fa-comment"></i>Atsauksmes</h1>

  <div class="review__form-wrapper">
    <form id="review-form" class="review__form">

      <div class="review__stars">
        <i class="fas fa-star active" data-index="1"></i>
        <i class="fas fa-star" data-index="2"></i>
        <i class="fas fa-star" data-index="3"></i>
        <i class="fas fa-star" data-index="4"></i>
        <i class="fas fa-star" data-index="5"></i>

        <input type="hidden" id="review-rating" value="1">
        <input type="hidden" id="review-user-firstname" value="<?php echo $_SESSION['vardsHOMIK']; ?>">
        <input type="hidden" id="review-user-lastname" value="<?php echo $_SESSION['UzvardsHOMIK']; ?>">
        <input type="hidden" id="review-user-id" value="<?php echo $_SESSION['IdHOMIK']; ?>">
        <input type="hidden" id="review-user-avatar" value="<?php echo $_SESSION['avatarHOMIK']; ?>">
      </div>

      <div class="review__textarea-group">
        <textarea maxlength="800" id="review-text" placeholder="Uzraksti komentāru..."></textarea>
        <div class="review__char-limit"></div>
      </div>

      <button type="submit" class="review__submit-button" id="submit-review"><i class="fas fa-paper-plane"></i> Iesniegt</button>

    </form>
  </div>

</section>

<?php }; ?>

<div class="review__output_buttons"></div>

<section class="review__output">
  <div class="review__list" id="review-output-container"></div>
</section>

<?php require "footer.php"; ?>

</body>
</html>
