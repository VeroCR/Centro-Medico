<?php

    include "usuario.php";
    include "sesion.php";

    $usuario = new Usuario();
    $sesion = new Sesion();

    $id=$_POST['id'];
    $pass=$_POST['pass'];
    $tipo=$_POST['tipo'];

    /*Validar datos para paciente*/
    if($tipo == "paciente"){
        $usuario = new Usuario();
        if($usuario->pacienteExiste($id, $pass)){
            $sesion->setCurrentUser($id);
            $usuario->setPaciente($id);
            header("location:../inicioPacientes.php?rol=pac");
        }else{
            header("location:../iniciarSesion.php?error=incorrecto");
        }
    }else{  /*Validar datos para médico*/
        $usuario = new Usuario();
        if($usuario->medicoExiste($id, $pass)){
            $sesion->setCurrentUser($id);
            $usuario->setMedico($id);
            header("location:../inicioMedicos.php?rol=med");
        }else{
            header("location:../iniciarSesion.php?error=incorrecto");
        }
    }

?>