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
    <title>CMPH: Consultar Cita</title>
</head>
<!--Barra navegacion-->
<header class="header">
    <nav class="nav">
        <ul class="ul">
        <li class="li"><a href="inicioMedicos.php?rol=med">Inicio</a></li>
            <li class="li"><a href="formCita.php?rol=med">Registrar Cita</a></li>
            <li class="li"><a href="consultarCitaMedicos.php?rol=med">Consultar Cita</a></li>
            <li class="li"><a href="modificarCita.php?rol=med">Modificar Cita</a></li>
            <li class="li"><a href="eliminarCita.php?rol=med">Eliminar Cita</a></li>
            <li class="li"><a href="php/salir.php">Salir</a></li>
        </ul>
    </nav>
</header>
<?php           
    $id=$usuario->getId();
    $nombre=$usuario->getNombre();
    $aPat=$usuario->getAPat();
    $aMat=$usuario->getAMat();
        echo "<h1 class='titulo'>Médico: $id Nombre:  $nombre $aPat $aMat</h1>";
    ?>
<body>
    <div class="citas">
        <br><br><h1>Citas registradas</h1>
        <table class=citas__tabla>
            <tr>
                <th>IDCita</th>
                <th>Médico</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Paciente</th>
            </tr>
    <?php
        $citas=$usuario->getCitasMedico($id);
        foreach ($citas as $resultado) {
            echo"
            <tr>
                <td>".$resultado['IDCita']."</td>
                <td>".$resultado['MNombre']." ".$resultado['MApellido']."</td>
                <td>".$resultado['Fecha']."</td>
                <td>".$resultado['Hora']."</td>
                <td>".$resultado['PNombre']." ".$resultado['PApellido']."</td>
            </tr>
            ";
        }
    ?>
        </table>
    </div>
</body>
<footer>

</footer>
</html>