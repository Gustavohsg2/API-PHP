<?php
require_once ("modelo/Banco.php");
require_once ("modelo/Professor.php");
$textoRecebido = file_get_contents("php://input");
$objJson = json_decode($textoRecebido) or die('{"formato incorreto"}');

$objResposta = new stdClass();
$objTurma = new Professor();

if ($objJsonRecebido->nomeProfessor == "") {
    $objResposta->cod = 1;
    $objResposta->status = false;
    $objResposta->msg = "O nome não pode ser vazio";
} else if($objJsonRecebido->idadeProfessor == ""){
    $objResposta->cod = 1;
    $objResposta->status = false;
    $objResposta->msg = "A idade não pode ser vazio";
} else if($objJsonRecebido->Formacao == ""){
    $objResposta->cod = 1;
    $objResposta->status = false;
    $objResposta->msg = "A formação não pode ser vazio";
} if ($objTurma->isProfessor($objJsonRecebido->nomeProfessor) == true) {
    $objResposta->cod = 3;
    $objResposta->status = false;
    $objResposta->msg = "já existe um funcionário cadastrado com o nome: " . $objJsonRecebido->nomeProfessor;
} else {
    $objTurma->setNome($objJson->nomeProfessor);
    $objTurma->setIdade($objJson->idadeProfessor);
    $objTurma->setFormacao($objJson->Formacao);
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
?>