<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/defi/configs/config.php';

class Conexao
{

    public static function criaConexao()
    {
        $conn = new PDO(SGBD . ":host=" . LOCALDOBANCO . ";dbname=" . NOMEDOBANCO, USUARIO, SENHA);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    }
}
