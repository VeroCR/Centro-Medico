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
    <title>CMPH: Inicio Médicos</title>
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
<?php
        $nombre=$usuario->getNombre();
        $aPat=$usuario->getAPat();
        $aMat=$usuario->getAMat();
            echo "<h1 class='titulo'>Bienvenido $nombre $aPat $aMat</h1>
            <br><br><h1 class='titulo'>!Has ingresado como Médico!</h1>";
    ?>
<body>
    
</body>
<footer>

</footer>
</html>