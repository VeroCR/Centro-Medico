<?php
include "php/usuario.php";
include "php/sesion.php";
$usuario = new Usuario();
$sesion = new Sesion();

if (isset($_SESSION['id'])) {
    if (!isset($_GET['rol'])) {
        $sesion->closeSession();
        header("location: index.html");
    } else {
        $rol = $_GET['rol'];
        if ($rol == "med") {
            $usuario->setMedico($sesion->getCurrentUser());
        } else if ($rol == "pac") {
            header("location: inicioPacientes.php?rol=pac");
        }
    }
} else {
    header("location: iniciarSesion.php");
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/styles.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <title>CMPH: Consultar Cita</title>
</head>
<!--Barra navegacion-->
<nav class="navbar navbar-expand-md sticky-top" style="background-color: #e3f2fd;">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.html">
            <img src="Assets/Logo CMPH.png" alt="" width="80" height="">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link" href="inicioMedicos.php?rol=med">Inicio</a>
                <a class="nav-link" href="formCita.php?rol=med">Registrar cita</a>
                <a class="nav-link" href="consultarCitaMedicos.php?rol=med">Consultar Cita</a>
                <a class="nav-link" href="modificarCita.php?rol=med">Modificar Cita</a>
                <a class="nav-link" href="eliminarCita.php?rol=med">Eliminar Cita</a>
                <a class="nav-link" href="php/salir.php">Salir</a>
            </div>
        </div>
    </div>
</nav>
<?php
$id = $usuario->getId();
$nombre = $usuario->getNombre();
$aPat = $usuario->getAPat();
$aMat = $usuario->getAMat();
echo "<h1 class='titulo'>Médico: $id Nombre:  $nombre $aPat $aMat</h1>";
?>

<body>
    <div class="container">
        <h1 class="titulo">Citas registradas</h1>
        <div class="row">
            <div class="col-md-4">
                <div class="card text-center" style="min-width: 14rem;">
                    <img src="assets/puertadehierro.jpg" class="card-img-top" alt="puertahierro">
                    <div class="card-body">
                        <h5 class="card-title">Especialidades</h5>
                        <p class="card-text">Cardiología <br>Hematología <br>Dentista <br>Oncología </p>
                        <a href="#" class="btn btn-info">Más información</a>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>IDCita</th>
                            <th>Médico</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Paciente</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php
                        $citas = $usuario->getCitasMedico($id);
                        foreach ($citas as $resultado) {
                            echo "
                        <tr>
                            <td>" . $resultado['IDCita'] . "</td>
                            <td>" . $resultado['MNombre'] . " " . $resultado['MApellido'] . "</td>
                            <td>" . $resultado['Fecha'] . "</td>
                            <td>" . $resultado['Hora'] . "</td>
                            <td>" . $resultado['PNombre'] . " " . $resultado['PApellido'] . "</td>
                        </tr>
                        ";
                        }
                        ?>
                    </tbody>

                </table>
            </div>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
<footer>

</footer>

</html>