<?php
require_once "modelo/Materia.php";
header("Content-Type: application/json");
$textoJsonRecebidoCorpoPOST = file_get_contents('php://input');
$objJson = json_decode($textoJsonRecebidoCorpoPOST);
$objResposta = new stdClass();
$objMateria = new Materia();
try{
    if (empty($objJson->nome_materia))
        throw new Exception("O nome da matéria não pode ser vazio");
    else if (empty($objJson->id_professor))
        throw new Exception("O ID do professor não pode ser vazio");
    else if(empty($objJson->id_turma))
        throw new Exception("O ID da turma não pode ser vazio");
    else if ($objMateria->isMateria($objJson))
        throw new Exception("Já existe uma matéria cadastrada com o nome: " . $objJson->nome_materia);
    $objMateria->setNomeMateria($objJson->nome_materia);
    $objMateria->setIdProfessor($objJson->id_professor);
    $objMateria->setIdTurma($objJson->id_turma);
    if ($objMateria->create() == false)
        throw new Exception("Ocorreu um erro ao cadastrar a matéria");
    
    $objResposta->status = true;
    $objResposta->msg = "Cadastrado com sucesso";
    $objResposta->dados = $objMateria;
    header("Content-Type: application/json");
    header("HTTP/1.1 201 OK");

} catch (Exception $e){
    $objResposta->status = false;
    $objResposta->msg = $e->getMessage();
}
    echo json_encode($objResposta);
?>