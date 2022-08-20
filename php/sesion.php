<?php

class Sesion{

    public function __construct(){
        session_start();
    }

    public function setCurrentUser($id){
        $_SESSION['id'] = $id;
    }

    public function getCurrentUser(){
        return $_SESSION['id'];
    }

    public function closeSession(){
        session_unset();
        session_destroy();
    }
}

?>