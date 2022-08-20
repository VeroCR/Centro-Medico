<?php

    include "conexion.php";

    $conectar = new DB();

    $id=$_POST['id'];
    $nombre=$_POST['nombre'];
    $apellidoPaterno=$_POST['apellidoPaterno'];
    $apellidoMaterno=$_POST['apellidoMaterno'];
    $pass=$_POST['pass'];
    $confirmarPass=$_POST['confirmarPass'];
    $iderr;
    $idrep;
    $passerr;
    $passcar;


    if(empty($id)){
        $iderr="error";
    }else{
        $sql = "SELECT * FROM pacientes WHERE IDPaciente='$id'";
        $query = $conectar->connect()->prepare($sql);
        $query->execute();
        $resultado = $query->fetchAll(PDO::FETCH_OBJ);
        if($query->rowCount()>0){
            $idrep="error";
        }
    }  

    if(preg_match("/^(?=.*[A-Za-z])(?=.*\d)(?=.*[#$-_&%])[A-Za-z\d#$-_&%]{3,}$/", $pass)){
        if($pass != $confirmarPass){
            $passerr="error";
        }
    }else{
        $passcar="error";
    }
    
    if($iderr != "" || $idrep != "" || $passerr != "" || $passcar != ""){
        header("location:../registro.php?iderr=$iderr&idrep=$idrep&passerr=$passerr&passcar=$passcar");
    }else{
        $sql = $conectar->connect()->prepare('INSERT INTO pacientes (IDPaciente, Nombre, ApellidoPaterno, ApellidoMaterno, Pass) VALUES (:id, :nombre, :apellidoPaterno, :apellidoMaterno, :pass)');
        
        $sql->bindParam(':id', $id, PDO::PARAM_STR,4);
        $sql->bindParam(':nombre', $nombre, PDO::PARAM_STR,40);
        $sql->bindParam(':apellidoPaterno', $apellidoPaterno, PDO::PARAM_STR,30);
        $sql->bindParam(':apellidoMaterno', $apellidoMaterno, PDO::PARAM_STR,30);
        $sql->bindParam(':pass', $pass, PDO::PARAM_STR);

        if($sql->execute()){
            header("location:../registro.php?form=enviado");
        }else{
            header("location:../registro.php");
        }
    }
?>
