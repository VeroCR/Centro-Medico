<?php
    include "usuario.php";

    $usuario = new Usuario();

    $fecha=$_POST['fecha'];
    $hora=$_POST['hora'];
    $idPaciente=$_POST['idPaciente'];
    $idMedico=$_POST['idMedico'];
    $rol=$_POST['rol'];

    $usuario->registrarCita($fecha, $hora, $idPaciente, $idMedico,$rol);

?>
