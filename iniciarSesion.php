<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/styles.css"/>
    <title>CMPH: Iniciar Sesión</title>
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
</header><br><br>
<h1 class="titulo">Iniciar Sesión</h1><br><br>
<body>
<!--Formulario-->
<section>
    <form action="php/validacion.php" class="formulario" id="formulario" method="post">
        <div class="contenedor">
            <?php
                if(isset($_GET['error'])){
                    $error = $_GET['error'];
                    if($error == "incorrecto"){
                        echo "<p class='form__error'>Usuario o contraseña incorrectos</p><br>";
                    }
                }
            ?><br>
            <!-- Contenedor ID -->
            <div class="contenedor__id">
				<input type="text" name="id" id="id" minlength="4" maxlength="4" placeholder="Ingrese su ID" required>
            </div><br>
            <!-- Contenedor Password -->
            <div class="contenedor__password">
				<input type="password" name="pass" id="pass" minlength="8" placeholder="Contraseña" required>
            </div><br>
            <!-- Select Paciente/Médixo -->
            <div class="contenedor__select">
				<select name="tipo" id="tipo">
                    <option value="paciente">Paciente</option>
                    <option value="medico">Médico</option>
                </select>
            </div><br><br>
            <!-- Botón -->
            <button class="contenedor__boton" type="submit">Iniciar sesión</button>
        </div>
    </form>
</section>
</body>
<footer>

</footer>
</html>