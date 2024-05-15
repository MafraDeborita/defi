<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/smartcash/configs/config.php';

class Conexao
{

    public static function criaConexao()
    {
        $conn = new PDO(SGBD . ":host=" . LOCALDOBANCO . ";dbname=" . NOMEDOBANCO . ";charset=utf8", USUARIO, SENHA);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    }
}
