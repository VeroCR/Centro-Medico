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
        } else if ($rol == "pac") {
            $usuario->setPaciente($sesion->getCurrentUser());
            $id = $usuario->getId();
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
    <title>CMPH: Registrar Cita</title>
</head>
<!--Barra navegacion-->
<?php
if ($rol == "med") {
    echo "
                <nav class='navbar navbar-expand-md sticky-top' style='background-color: #e3f2fd;'>
                <div class='container-fluid'>
                    <a class='navbar-brand' href='index.html'>
                        <img src='Assets/Logo CMPH.png' alt='logo' width='80'>
                    </a>
                    <button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#navbarNavAltMarkup' aria-controls='navbarNavAltMarkup' aria-expanded='false' aria-label='Toggle navigation'>
                        <span class='navbar-toggler-icon'></span>
                    </button>
                    <div class='collapse navbar-collapse' id='navbarNavAltMarkup'>
                        <div class='navbar-nav'>
                            <a class='nav-link' href='inicioMedicos.php?rol=med'>Inicio</a>
                            <a class='nav-link' href='formCita.php?rol=med'>Registrar cita</a>
                            <a class='nav-link' href='consultarCitaMedicos.php?rol=med'>Consultar Cita</a>
                            <a class='nav-link' href='modificarCita.php?rol=med'>Modificar Cita</a>
                            <a class='nav-link' href='eliminarCita.php?rol=med'>Eliminar Cita</a>
                            <a class='nav-link' href='php/salir.php'>Salir</a>
                        </div>
                    </div>
                </div>
            </nav>
                ";
} else if ($rol == "pac") {
    echo "
    <nav class='navbar navbar-expand-md sticky-top' style='background-color: #e3f2fd;'>
    <div class='container-fluid'>
        <a class='navbar-brand' href='index.html'>
            <img src='Assets/Logo CMPH.png' alt='logo' width='80'>
        </a>
        <button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#navbarNavAltMarkup' aria-controls='navbarNavAltMarkup' aria-expanded='false' aria-label='Toggle navigation'>
            <span class='navbar-toggler-icon'></span>
        </button>
        <div class='collapse navbar-collapse' id='navbarNavAltMarkup'>
            <div class='navbar-nav'>
                <a class='nav-link' href='inicioPacientes.php?rol=pac'>Inicio</a>
                <a class='nav-link' href='formCita.php?rol=pac'>Registrar Cita</a>
                <a class='nav-link' href='consultarCitaPacientes.php?rol=pac'>Consultar Cita</a>
                <a class='nav-link' href='php/salir.php'>Salir</a>
            </div>
        </div>
    </div>
</nav>
                ";
}

?>
<h1 class="titulo">Registrar Cita</h1>

<body>
    <!--Formulario-->
    <section>
        <form action="php/registrarCita.php" class="formulario" method="post">
            <div class="container">

                <?php
                if (isset($_GET['form'])) {
                    $form = $_GET['form'];
                    if ($form == "enviado") {
                        echo "<p class='form__enviado'>Registro realizado</p>";
                    }
                }
                ?><br>

                <!-- Fecha -->
                <div class="input-group mb-4">
                    <span class="input-group-text">Fecha</span>
                    <input type="date" class="form-control" name="fecha" id="fecha" min="2022-08-14" required>
                </div>

                <!-- Hora -->
                <div class="input-group mb-4">
                    <span class="input-group-text">Hora</span>
                    <input type="time" class="form-control" name="hora" id="hora" min="09:00" max="20:00" required>
                </div>

                <!-- Validar si es médico -->
                <?php if ($rol == "med") { ?>

                    <!-- Select IDPaciente -->
                    <div class="input-group mb-4">
                        <label class="input-group-text">ID Paciente</label>
                        <select class="form-select" name="idPaciente" id="idPaciente">
                            <?php $pacientes = $usuario->getPacientes();
                            foreach ($pacientes as $data) {
                                echo '<option value="' . $data["idPaciente"] . '">' . $data["idPaciente"] . ' ' . $data["Nombre"] . '</option>';
                            }
                            ?>
                        </select>
                    </div>

                    <!-- IDMédico -->
                    <div class="input-group mb-4">
                        <span class="input-group-text">ID Médico</span>
                        <?php echo '<input type="text" class="form-control" name="idMedico" id="idMedico" value="' . $id . '" readonly>' ?>
                    </div>

                    <!-- Validar si es paciente -->
                <?php } else if ($rol == "pac") { ?>

                    <!-- IDPaciente -->
                    <div class="input-group mb-4">
                        <span class="input-group-text">ID Paciente</span>
                        <?php echo '<input type="text" class="form-control" name="idPaciente" id="idPacinente" value="' . $id . '" readonly>' ?>
                    </div>

                    <!-- Contenedor IdMedico -->
                    <div class="input-group mb-4">
                        <label class="input-group-text">ID Médico</label>
                        <select class="form-select" name="idMedico" id="idMedico">
                            <?php $medicos = $usuario->getMedicos();
                            foreach ($medicos as $data) {
                                echo '<option value="' . $data["idMedico"] . '">' . $data["idMedico"] . ' ' . $data["Nombre"] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <br>
                <?php } ?>

                <div class="contenedor__rol">
                    <?php echo '<input type="text" name="rol" id="rol" value="' . $rol . '" readonly>' ?>
                </div>

                <!-- Botón -->
                <div class="d-grid gap-2 d-flex justify-content-center">
                    <button class="btn btn-info" type="submit">Registrar</button>
                </div>

            </div>
        </form>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
<footer>

</footer>

</html>