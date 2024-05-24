<?php
class Banco
{
    private static $HOST_SERVIDOR = "127.0.0.1";
    private static $USUARIO_BANCO = "root";
    private static $SENHA_BANCO = "";
    private static $NOME_BANCO = "Escola";
    private static $PORTA = "3306";
    private static $CONEXAO = null;

    private static function conectar()
    {
        Banco::$CONEXAO = new mysqli(Banco::$HOST_SERVIDOR, Banco::$USUARIO_BANCO, Banco::$SENHA_BANCO, Banco::$NOME_BANCO, Banco::$PORTA);
        if (Banco::$CONEXAO->connect_error) {
            die("Falha ao conectar: " . Banco::$CONEXAO->connect_error);
        }
    }
    public static function getConexao()
    {
        if (Banco::$CONEXAO == null) {
            Banco::conectar();
        }
        return Banco::$CONEXAO;
    }
}
?>
