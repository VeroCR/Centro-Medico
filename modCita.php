<?php
    include "php/usuario.php";
    include "php/sesion.php";
    $usuario = new Usuario();
    $sesion = new Sesion();

    if(isset($_SESSION['id'])){
        if(!isset($_GET['rol'])){
            $sesion->closeSession();
            header("location: index.html");
        }else{
            $rol = $_GET['rol'];
            if($rol == "med"){
                $usuario->setMedico($sesion->getCurrentUser());
                $id=$usuario->getId();
                $idCita=$_GET['idCita'];
            }
            else if($rol == "pac"){
                header("location: inicioPacientes.php?rol=pac");
            }
        } 
    }else{
        header("location: iniciarSesion.php");
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/styles.css"/>
    <title>CMPH: Modificar Cita</title>
</head>
<!--Barra navegacion-->
<header class="header">
    <nav class="nav">
        <ul class="ul">
            <li class="li"><a href="formCita.php?rol=med">Registrar Cita</a></li>
            <li class="li"><a href="consultarCitaMedicos.php?rol=med">Consultar Cita</a></li>
            <li class="li"><a href="modificarCita.php?rol=med">Modificar Cita</a></li>
            <li class="li"><a href="eliminarCita.php?rol=med">Eliminar Cita</a></li>
            <li class="li"><a href="php/salir.php">Salir</a></li>
        </ul>
    </nav>
</header>
<body>
<br><br><h1 class="titulo">Modificar Cita</h1><br><br>
    <div class="contenedor">
    <form action="php/updateCita.php" class="formulario" method="post">
    <?php
        $cita=$usuario->getCita($idCita);   
    ?>
    <div class="cita">
        <label>ID Cita: </label>
        <input type="text" name="idCita" id="idCita" value="<?php echo $idCita ?>" readonly>
    </div>
    <div class="cita">
        <label>Fecha: </label>
        <input type="text" name="fecha" id="fecha" value="<?php echo $cita['Fecha'] ?>" required>
    </div>
    <div class="cita">
        <label>Hora: </label>
        <input type="text" name="hora" id="hora" value="<?php echo $cita['Hora'] ?>" required>
    </div>
    <div class="cita">
        <label>ID Paciente: </label>
        <input type="text" name="idPaciente" id="idPaciente" value="<?php echo $cita['IDPaciente'] ?>" required>
    </div>
    <div class="cita">
        <label>ID Médico: </label>
        <input type="text" name="idMedico" id="idMedico" value="<?php echo $cita['IDMedico'] ?>" required>
    </div>
    
    <button class="contenedor__boton" type="submit">Guardar</button>
</div>
</body>
<footer>

</footer>
</html>