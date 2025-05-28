<?php
  $servers = "db"; 
  $lietotajs = "root"; 
  $parole = "root"; 
  $db_nosaukums = "Latmarket"; 

  $savienojums = mysqli_connect($servers, $lietotajs, $parole, $db_nosaukums);

  if (!$savienojums) {
    die("Kļūda ar datubāzi! Error: " . mysqli_connect_error());
  } else {
    // echo "Savienojums veiksmīgs!";
  }
?>