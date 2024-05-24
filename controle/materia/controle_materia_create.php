<?php
require_once "modelo/Materia.php";

$textoJsonRecebidoCorpoPOST = file_get_contents('php://input');
$objJsonRecebido = json_decode($textoJsonRecebidoCorpoPOST);
$objResposta = new stdClass();

$objMateria = new Materia();

if ($objJsonRecebido->nome_materia == ""){
    $objResposta->cod = 1;
    $objResposta->status = false;
    $objResposta->msg = "O nome da matéria não pode ser vazio";
}else if ($objJsonRecebido->id_professor == "") {
    $objResposta->cod = 1;
    $objResposta->status = false;
    $objResposta->msg = "O ID do professor não pode ser vazio";
} else if($objJsonRecebido->id_turma == ""){
    $objResposta->cod = 1;
    $objResposta->status = false;
    $objResposta->msg = "O ID da turma não pode ser vazio";
} if ($objMateria->isMateria($objJsonRecebido->nome_materia, $objJsonRecebido->id_professor, $objJsonRecebido->id_turma) == true) {
    $objResposta->cod = 3;
    $objResposta->status = false;
    $objResposta->msg = "Já existe uma matéria cadastrada com o nome: " . $objJsonRecebido->nome_materia;
} else {
    $objMateria->setNomeMateria($objJsonRecebido->nome_materia);
    $objMateria->setIdProfessor($objJsonRecebido->id_professor);
    $objMateria->setIdTurma($objJsonRecebido->id_turma);
    if ($objMateria->create() == true) {
        $objResposta->cod = 4;
        $objResposta->status = true;
        $objResposta->msg = "Cadastrado com sucesso";
        $objResposta->dados = $objMateria;
    } else {
        $objResposta->cod = 5;
        $objResposta->status = false;
        $objResposta->msg = "Ocorreu um erro ao cadastrar a matéria";
        $objResposta->dados = $objMateria;
    }
}

header("Content-Type: application/json");
header("HTTP/1.1 201 OK");
echo json_encode($objResposta);
?>
