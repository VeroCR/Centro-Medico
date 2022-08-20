<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/styles.css"/>
    <title>CMPH: Registro Pacientes</title>
</head>
<!--Barra navegacion-->
<header class="header">
    <nav class="nav">
        <ul class="ul">
            <li class="li"><a href="index.html">Inicio</a></li>
            <li class="li"><a href="registro.php">Registrarse</a></li>
            <li class="li"><a href="iniciarSesion.php">Iniciar sesión</a></li>
        </ul>
    </nav>
</header>
<h1 class="titulo">Registro Pacientes</h1><br><br>
<body>
<!--Formulario-->
<section>
    <form action="php/registrar.php" class="formulario" id="formulario" method="post">
        <div class="contenedor">
            <!-- Contenedor ID -->
            <?php
                if(isset($_GET['iderr'])){
                    $iderr = $_GET['iderr'];
                    if($iderr == "error"){
                        echo "<p class='form__error'>* Ingrese un ID válido.</p>";
                    }
                }
                if(isset($_GET["idrep"])){
                    $idrep = $_GET["idrep"];
                    if($idrep == "error"){
                        echo "<p class='form__error'>* El ID ingresado ya había sido registrado.</p>";
                    }
                }
                if(isset($_GET['passerr'])){
                    $passerr = $_GET['passerr'];
                    if($passerr == "error"){
                        echo "<p class='form__error'>* Las contraseñas no coinciden.</p>";
                    }
                }
                if(isset($_GET['passcar'])){
                    $passcar = $_GET['passcar'];
                    if($passcar == "error"){
                        echo "<p class='form__error'>* La contraseña debe tener letras, números y un carácter especial (#,$,-,_,&,%).</p>";
                    }
                }
                if(isset($_GET['form'])){
                    $form = $_GET['form'];
                    if($form == "enviado"){
                        echo "<p class='form__enviado'>Registro realizado</p>";
                    }
                }
            ?><br>
            <div class="contenedor__id">
				<input type="text" name="id" id="id" minlength="4" maxlength="4" placeholder="ID: '0000'" required>
            </div>
            <!-- Contenedor Nombre -->
            <div class="contenedor__nombre">
				<input type="text" name="nombre" id="nombre" minlength="2" maxlength="40" placeholder="Ingrese su nombre" required>
            </div>
            <!-- Contenedor ApellidoPaterno -->
            <div class="contenedor__apellido-paterno">
				<input type="text" name="apellidoPaterno" id="apellidoPaterno" minlength="4" maxlength="30" placeholder="Ingrese su apellido paterno" required>
            </div>
            <!-- Contenedor ApellidoMaterno -->
            <div class="contenedor__apellido-materno">
				<input type="text" name="apellidoMaterno" id="apellidoMaterno" minlength="4" maxlength="30" placeholder="Ingrese su apellido materno" required>
            </div>
            <!-- Contenedor Password -->
            <div class="contenedor__password">
				<input type="password" name="pass" id="pass" minlength="8" placeholder="Contraseña" required>
            </div>
            <!-- Contenedor Confirmación de Password -->
            <div class="contenedor__confirmar-password">
				<input type="password" name="confirmarPass" id="confirmarPass" minlength="8" placeholder="Confirmar contraseña" required>
            </div><br><br>
            <button class="contenedor__boton" type="submit">Registrarse</button>
        </div>
    </form>
</section>
</body>
<footer>

</footer>
</html>