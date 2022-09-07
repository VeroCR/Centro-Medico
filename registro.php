<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/styles.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script
	  src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
	  integrity="sha256-pasqAKBDmFT4eHoN2ndd6lN370kFiGUFyTiUHWhU7k8="
	  crossorigin="anonymous"></script>
 
    <script src="https://www.google.com/recaptcha/api.js?render=6LfA-s4hAAAAAPg0YDrL-6OOd-WqHJp72vydiq_7"></script>
    <title>CMPH: Registro Pacientes</title>
</head>
<!--Barra navegacion-->
<header class="header">
    <nav class="nav">
        <ul class="ul">
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

<h1 class="titulo">Registro Pacientes</h1><br>

<body>
    <!--Formulario-->
    <section>
        <form action="php/registrar.php" class="formulario" id="form" method="post">
            <div class="container">
                <!-- Contenedor ID -->
                <?php
                if (isset($_GET['iderr'])) {
                    $iderr = $_GET['iderr'];
                    if ($iderr == "error") {
                        echo "<p class='form__error'>* Ingrese un ID válido.</p>";
                    }
                }
                if (isset($_GET["idrep"])) {
                    $idrep = $_GET["idrep"];
                    if ($idrep == "error") {
                        echo "<p class='form__error'>* El ID ingresado ya había sido registrado.</p>";
                    }
                }
                if (isset($_GET['passerr'])) {
                    $passerr = $_GET['passerr'];
                    if ($passerr == "error") {
                        echo "<p class='form__error'>* Las contraseñas no coinciden.</p>";
                    }
                }
                if (isset($_GET['passcar'])) {
                    $passcar = $_GET['passcar'];
                    if ($passcar == "error") {
                        echo "<p class='form__error'>* La contraseña debe tener letras, números y un carácter especial (#,$,-,_,&,%).</p>";
                    }
                }
                if (isset($_GET['form'])) {
                    $form = $_GET['form'];
                    if ($form == "enviado") {
                        echo "<p class='form__enviado'>Registro realizado</p>";
                    }
                }
                ?><br>

                <!-- ID -->
                <div class="input-group mb-4">
                    <span class="input-group-text">ID</span>
                    <input type="text" class="form-control" name="id" id="id" minlength="4" maxlength="4" placeholder="ID: '0000'" required>
                </div>

                <!-- Nombre -->
                <div class="input-group mb-4">
                    <span class="input-group-text">Nombre</span>
                    <input type="text" class="form-control" name="nombre" id="nombre" minlength="2" maxlength="40" placeholder="Ingrese su nombre" required>
                </div>

                <!-- Apellido Paterno -->
                <div class="input-group mb-4">
                    <span class="input-group-text">Apellido Paterno</span>
                    <input type="text" class="form-control" name="apellidoPaterno" id="apellidoPaterno" minlength="4" maxlength="30" placeholder="Ingrese su apellido paterno" required>
                </div>

                <!-- Apellido Materno -->
                <div class="input-group mb-4">
                    <span class="input-group-text">Apellido Materno</span>
                    <input type="text" class="form-control" name="apellidoMaterno" id="apellidoMaterno" minlength="4" maxlength="30" placeholder="Ingrese su apellido materno" required>
                </div>

                <!-- Contraseña -->
                <div class="input-group mb-4">
                    <span class="input-group-text">Contraseña</span>
                    <input type="password" class="form-control" name="pass" id="pass" minlength="8" placeholder="Contraseña" required>
                </div>

                <!-- Confirmar Contraseña -->
                <div class="input-group mb-4">
                    <span class="input-group-text"> Confirmar Contraseña</span>
                    <input type="password" class="form-control" name="confirmarPass" id="confirmarPass" minlength="8" placeholder="Ingrese su contraseña" required>
                </div>

                <!-- Botón -->
                <div class="d-grid gap-2 d-flex justify-content-center">
                    <button class="btn btn-info" type="submit">Registrarse</button>
                </div>
                
            </div>
        </form>
    </section>

    <script>
    $('#form').submit(function(event) {
        event.preventDefault();
        grecaptcha.ready(function() {
            grecaptcha.execute('6LfA-s4hAAAAAPg0YDrL-6OOd-WqHJp72vydiq_7', {action: 'registro'}).then(function(token) {
                $('#form').prepend('<input type="hidden" name="token" value="' + token + '">');
                $('#form').prepend('<input type="hidden" name="action" value="registro">');
                $('#form').unbind('submit').submit();
            });
        });
  });
  </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
<footer>

</footer>

</html>