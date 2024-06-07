<?php
require_once "modelo/Banco.php";
class Turma implements JsonSerializable{
    private $idTurma;
    private $serieTurma;
    private $representanteTurma;

    #[\ReturnTypeWillChange]
    public function jsonSerialize()
    {   
        $objResposta = new stdClass();

        $objResposta->idTurma = $this->getIdTurma();
        $objResposta->nomeTurma = $this->getSerieTurma();
        $objResposta->representanteTurma = $this->getRepresentanteTurma();
        return $objResposta;
    }

    public function create(){
        $conexao = Banco::getConexao();
        $sql = "INSERT INTO Turmas (serie, nome_representante) VALUES (?,?)";
        $prepareSQL = $conexao->prepare($sql);
        $prepareSQL->bind_param("ss",$this->serieTurma,$this->representanteTurma);
        $executou = $prepareSQL->execute();
        $idCadastrado = $conexao->insert_id;
        $this->setIdTurma($idCadastrado);
        return $executou;
    }

    public function delete(){
        $conexao = Banco::getConexao();
        $prepararSql = $conexao->prepare("DELETE FROM Turmas WHERE id_turma = ?");
        $prepararSql->bind_param("i", $this->idTurma);
        $executou = $prepararSql->execute();
        $prepararSql->close();

        return $executou;
    }
    public function isTurma($serie){
        $conexao = Banco::getConexao();
        $prepararSql = $conexao->prepare("SELECT COUNT(*) as qtd FROM Turmas WHERE serie = ?");
        $prepararSql->bind_param("s", $serie);
        $prepararSql->execute();
        $matrizResultados = $prepararSql->get_result();
        $tuplaBanco = $matrizResultados->fetch_object();

        return $tuplaBanco->qtd > 0;
    }
    public function readAll(){
        $conexao = Banco::getConexao();
        $prepararSql = $conexao->prepare("SELECT * FROM Turmas ORDER BY id_turma");
        $prepararSql->execute();
        $matrizResultados = $prepararSql->get_result();
        $matrizResultados = $matrizResultados->fetch_all(MYSQLI_ASSOC);
        $prepararSql->close(); 

        return $matrizResultados;
    }

    public function readById()
    {
        $conexao = Banco::getConexao();
        $prepararSql = $conexao->prepare("SELECT * FROM Turmas where id_turma=?");
        $prepararSql->bind_param("s", $this->idTurma);
        $prepararSql->execute();
        $vetorResultado = $prepararSql->get_result();
        $vetorResultado = $vetorResultado->fetch_all(MYSQLI_ASSOC);
        $prepararSql->close();

        return $vetorResultado;
    }

    public function update()
    {
        $conexao = Banco::getConexao();
        $prepararSql = $conexao->prepare("UPDATE Turmas SET serie = ?, nome_representante = ? WHERE id_turma = ?");
        $prepararSql->bind_param("ssi", $this->serieTurma, $this->representanteTurma, $this->idTurma);
        $executou = $prepararSql->execute();
        $prepararSql->close();

        return $executou;
    }

    // GETs E SETs

    public function getIdTurma()
    {
        return $this->idTurma;
    }
    public function setIdTurma($idTurma)
    {
        $this->idTurma = $idTurma;
        return $this;
    }

    public function getSerieTurma()
    {
        return $this->serieTurma;
    }
    public function setSerieTurma($serieTurma)
    {
        $this->serieTurma = $serieTurma;
        return $this;
    }
    public function getRepresentanteTurma(){
        return $this->representanteTurma;
    }
    public function setRepresentanteTurma($representanteTurma){
        $this->representanteTurma = $representanteTurma;
        return $this;
    }


}