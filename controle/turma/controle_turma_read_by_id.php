<?php
require_once "modelo/Turma.php";

$objResposta = new stdClass();

$objTurma = new Turma();

$objTurma->setIdTurma($parametro_idTurma);

$dados = $objTurma->readById();

$objResposta->cod = 1;
$objResposta->msg = "executado com sucesso";
$objResposta->dados = $dados;
$objResposta->status = true;

header("Content-Type: application/json");
header("HTTP/1.1 200 OK");

echo json_encode($objResposta);