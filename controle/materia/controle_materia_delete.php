<?php
require_once("modelo/Materia.php");

$objResposta = new stdClass();
$objMateria = new Materia();

$objMateria->setIdMateria($parametro_idMateria);

if ($objMateria->delete() == true) {
    header("HTTP/1.1 204 No Content");
} else {
    header("HTTP/1.1 200 OK");
    header("Content-Type: application/json");

    $objResposta->cod = 1;
    $objResposta->status = false;
    $objResposta->msg = "Erro ao deletar a matéria";
    
    echo json_encode($objResposta);
}
?>