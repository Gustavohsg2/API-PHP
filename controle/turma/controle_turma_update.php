<?php
require_once "modelo/Turma.php";

$textoJsonRecebidoCorpoPUT = file_get_contents('php://input');
$objJsonRecebido = json_decode($textoJsonRecebidoCorpoPUT);

$objResposta = new stdClass();

$objTurma = new Turma();

$objTurma->setIdTurma($parametro_idTurma);
$objTurma->setSerieTurma($objJsonRecebido->serieTurma);
$objTurma->setRepresentanteTurma($objJsonRecebido->representante);

if ($objJsonRecebido->serieTurma == "") {
    $objResposta->cod = 1;
    $objResposta->status = false;
    $objResposta->msg = "A serieTurma não pode ser vazio";
} else {
    $objResposta->cod = 4;
    $objResposta->status = true;
    $objResposta->msg = "Atualizado com sucesso";
    $objResposta->dados = $objTurma->update();
}

header("Content-Type: application/json");
header("HTTP/1.1 201 OK");
echo json_encode($objResposta);