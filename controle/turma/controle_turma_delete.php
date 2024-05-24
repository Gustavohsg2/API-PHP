<?php
require_once("modelo/Turma.php");
    $objResposta = new stdClass();
    $objTurma = new Turma();
    $objTurma->setIdTurma($parametro_idTurma);
    if($objTurma->delete()==true){
        header("HTTP/1.1 204");
    }else{
        header("HTTP/1.1 200");
        header("Content-Type: application/json");
    }
?>