<?php
require_once ("modelo/Banco.php");
require_once ("modelo/Materia.php");
$objResposta = new stdClass();
$objMateria = new Materia();

$vetor = $objMateria->readAll();

$objResposta->cod = 1;
$objResposta->status = "true";
$objResposta->msg = "Executado com sucesso";
$objResposta->materias = $vetor;

header("HTTP/1.1 200 OK");
header("Content-Type: application/json");
echo json_encode($objResposta);
?>