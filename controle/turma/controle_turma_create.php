<?php
require_once "modelo/Turma.php";

$textoJsonRecebidoCorpoPOST = file_get_contents('php://input');
$objJsonRecebido = json_decode($textoJsonRecebidoCorpoPOST);
$objResposta = new stdClass();

$objTurma = new Turma();

if ($objJsonRecebido->serieTurma == "") {
    $objResposta->cod = 1;
    $objResposta->status = false;
    $objResposta->msg = "O serieTurma não pode ser vazio";
} else if($objJsonRecebido->representanteTurma == ""){
    $objResposta->cod = 1;
    $objResposta->status = false;
    $objResposta->msg = "O nome do representante não pode ser vazio";
} if ($objTurma->isTurma($objJsonRecebido->serieTurma) == true) {
    $objResposta->cod = 3;
    $objResposta->status = false;
    $objResposta->msg = "já existe uma turma cadastrado com o nome: " . $objJsonRecebido->serieTurma;
} else {
    $objTurma->setSerieTurma($objJsonRecebido->serieTurma);
    $objTurma->setRepresentanteTurma($objJsonRecebido->representanteTurma);
    if ($objTurma->create() == true) {
        $objResposta->cod = 4;
        $objResposta->status = true;
        $objResposta->msg = "Cadastrado com sucesso";
        $objResposta->dados = $objTurma;
    } else {
        $objResposta->cod = 5;
        $objResposta->status = false;
        $objResposta->msg = "Ocorreu um erro ao cadastrar a Turma";
        $objResposta->dados = $objTurma;
    }
}

header("Content-Type: application/json");
header("HTTP/1.1 201 OK");
echo json_encode($objResposta);