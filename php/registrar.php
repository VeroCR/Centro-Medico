<?php
include "conexion.php";

$conectar = new DB();

$id = $_POST['id'];
$nombre = $_POST['nombre'];
$apellidoPaterno = $_POST['apellidoPaterno'];
$apellidoMaterno = $_POST['apellidoMaterno'];
$pass = $_POST['pass'];
$confirmarPass = $_POST['confirmarPass'];
$iderr;
$idrep;
$passerr;
$passcar;

// RECAPTCHA_V3
define("RECAPTCHA_V3_SECRET_KEY", '6LfA-s4hAAAAACzrQaXaUwFuNTklvEdKA33_C1c9');
$token = $_POST['token'];
$action = $_POST['action'];

// call curl to POST request
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('secret' => RECAPTCHA_V3_SECRET_KEY, 'response' => $token)));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);
$arrResponse = json_decode($response, true);

// verificar la respuesta
if ($arrResponse["success"] == '1' && $arrResponse["action"] == $action && $arrResponse["score"] >= 0.5) {
    // procesar el formulario
    if (empty($id)) {
        $iderr = "error";
    } else {
        $sql = "SELECT * FROM pacientes WHERE IDPaciente='$id'";
        $query = $conectar->connect()->prepare($sql);
        $query->execute();
        $resultado = $query->fetchAll(PDO::FETCH_OBJ);
        if ($query->rowCount() > 0) {
            $idrep = "error";
        }
    }

    if (preg_match("/^(?=.*[A-Za-z])(?=.*\d)(?=.*[#$-_&%])[A-Za-z\d#$-_&%]{3,}$/", $pass)) {
        if ($pass != $confirmarPass) {
            $passerr = "error";
        }
    } else {
        $passcar = "error";
    }

    if ($iderr != "" || $idrep != "" || $passerr != "" || $passcar != "") {
        header("location:../registro.php?iderr=$iderr&idrep=$idrep&passerr=$passerr&passcar=$passcar");
    } else {
        $sql = $conectar->connect()->prepare('INSERT INTO pacientes (IDPaciente, Nombre, ApellidoPaterno, ApellidoMaterno, Pass) VALUES (:id, :nombre, :apellidoPaterno, :apellidoMaterno, :pass)');

        $sql->bindParam(':id', $id, PDO::PARAM_STR, 4);
        $sql->bindParam(':nombre', $nombre, PDO::PARAM_STR, 40);
        $sql->bindParam(':apellidoPaterno', $apellidoPaterno, PDO::PARAM_STR, 30);
        $sql->bindParam(':apellidoMaterno', $apellidoMaterno, PDO::PARAM_STR, 30);
        $sql->bindParam(':pass', $pass, PDO::PARAM_STR);

        if ($sql->execute()) {
            header("location:../registro.php?form=enviado");
        } else {
            header("location:../registro.php");
        }
    }
} else {
    // Si entra aqui, es un robot....
    echo "Lo siento, parece que eres un Robot";
}
