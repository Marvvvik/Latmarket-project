<?php
    // закрытие сестии 
    session_start();
    session_destroy();
    header("Location: ../");

?>