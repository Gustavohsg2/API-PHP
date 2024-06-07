<?php
require_once "modelo/Turma.php";

header("Content-Type: application/json");
$textoJsonRecebidoCorpoPOST = file_get_contents('php://input');
$objJson = json_decode($textoJsonRecebidoCorpoPOST);
$objResposta = new stdClass();
$objTurma = new Turma();

try{
    if ($objJson === null && json_last_error() !== JSON_ERROR_NONE)
        throw new Exception('Formato JSON inválido');
    $objTurma->setSerieTurma($objJson->serieTurma); 
    $objTurma->setRepresentanteTurma($objJson->representanteTurma);
    if ($objTurma->getSerieTurma() == "")
        throw new Exception("O serieTurma não pode ser vazio");
    else if($objJson->representanteTurma == "")
        throw new Exception("O nome do representante não pode ser vazio!");
    else if ($objTurma->isTurma($objJson->serieTurma) == true)
        throw new Exception("Já existe uma turma cadastrado com o nome: " . $objJson->serieTurma);
    if($objTurma->create() == false)
        throw new Exception("Ocorreu um erro ao tentar criar a turma.");
    $objResposta->status = true;
    $objResposta->msg = "Cadastrado com sucesso";
    $objResposta->dados = $objTurma;
    header("Content-Type: application/json");
    header("HTTP/1.1 201 OK");
} catch(Exception $e){
    $objResposta->status = false;
    $objResposta->msg = $e->getMessage();
}
echo json_encode($objResposta);