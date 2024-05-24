<?php
require_once("modelo/Professor.php");
    $objResposta = new stdClass();
    $objProfessor = new Professor();
    $objProfessor->setIdProfessor($parametro_idProfessor);
    if($objProfessor->delete()==true){
        header("HTTP/1.1 204");
    }else{
        header("HTTP/1.1 200");
        header("Content-Type: application/json");
    }
?>