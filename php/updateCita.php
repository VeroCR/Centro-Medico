<?php
    include "usuario.php";

    $usuario = new Usuario();

    $idCita=$_POST['idCita'];
    $fecha=$_POST['fecha'];
    $hora=$_POST['hora'];
    $idPaciente=$_POST['idPaciente'];
    $idMedico=$_POST['idMedico'];

    $usuario->uptdateCita($idCita, $fecha, $hora, $idPaciente, $idMedico);

?>