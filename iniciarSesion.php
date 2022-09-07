<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/styles.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <title>CMPH: Iniciar Sesión</title>
</head>
<!--Barra navegacion-->
<header class="header">
    <nav class="nav">
        <ul class="ul">
            <li class="li"><a class="nav-registro" href="index.html">Inicio</a></li>
            <li class="li"><a class="nav-registro" href="registro.php">Registrarse</a></li>
            <li class="li"><a class="nav-registro" href="iniciarSesion.php">Iniciar sesión</a></li>
        </ul>
    </nav>
</header>
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
                <a class="nav-link" href="index.html">Inicio</a>
                <a class="nav-link" href="#">Acerca</a>
                <a class="nav-link" href="index.html#servicios">Servicios</a>
                <a class="nav-link" href="#">Citas</a>
                <a class="nav-link" href="index.html#medicos">Médicos</a>
                <a class="nav-link" href="#">Departamentos</a>
                <a class="nav-link" href="#">Blog</a>
                <a class="nav-link" href="#">Conctacto</a>
            </div>
        </div>
    </div>
</nav>
<br>
<h1 class="titulo">Iniciar Sesión</h1><br>

<body>
    <!--Formulario-->
    <section>
        <form action="php/validacion.php" class="formulario" id="formulario" method="post">
            <div class="container">
                <?php
                if (isset($_GET['error'])) {
                    $error = $_GET['error'];
                    if ($error == "incorrecto") {
                        echo "<p class='form__error'>Usuario o contraseña incorrectos</p><br>";
                    }
                }
                ?>
                <!-- ID -->
                <div class="input-group mb-4">
                    <span class="input-group-text">ID</span>
                    <input type="text" class="form-control" name="id" id="id" minlength="4" maxlength="4" placeholder="Ingrese su ID" required>
                </div>

                <!-- Password -->
                <div class="input-group mb-4">
                    <span class="input-group-text">Contraseña</span>
                    <input type="password" class="form-control" name="pass" id="pass" minlength="8" placeholder="Contraseña" required>
                </div>

                <!-- Select Paciente/Médico -->
                <div class="input-group mb-4">
                    <label class="input-group-text" for="inputGroupSelect01">Tipo</label>
                    <select class="form-select" name="tipo" id="tipo">
                        <option value="paciente">Paciente</option>
                        <option value="medico">Médico</option>
                    </select>
                </div>

                <!-- Botón -->
                <div class="d-grid gap-2 d-flex justify-content-center">
                    <button class="btn btn-info" type="submit">Iniciar sesión</button>
                </div>


            </div>
        </form>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
<footer>

</footer>

</html>