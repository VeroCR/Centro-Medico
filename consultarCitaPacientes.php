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
            if($rol == "pac"){
                $usuario->setPaciente($sesion->getCurrentUser());
            }
            else if($rol == "med"){
                header("location: inicioMedicos.php?rol=med");
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
            <li class="li"><a href="inicioPacientes.php?rol=pac">Inicio</a></li>
            <li class="li"><a href="formCita.php?rol=pac">Registrar Cita</a></li>
            <li class="li"><a href="consultarCitaPacientes.php?rol=pac">Consultar Cita</a></li>
            <li class="li"><a href="php/salir.php">Salir</a></li>
        </ul>
    </nav>
</header>
<?php           
    $id=$usuario->getId();
    $nombre=$usuario->getNombre();
    $aPat=$usuario->getAPat();
    $aMat=$usuario->getAMat();
        echo "<h1 class='titulo'>Paciente: $id Nombre:  $nombre $aPat $aMat</h1>";
    ?>
<body>
    <div class="citas">
        <br><br><h1>Citas registradas</h1>
        <table class=citas__tabla>
            <tr>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Médico</th>
                <th>Especialidad</th>
                <th>Consultorio</th>
            </tr>
    <?php
        $citas=$usuario->getCitasPaciente($id);
        foreach ($citas as $resultado) {
            echo"
            <tr>
                <td>".$resultado['fecha']."</td>
                <td>".$resultado['hora']."</td>
                <td>".$resultado['nombre']." ".$resultado['ApellidoPaterno']."</td>
                <td>".$resultado['Especialidad']."</td>
                <td>".$resultado['Consultorio']."</td>
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