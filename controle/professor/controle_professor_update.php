<?php
require_once "modelo/Professor.php";

$textoJsonRecebidoCorpoPUT = file_get_contents('php://input');
$objJsonRecebido = json_decode($textoJsonRecebidoCorpoPUT);

$objResposta = new stdClass();
$objProfessor = new Professor();

$objProfessor->setIdProfessor($parametro_idProfessor);

$objProfessor->setNome($objJsonRecebido->nome);
$objProfessor->setIdade($objJsonRecebido->idade);
$objProfessor->setFormacao($objJsonRecebido->formacao);

if (empty($objJsonRecebido->nome)) {
    $objResposta->cod = 1;
    $objResposta->status = false;
    $objResposta->msg = "O nome não pode ser vazio";
} else {
    if ($objProfessor->update()) {
        $objResposta->cod = 4;
        $objResposta->status = true;
        $objResposta->msg = "Atualizado com sucesso";
        $objResposta->dados = $objProfessor;
    } else {
        $objResposta->cod = 5;
        $objResposta->status = false;
        $objResposta->msg = "Erro ao atualizar o professor";
    }
}

header("Content-Type: application/json");
header("HTTP/1.1 200 OK");

echo json_encode($objResposta);
?>