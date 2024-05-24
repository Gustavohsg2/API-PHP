<?php
require_once "modelo/Materia.php";

$objResposta = new stdClass();

$objMateria = new Materia();

$objMateria->setIdMateria($parametro_idMateria);

$dados = $objMateria->readById();

$objResposta->cod = 1;
$objResposta->msg = "Executado com sucesso";
$objResposta->dados = $dados;
$objResposta->status = true;

header("Content-Type: application/json");
header("HTTP/1.1 200 OK");

echo json_encode($objResposta);
?>