<?php
  // подключение к базе данных (DDEV)
  $servers = "db"; // хост базы данных внутри DDEV
  $lietotajs = "root"; // стандартный пользователь DDEV
  $parole = "root"; // стандартный пароль DDEV
  $db_nosaukums = "Latmarket"; // стандартное имя базы данных DDEV

  $savienojums = mysqli_connect($servers, $lietotajs, $parole, $db_nosaukums);

  if (!$savienojums) {
    die("Kļūda ar datubāzi! Error: " . mysqli_connect_error());
  } else {
    // echo "Savienojums veiksmīgs!";
  }
?>