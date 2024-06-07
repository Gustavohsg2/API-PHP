<?php
require_once "modelo/Professor.php";
header("Content-Type: application/json");
$textoJsonRecebidoCorpoPUT = file_get_contents('php://input');
$objJsonRecebido = json_decode($textoJsonRecebidoCorpoPUT);
$objResposta = new stdClass();
$objProfessor = new Professor();

try{
    $objProfessor->setIdProfessor($parametro_idProfessor);

    $objProfessor->setNome($objJsonRecebido->nome);
    $objProfessor->setIdade($objJsonRecebido->idade);
    $objProfessor->setFormacao($objJsonRecebido->formacao);

    if($parametro_idProfessor == null)
        throw new Exception("O id não pode ser vazio!");
    else if($objProfessor->update() == false)
        throw new Exception("Erro ao atualizar o professor");

    $objResposta->status = true;
    $objResposta->msg = "Atualizado com sucesso";
    $objResposta->dados = $objProfessor;

    header("Content-Type: application/json");
    header("HTTP/1.1 200 OK");
} catch (Exception $e){
    $objResposta->status = false;
    $objResposta->msg = $e->getMessage();
}
    echo json_encode($objResposta);
?>