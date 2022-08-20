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
            }
            else if($rol == "pac"){
                $usuario->setPaciente($sesion->getCurrentUser());
                $id=$usuario->getId();
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
    <title>CMPH: Registrar Cita</title>
</head>
<!--Barra navegacion-->
<header class="header">
    <nav class="nav">
        <ul class="ul">
            <?php
            if($rol == "med"){
                echo"
                    <li class='li'><a href='inicioMedicos.php?rol=med'>Inicio</a></li>
                    <li class='li'><a href='formCita.php?rol=med'>Registrar Cita</a></li>
                    <li class='li'><a href='consultarCitaMedicos.php?rol=med'>Consultar Cita</a></li>
                    <li class='li'><a href='modificarCita.php?rol=med'>Modificar Cita</a></li>
                    <li class='li'><a href='eliminarCita.php?rol=med'>Eliminar Cita</a></li>
                    <li class='li'><a href='php/salir.php'>Salir</a></li>
                ";
            }
            else if($rol == "pac"){
                echo"
                    <li class='li'><a href='inicioPacientes.php?rol=pac'>Inicio</a></li>
                    <li class='li'><a href='registrarCita.php?rol=pac'>Registrar Cita</a></li>
                    <li class='li'><a href='consultarCitaPacientes.php?rol=pac'>Consultar Cita</a></li>
                    <li class='li'><a href='php/salir.php'>Salir</a></li>
                ";
            }
            
            ?>
        </ul>
    </nav>
</header>
<h1 class="titulo">Registrar Cita</h1><br><br>
<body>
<!--Formulario-->
<section>
    <form action="php/registrarCita.php" class="formulario" method="post">
        <div class="contenedor">
            <!-- Contenedor ID -->
            <?php
                if(isset($_GET['form'])){
                    $form = $_GET['form'];
                    if($form == "enviado"){
                        echo "<p class='form__enviado'>Registro realizado</p>";
                    }
                }
            ?><br>
            <!-- Contenedor Fecha -->
            <div class="contenedor__fecha">
				<input type="date" name="fecha" id="fecha" min="2022-08-14" required>
            </div>
            <!-- Contenedor Hora -->
            <div class="contenedor__hora">
				<input type="time" name="hora" id="hora" min="09:00" max="20:00" required>
            </div>

            <!-- Validar si es médico -->
            <?php if($rol == "med"){?>
                <!-- Contenedor IDPaciente -->
            <div class="contenedor__idpaciente">
                <select class="contenedor__idpaciente-select" name="idPaciente" id="idPaciente">
                <?php $pacientes=$usuario->getPacientes();
                    foreach($pacientes as $data){
                        echo '<option value="'.$data["idPaciente"].'">'.$data["idPaciente"].' '.$data["Nombre"].'</option>';
                    }
                ?>  
                </select> 
            </div>

            <!-- Contenedor IdMedico -->
            <div class="contenedor__idmedico">
                <?php echo '<input type="text" name="idMedico" id="idMedico" value="'.$id.'" readonly>'?>
            </div>
            <br>
            
            <!-- Validar si es paciente -->
            <?php }else if($rol == "pac"){?>
                <!-- Contenedor IDPaciente -->
            <div class="contenedor__idpaciente">
                <?php echo '<input type="text" name="idPaciente" id="idPaciente" value="'.$id.'" readonly>'?>
            </div>

            <!-- Contenedor IdMedico -->
            <div class="contenedor__idmedico">
            <select class="contenedor__idpaciente-select" name="idMedico" id="idMedico">
                <?php $medicos=$usuario->getMedicos();
                    foreach($medicos as $data){
                        echo '<option value="'.$data["idMedico"].'">'.$data["idMedico"].' '.$data["Nombre"].'</option>';
                    }
                ?>  
                </select>
            </div>
            <br>
            <?php }?>

            <div class="contenedor__rol">
				<?php echo '<input type="text" name="rol" id="rol" value="'.$rol.'" readonly>'?>
            </div>
                    
            <button class="contenedor__boton" type="submit">Registrar</button>
        </div>
    </form>
</section>
</body>
<footer>

</footer>
</html>