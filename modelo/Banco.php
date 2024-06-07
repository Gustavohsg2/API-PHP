<?php
class Banco
{
    private static $HOST_SERVIDOR = "127.0.0.1";
    private static $USUARIO_BANCO = "root";
    private static $SENHA_BANCO = "";
    private static $NOME_BANCO = "Escola";
    private static $PORTA = "3006";
    private static $CONEXAO = null;

    private static function conectar(){
        try{
            Banco::$CONEXAO = new mysqli(Banco::$HOST_SERVIDOR, Banco::$USUARIO_BANCO, Banco::$SENHA_BANCO, Banco::$NOME_BANCO, Banco::$PORTA);
            if (Banco::$CONEXAO->connect_error)
                throw new Exception("Erro ao se conectar com o banco de dados: " . Banco::$CONEXAO->connect_error);
        } catch (Error $e){
            $objResposta = new stdClass();
            $objResposta->cod = 2;
            $objResposta->erro = $e->getMessage();
            die(json_encode($objResposta));
        } catch (Exception $e){
            $objResposta = new stdClass();
            $objResposta->cod = 1;
            $objResposta->erro = $e->getMessage();
            die(json_encode($objResposta));
        }
    }
    public static function getConexao(){
        if (Banco::$CONEXAO == null)
            Banco::conectar();
        return Banco::$CONEXAO;
    }
}
?>
