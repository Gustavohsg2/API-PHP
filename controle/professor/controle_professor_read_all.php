<?php
require_once ("modelo/Banco.php");
require_once ("modelo/Professor.php");
$objResposta = new stdClass();
$objProfessor = new Professor();

$vetor = $objProfessor->readAll();

$objResposta->cod = 1;
$objResposta->status = "true";
$objResposta->msg = "Executado com sucesso";
$objResposta->turmas = $vetor;

header("HTTP/1.1 200");
header("Content-Type: application/json");
echo json_encode($objResposta);
?>