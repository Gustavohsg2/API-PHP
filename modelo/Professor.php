<?php
require_once "modelo/Banco.php";
class Professor implements JsonSerializable
{
    private $idProf;
    private $idade;
    private $formacao;
    private $nome;

    #[\ReturnTypeWillChange]
    public function jsonSerialize()
    {   
        $objResposta = new stdClass();

        $objResposta->idProf = $this->getIdProfessor();
        $objResposta->nome = $this->getNome();
        $objResposta->idade = $this->getIdade();
        $objResposta->formacao = $this->getFormacao();
        return $objResposta;
    }

    public function create(){
        $conexao = Banco::getConexao();
        $sql = "INSERT INTO Professor (nome_professor, idade, formacao) VALUES (?,?,?)";
        $prepareSQL = $conexao->prepare($sql);
        $prepareSQL->bind_param("sis",$this->nome,$this->idade, $this->formacao);
        $executou = $prepareSQL->execute();
        $idCadastrado = $conexao->insert_id;
        $this->setIdProfessor($idCadastrado);
        return $executou;
    }

    public function delete(){
        $conexao = Banco::getConexao();
        $prepararSql = $conexao->prepare("DELETE FROM Professor WHERE id_professor = ?");
        $prepararSql->bind_param("i", $this->idProf);
        $executou = $prepararSql->execute();
        $prepararSql->close();

        return $executou;
    }
    public function isProfessor($nome){
        $conexao = Banco::getConexao();
        $prepararSql = $conexao->prepare("SELECT COUNT(*) as qtd FROM Professor WHERE nome_professor = ?");
        $prepararSql->bind_param("s", $nome);
        $prepararSql->execute();
        $matrizResultados = $prepararSql->get_result();
        $tuplaBanco = $matrizResultados->fetch_object();

        return $tuplaBanco->qtd > 0;
    }
    public function readAll()
    {
        $conexao = Banco::getConexao();
        $prepararSql = $conexao->prepare("SELECT * FROM Professor ORDER BY id_professor");
        $prepararSql->execute();
        $matrizResultados = $prepararSql->get_result();

        $turmas = array();
        $i = 0;
        while ($tuplaBanco = $matrizResultados->fetch_object()) {

            $professor = new Professor();
            $professor->setIdProfessor($tuplaBanco->id_professor);
            $professor->setNome($tuplaBanco->nome_professor);
            $professor->setIdade($tuplaBanco->idade);
            $professor->setFormacao($tuplaBanco->formacao);
            $professores[$i] = $professor;
            $i = $i + 1;
        }
        $prepararSql->close(); 

        return $professores;
    }

    public function readById()
    {
        $conexao = Banco::getConexao();
        $prepararSql = $conexao->prepare("SELECT * FROM Professor where id_professor=?");
        $prepararSql->bind_param("s", $this->idProf);
        $prepararSql->execute();
        $matrizResultados = $prepararSql->get_result();
        $professores = array();
        while ($tuplaBanco = $matrizResultados->fetch_object()) {
            $professor = new Professor();
            $professor->setIdProfessor($tuplaBanco->id_professor);
            $professor->setNome($tuplaBanco->nome_professor);
            $professor->setIdade($tuplaBanco->idade);
            $professor->setFormacao($tuplaBanco->formacao);
            $professores[0] = $professor;
        }
        $prepararSql->close();

        return $professores;
    }

    public function update()
    {
        $conexao = Banco::getConexao();
        $prepararSql = $conexao->prepare("UPDATE Professor SET nome_professor = ?, idade = ?, formacao = ? WHERE id_professor = ?");
        $prepararSql->bind_param("sisi", $this->nome, $this->idade, $this->formacao, $this->idProf);
        $executou = $prepararSql->execute();
        $prepararSql->close();

        return $executou;
    }

    // GETs E SETs

    public function getIdProfessor()
    {
        return $this->idProf;
    }
    public function setIdProfessor($idProfessor)
    {
        $this->idProf = $idProfessor;
        return $this;
    }
        public function getNome(){
        return $this->nome;
    }
    public function setNome($nome)
    {
        $this->nome = $nome;
        return $this;
    }
    public function getIdade()
    {
        return $this->idade;
    }
    public function setIdade($idade)
    {
        $this->idade = $idade;
        return $this;
    }
    public function getFormacao(){
        return $this->formacao;
    }
    public function setFormacao($Formacao){
        $this->formacao = $Formacao;
        return $this;
    }


}