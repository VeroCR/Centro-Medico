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
            $id = $usuario->getId();
            $idCita = $_GET['idCita'];
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
    <title>CMPH: Modificar Cita</title>
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

<body>
    <br><br>
    <h1 class="titulo">Modificar Cita</h1><br>
    <div class="container">
        <form action="php/updateCita.php" class="formulario" method="post">
            <?php
            $cita = $usuario->getCita($idCita);
            ?>

            <!-- ID Cita-->
            <div class="input-group mb-4">
                <span class="input-group-text">ID Cita</span>
                <input type="text" class="form-control" name="idCita" id="idCita" value="<?php echo $idCita ?>" readonly>
            </div>

            <!-- Fecha-->
            <div class="input-group mb-4">
                <span class="input-group-text">Fecha</span>
                <input type="date" class="form-control" name="fecha" id="fecha" value="<?php echo $cita['Fecha'] ?>" required>
            </div>

            <!-- Hora -->
            <div class="input-group mb-4">
                <span class="input-group-text">Hora</span>
                <input type="time" class="form-control" name="hora" id="hora" value="<?php echo $cita['Hora'] ?>" required>
            </div>

            <!-- IDPaciente -->
            <div class="input-group mb-4">
                <label class="input-group-text">ID Paciente</label>
                <select class="form-select" name="idPaciente" id="idPaciente">
                    <option selected value="<?php echo $cita['IDPaciente'] ?>"><?php echo $cita['IDPaciente'] ?></option>
                    <?php $paciente = $usuario->getPacientes();
                    foreach ($paciente as $data) {
                        echo '<option value="' . $data["idPaciente"] . '">' . $data["idPaciente"] . ' ' . $data["Nombre"] . '</option>';
                    }
                    ?>
                </select>
            </div>

            <!-- IDMédico -->
            <div class="input-group mb-4">
                <label class="input-group-text">ID Médico</label>
                <select class="form-select" name="idMedico" id="idMedico">
                    <option selected value="<?php echo $cita['IDMedico'] ?>"><?php echo $cita['IDMedico'] ?></option>
                    <?php $paciente = $usuario->getMedicos();
                    foreach ($paciente as $data) {
                        echo '<option value="' . $data["idMedico"] . '">' . $data["idMedico"] . ' ' . $data["Nombre"] . '</option>';
                    }
                    ?>
                </select>
            </div>

            <!-- Botón -->
            <div class="d-grid gap-2 d-flex justify-content-center">
                <button class="btn btn-info" type="submit">Guardar</button>
            </div>
            
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
<footer>

</footer>

</html>