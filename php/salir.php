<?php

    include_once 'sesion.php';

    $userSession = new Sesion();
    $userSession->closeSession();

    header("location: ../index.html");

?>