<?php
include 'conexion.php';

class Usuario extends DB{
    private $id;
    private $nombre;
    private $aPat;
    private $aMat;


    public function pacienteExiste($id, $pass){
        $query = $this->connect()->prepare('SELECT * FROM pacientes WHERE IDPaciente = :id AND Pass = :pass');
        $query->execute(['id' => $id, 'pass' => $pass]);

        if($query->rowCount()){
            return true;
        }else{
            return false;
        }
    }

    public function medicoExiste($id, $pass){
        $query = $this->connect()->prepare('SELECT * FROM medicos WHERE IDMedico = :id AND Pass = :pass');
        $query->execute(['id' => $id, 'pass' => $pass]);

        if($query->rowCount()){
            return true;
        }else{
            return false;
        }
    }

    public function setPaciente($id){
        $query = $this->connect()->prepare('SELECT * FROM pacientes WHERE IDPaciente = :id');
        $query->execute(['id' => $id]);
        
        foreach ($query as $currentUser) {
            $this->id = $currentUser['IDPaciente'];
            $this->nombre = $currentUser['Nombre'];
            $this->aPat = $currentUser['ApellidoPaterno'];
            $this->aMat = $currentUser['ApellidoMaterno'];
        }
    }

    public function setMedico($id){
        $query = $this->connect()->prepare('SELECT * FROM medicos WHERE IdMedico = :id');
        $query->execute(['id' => $id]);
        
        foreach ($query as $currentUser) {
            $this->id = $currentUser['IDMedico'];
            $this->nombre = $currentUser['Nombre'];
            $this->aPat = $currentUser['ApellidoPaterno'];
            $this->aMat = $currentUser['ApellidoMaterno'];
        }
    }

    public function getCitasPaciente($id){
        $query = $this->connect()->prepare('SELECT fecha, hora, nombre, ApellidoPaterno, Especialidad, Consultorio from citas inner join medicos on citas.IDMedico=medicos.IDMedico WHERE IDPaciente = :id order by fecha asc, hora asc');
        $query->execute(['id' => $id]);
        $resultado = $query->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }

    public function getCitasMedico($id){
        $query = $this->connect()->prepare('SELECT IDCita, medicos.Nombre as MNombre, medicos.ApellidoPaterno as MApellido, Fecha, Hora, pacientes.Nombre as PNombre, pacientes.ApellidoPaterno as PApellido from citas
        inner join pacientes on citas.IDPaciente=pacientes.IDPaciente 
        inner join medicos on citas.IDMedico=medicos.IDMedico 
        WHERE citas.IDMedico = :id 
        order by fecha asc, hora asc');
        $query->execute(['id' => $id]);
        $resultado = $query->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }

    public function registrarCita($fecha, $hora, $idPaciente, $idMedico, $rol){
        $sql = $this->connect()->prepare('INSERT INTO citas (Fecha, Hora, IDPaciente, IDMedico) VALUES (:fecha, :hora, :idPaciente, :idMedico)');
        
        $sql->bindParam(':fecha', $fecha, PDO::PARAM_STR);
        $sql->bindParam(':hora', $hora, PDO::PARAM_STR);
        $sql->bindParam(':idPaciente', $idPaciente, PDO::PARAM_STR,4);
        $sql->bindParam(':idMedico', $idMedico, PDO::PARAM_STR,4);

        if($sql->execute()){
            header("location:../formCita.php?rol=$rol&form=enviado");
        }else{
            header("location:../registro.php");
        }
    }

    public function getPacientes(){
        $query = $this->connect()->prepare('SELECT idPaciente, Nombre from pacientes');
        $query->execute();
        $resultado = $query->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }

    public function getMedicos(){
        $query = $this->connect()->prepare('SELECT idMedico, Nombre from medicos');
        $query->execute();
        $resultado = $query->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }

    public function getCita($id){
        $query = $this->connect()->prepare('SELECT * from citas where IDCita= :id');
        $query->execute(['id' => $id]);
        $resultado = $query->fetch(PDO::FETCH_ASSOC);
        return $resultado;
    }

    public function uptdateCita($id, $fecha, $hora, $idPaciente, $idMedico){
        $sql = $this->connect()->prepare('UPDATE citas set Fecha = :fecha, Hora = :hora, IDPaciente = :idPaciente, IDMedico = :idMedico where IDCita= :id');
        $sql->bindParam(':id', $id, PDO::PARAM_INT);
        $sql->bindParam(':fecha', $fecha, PDO::PARAM_STR);
        $sql->bindParam(':hora', $hora, PDO::PARAM_STR);
        $sql->bindParam(':idPaciente', $idPaciente, PDO::PARAM_STR,4);
        $sql->bindParam(':idMedico', $idMedico, PDO::PARAM_STR,4);
        if($sql->execute()){
            header("location:../modificarCita.php?rol=med");
        }else{
            header("location:../inicioMedicos.php?rol=med");
        }
    }

    public function deleteCita($id){
        $sql = $this->connect()->prepare('DELETE from citas where IDCita= :id');
        $sql->bindParam(':id', $id, PDO::PARAM_INT);
        if($sql->execute()){
            header("location:../eliminarCita.php?rol=med");
        }else{
            header("location:../inicioMedicos.php?rol=med");
        }
    }

    public function getId(){
        return $this->id;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function getAPat(){
        return $this->aPat;
    }

    public function getAMat(){
        return $this->aMat;
    }
}

?>