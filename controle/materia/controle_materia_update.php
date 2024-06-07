<?php
require_once "modelo/Materia.php";
header("Content-Type: application/json");
$textoJsonRecebidoCorpoPUT = file_get_contents('php://input');
$objJsonRecebido = json_decode($textoJsonRecebidoCorpoPUT);
$objResposta = new stdClass();
$objMateria = new Materia();

try{
    $objMateria->setIdMateria($parametro_idMateria);
    $objMateria->setNomeMateria($objJsonRecebido->nome_materia);
    $objMateria->setIdProfessor($objJsonRecebido->id_professor);
    $objMateria->setIdTurma($objJsonRecebido->id_turma);
    if($objMateria->getIdMateria() == "")
        throw new Exception("O Id da matéria não pode ser vazio!");
    else if (empty($objMateria->getNomeMateria()))
        throw new Exception("O nome da matéria não pode ser vazio!");
    else if(empty($objMateria->getIdTurma()))
        throw new Exception("O Id da turma não pode ser vazio!");
    else if ($objMateria->update())
        throw new Exception("Erro ao atualizar a matéria!");

    $objResposta->status = true;
    $objResposta->msg = "Atualizado com sucesso";
    $objResposta->dados = $objMateria;
    header("Content-Type: application/json");
    header("HTTP/1.1 200 OK");
} catch (Exception $e){
    $objResposta->status = false;
    $objResposta->msg = $e->getMessage();
}
    echo json_encode($objResposta);
?>
