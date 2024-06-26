<?php
require_once "modelo/Banco.php";

class Materia implements JsonSerializable{
    private $idMateria;
    private $nomeMateria;
    private $idProfessor;
    private $idTurma;

    #[\ReturnTypeWillChange]
    public function jsonSerialize(){   
        $objResposta = new stdClass();
        $objResposta->idMateria = $this->getIdMateria();
        $objResposta->nomeMateria = $this->getNomeMateria();
        $objResposta->idProfessor = $this->getIdProfessor();
        $objResposta->idTurma = $this->getIdTurma();
        return $objResposta;
    }

    public function create(){
        $conexao = Banco::getConexao();
        $sql = "INSERT INTO Materias (nome_materia, id_professor, id_turma) VALUES (?,?,?)";
        $prepareSQL = $conexao->prepare($sql);
        $prepareSQL->bind_param("sii", $this->nomeMateria, $this->idProfessor, $this->idTurma);
        $executou = $prepareSQL->execute();
        $idCadastrado = $conexao->insert_id;
        $this->setIdMateria($idCadastrado);
        return $executou;
    }

    public function delete(){
        $conexao = Banco::getConexao();
        $prepararSql = $conexao->prepare("DELETE FROM Materias WHERE id_Materia = ?");
        $prepararSql->bind_param("i", $this->idMateria);
        $executou = $prepararSql->execute();
        $prepararSql->close();
        return $executou;
    }

    public function isMateria($obj){
        $conexao = Banco::getConexao();
        $prepararSql = $conexao->prepare("SELECT COUNT(*) as qtd FROM Materias WHERE nome_materia = ? and id_turma = ? and id_professor = ?");
        $prepararSql->bind_param("sii", $obj->nome_materia, $obj->id_turma, $obj->id_professor);
        $prepararSql->execute();
        $matrizResultados = $prepararSql->get_result();
        $tuplaBanco = $matrizResultados->fetch_object();

        return $tuplaBanco->qtd > 0;
    }

    public function readAll(){
        $prepararSql = Banco::getConexao()->prepare("SELECT * FROM Materias ORDER BY id_Materia");
        $prepararSql->execute();
        $matrizResultados = $prepararSql->get_result();
        $matrizResultados = $matrizResultados->fetch_all(MYSQLI_ASSOC);

        return $matrizResultados;
    }

    public function readById(){
        $conexao = Banco::getConexao();
        $prepararSql = $conexao->prepare("SELECT * FROM Materias WHERE id_Materia = ?");
        $prepararSql->bind_param("i", $this->idMateria);
        $prepararSql->execute();
        $matrizResultados = $prepararSql->get_result();
        $matrizResultados = $matrizResultados->fetch_all(MYSQLI_ASSOC);
        $prepararSql->close();

        return $matrizResultados;
    }

    public function update(){
        $conexao = Banco::getConexao();
        $prepararSql = $conexao->prepare("UPDATE Materias SET nome_materia = ?, id_professor = ?, id_turma = ? WHERE id_Materia = ?");
        $prepararSql->bind_param("siii", $this->nomeMateria, $this->idProfessor, $this->idTurma, $this->idMateria);
        $executou = $prepararSql->execute();
        $prepararSql->close();

        return $executou;
    }

    // GETs E SETs

    public function getIdMateria(){ return $this->idMateria; }
    public function setIdMateria($idMateria){
        $this->idMateria = $idMateria;
        return $this;
    }
    public function getNomeMateria(){ return $this->nomeMateria; }
    public function setNomeMateria($nomeMateria){
        $this->nomeMateria = $nomeMateria;
        return $this;
    }
    public function getIdProfessor(){ return $this->idProfessor; }
    public function setIdProfessor($idProfessor){
        $this->idProfessor = $idProfessor;
        return $this;
    }
    public function getIdTurma(){ return $this->idTurma; }
    public function setIdTurma($idTurma){
        $this->idTurma = $idTurma;
        return $this;
    }
}
?>