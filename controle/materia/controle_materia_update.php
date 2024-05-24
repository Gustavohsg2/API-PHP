<?php
require_once "modelo/Materia.php";

$textoJsonRecebidoCorpoPUT = file_get_contents('php://input');
$objJsonRecebido = json_decode($textoJsonRecebidoCorpoPUT);

$objResposta = new stdClass();

$objMateria = new Materia();

$objMateria->setIdMateria($parametro_idMateria);
$objMateria->setNomeMateria($objJsonRecebido->nome_materia);
$objMateria->setIdProfessor($objJsonRecebido->id_professor);
$objMateria->setIdTurma($objJsonRecebido->id_turma);

if (empty($objJsonRecebido->nome_materia)) {
    $objResposta->cod = 1;
    $objResposta->status = false;
    $objResposta->msg = "O nome da matéria não pode ser vazio";
} else {
    if ($objMateria->update()) {
        $objResposta->cod = 4;
        $objResposta->status = true;
        $objResposta->msg = "Atualizado com sucesso";
        $objResposta->dados = $objMateria;
    } else {
        $objResposta->cod = 5;
        $objResposta->status = false;
        $objResposta->msg = "Erro ao atualizar a matéria";
    }
}

header("Content-Type: application/json");
header("HTTP/1.1 200 OK");
echo json_encode($objResposta);
?>
