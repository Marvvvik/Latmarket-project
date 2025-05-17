<?php if(!isset($_SESSION['lietotajvardsHOMIK'])) { ?>

<!DOCTYPE html>
<html lang="lv">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Latmarket || Paroles atjaunošana</title>
  <link rel="shortcut icon" href="image/Latmarket-logo-mini.png" type="image/png">
  <link rel="stylesheet" href="assets/style-main.css">
  <link rel="stylesheet" href="assets/style-changePass.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
  <script src="assets/script-ajax.js" defer></script>
  <script src="assets/script-main.js" defer></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>

<?php require "header.php"; ?>

<main class="password-reset">

  <div class="password-reset__back">
    <a href="/index.php"><i class="fas fa-angle-left"></i> Atgriezties uz sākumlapu</a>
  </div>

  <section class="password-reset__form-container">

    <h1 class="password-reset__title">Paroles atjaunošana</h1>

    <p class="password-reset__instruction">Ievadiet lietotājvārdu vai e-pasta adresi, kas tika norādīta reģistrējoties vai konta iestatījumos.</p>

    <form class="password-reset__form">

      <div class="password-reset__input-group">
        <label for="username-email">Lietotājvārds vai e-pasts</label>
        <input type="text" id="username-email" name="username-email" placeholder="Ievadiet lietotājvārdu vai e-pastu..." required>
      </div>

      <button type="submit" class="password-reset__submit-button"><i class="fas fa-paper-plane"></i> Nosūtīt instrukcijas</button>

    </form>

  </section>

</main>

</body>
</html>

<?php }else{ header("Location: ../"); exit();} ?>
