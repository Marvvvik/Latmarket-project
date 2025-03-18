<?php

    $servers = "localhost";
    $lietotajs = "root";
    $parole = "";
    $db_nosaukums = "Transports";

    $savienojums = mysqli_connect($servers, $lietotajs, $parole, $db_nosaukums);


    if(!$savienojums){

       #die("Kļuda ar datubazi!eror 404".mysqli_connect_errno());

    }else{

       #echo "Savienojums veiksmigs!";

    }

?>