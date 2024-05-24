<?php
require_once ("modelo/Banco.php");
require_once ("modelo/Turma.php");
$objResposta = new stdClass();
$objTurma = new Turma();

$vetor = $objTurma->readAll();

$objResposta->cod = 1;
$objResposta->status = "true";
$objResposta->msg = "Executado com sucesso";
$objResposta->turmas = $vetor;

header("HTTP/1.1 200");
header("Content-Type: application/json");
echo json_encode($objResposta);
?>