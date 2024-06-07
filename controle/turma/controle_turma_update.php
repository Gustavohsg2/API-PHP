<?php
require_once "modelo/Turma.php";

header("Content-Type: application/json");
$textoJsonRecebidoCorpoPUT = file_get_contents('php://input');
$objJson = json_decode($textoJsonRecebidoCorpoPUT);
$objResposta = new stdClass();
$objTurma = new Turma();
try{
    if ($objJson === null && json_last_error() !== JSON_ERROR_NONE)
        throw new Exception('Formato JSON inválido');
    $objTurma->setIdTurma($parametro_idTurma);
    $objTurma->setSerieTurma($objJson->serieTurma);
    $objTurma->setRepresentanteTurma($objJson->representante);
    if ($objTurma->getSerieTurma() == "")
        throw new Exception("A serieTurma não pode ser vazio!");
    else if($objTurma->update() == false)
        throw new Exception("Houve um erro na tentativa de atualização!");
    $objResposta->status = true;
    $objResposta->msg = "Atualizado com sucesso";
    header("Content-Type: application/json");
    header("HTTP/1.1 201 OK");
} catch(Exception $e){
    $objResposta->status = false;
    $objResposta->msg = $e->getMessage();
}
echo json_encode($objResposta);