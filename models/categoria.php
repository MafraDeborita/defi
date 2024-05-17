<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/smartcash/db/conexao.php';

class Categoria
{
    public $id_categoria;
    public $nome_categoria;

    public function __construct($id = false)
    {
        if ($id) {
            $this->id_categoria = $id;
            $this->carregar();
        }
    }

    public function carregar()
    {
        $sql = 'SELECT * FROM categorias WHERE id_categoria = :id';
        $conexao = Conexao::criaConexao();
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':id', $this->id_categoria);
        $stmt->execute();
        $resultado = $stmt->fetch();
        $this->nome_categoria = $resultado['nome_categoria'];
    }

    public function criar()
    {
        $sql = 'INSERT INTO categorias (nome_categoria) VALUES (:nome)';
        $conexao = Conexao::criaConexao();
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':nome', $this->nome_categoria);
        $stmt->execute();
    }

    public static function listar()
    {
        $sql = 'SELECT * FROM categorias ORDER BY nome_categoria';
        $conexao = Conexao::criaConexao();
        $stmt = $conexao->prepare($sql);
        $stmt->execute();
        $resultado = $stmt->fetchAll();
        return $resultado;
    }

    public static function listarEntradaSaida($origem)
    {
        $sql = 'SELECT * FROM categorias WHERE origem  = :origem ORDER BY nome_categoria';
        $conexao = Conexao::criaConexao();
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':origem', $origem);
        $stmt->execute();
        $resultado = $stmt->fetchAll();
        return $resultado;
    }

    public function atualizar()
    {
        $sql = 'UPDATE categorias SET nome_categoria = :nome WHERE id_categoria = :id';
        $conexao = Conexao::criaConexao();
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':nome', $this->nome_categoria);
        $stmt->bindValue(':id', $this->id_categoria);
        $stmt->execute();
    }

    public function deletar()
    {
        $sql = 'DELETE FROM categorias WHERE id_categoria = :id';
        $conexao = Conexao::criaConexao();
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':id', $this->id_categoria);
        $stmt->execute();
    }
}
