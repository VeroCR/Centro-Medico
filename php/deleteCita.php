<?php
    include "usuario.php";

    $usuario = new Usuario();

    $idCita=$_POST['idCita'];

    $usuario->deleteCita($idCita)

?>