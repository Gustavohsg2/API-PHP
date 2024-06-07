<?php
require_once ("modelo/Professor.php");
header("Content-Type: application/json");
$textoRecebido = file_get_contents("php://input");
$objJson = json_decode($textoRecebido);
$objResposta = new stdClass();
$objProf = new Professor();

try{
    if ($objJson === null && json_last_error() !== JSON_ERROR_NONE)
        throw new Exception('Formato JSON inválido');
    else if (empty($objJson->nomeProfessor))
        throw new Exception("O nome não pode ser vazio!");
    else if(empty($objJson->idadeProfessor))
        throw new Exception("A idade não pode ser vazio!");
    else if(empty($objJson->Formacao))
        throw new Exception("A formação não pode ser vazio");
    else if ($objProf->isProfessor($objJson->nomeProfessor) == true)
        throw new Exception("Já existe um funcionário cadastrado com o nome: " . $objJson->nomeProfessor);
    
    $objProf->setNome($objJson->nomeProfessor);
    $objProf->setIdade($objJson->idadeProfessor);
    $objProf->setFormacao($objJson->Formacao);
    if ($objProf->create() == false)
        throw new Exception("Ocorreu um erro ao cadastrar o Professor.");

    $objResposta->status = true;
    $objResposta->msg = "Professor criado com sucesso!";
    $objResposta->dados = $objProf;

    header("Content-Type: application/json");
    header("HTTP/1.1 201 OK");
} catch (Exception $e){
    $objResposta->status = false;
    $objResposta->msg = $e->getMessage();
}
    echo json_encode($objResposta);
?>