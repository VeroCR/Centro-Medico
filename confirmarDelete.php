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
<br><br><h1 class="titulo">Confirmar eliminación</h1><br><br>
    <form action="php/deleteCita.php" class="formulario" method="post">
    <div class="contenedor__cita">
		<?php echo '<input type="text" name="idCita" id="idCita" value="'.$idCita.'" readonly>'?>
    </div>
        <div class="citas">
        <table class="citas__tabla">
            <tr>
                <th>IDCita</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>IDPaciente</th>
                <th>IDMedico</th>
            </tr>
    <?php
        $cita=$usuario->getCita($idCita); 
            echo"
            <tr>
                <td>".$idCita."</td>
                <td>".$cita['Fecha']."</td>
                <td>".$cita['Hora']."</td>
                <td>".$cita['IDPaciente']."</td>
                <td>".$cita['IDMedico']."</td>
            </tr>
            ";
    ?>
        </table><br><br>
        <button class="eliminar__boton" type="submit">Eliminar</button>
        </div>
    
    
    </form>
</body>
<footer>

</footer>
</html>