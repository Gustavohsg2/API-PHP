<?php
require_once "modelo/Professor.php";

$objResposta = new stdClass();

$objProfessor = new Professor();

$objProfessor->setIdProfessor($parametro_idProfessor);

$dados = $objProfessor->readById();

$objResposta->cod = 1;
$objResposta->msg = "executado com sucesso";
$objResposta->dados = $dados;
$objResposta->status = true;

header("Content-Type: application/json");
header("HTTP/1.1 200 OK");

echo json_encode($objResposta);
?>