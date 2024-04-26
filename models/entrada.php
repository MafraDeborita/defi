<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/defi/db/conexao.php';

class Entrada{
    public $id_entrada;
    public $valor_entrada;
    public $data_entrada;
    public $descricao;
    public $id_categoria;
    public $id_usuario;

    public function __construct($id = false)
    {
        if ($id) {
            $this->id_entrada = $id;
            $this->carregar();
        }
    }

    public function carregar()
    {
        $sql = 'SELECT * FROM entradas WHERE id_entrada = :id';
        $conexao = Conexao::criaConexao();
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':id', $this->id_entrada);
        $stmt->execute();
        $resultado = $stmt->fetch();
        $this->valor_entrada = $resultado['valor_entrada'];
        $this->data_entrada = $resultado['data_entrada'];
        $this->descricao = $resultado['descricao'];
        $this->id_categoria = $resultado['id_categoria'];
        $this->id_usuario = $resultado['id_usuario'];
    }

    public function criar()
    {
        $sql = 'INSERT INTO entradas (valor_entrada, data_entrada, descricao, id_categoria, id_usuario) VALUES (:valor, :dia, :descr, :cat, :dono)';
        $conexao = Conexao::criaConexao();
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':valor', $this->valor_entrada);
        $stmt->bindValue(':dia', $this->data_entrada);
        $stmt->bindValue(':descr', $this->descricao);
        $stmt->bindValue(':cat', $this->id_categoria);
        $stmt->bindValue(':dono', $this->id_usuario);
        $stmt->execute();
    }

    public static function listar($id_usuario)
    {
        $sql = 'SELECT e.*, u.id_usuario, u.nome, c.nome_categoria
        FROM entradas e 
        JOIN usuarios u 
        ON e.id_usuario = u.id_usuario
        JOIN categorias c
        ON c.id_categoria = e.id_categoria 
        WHERE u.id_usuario = :id';
        $conexao = Conexao::criaConexao();
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':id', $id_usuario);
        $stmt->execute();
        $resultado = $stmt->fetchAll();
        return $resultado;
    }

    public function atualizar()
    {
        $sql = 'UPDATE entradas SET valor_entrada = :valor, data_entrada = :dia, descricao = :descr, id_categoria = :cat WHERE id_entrada = :id';
        $conexao = Conexao::criaConexao();
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':valor', $this->valor_entrada);
        $stmt->bindValue(':dia', $this->data_entrada);
        $stmt->bindValue(':descr', $this->descricao);
        $stmt->bindValue(':cat', $this->id_categoria);
        $stmt->bindValue(':id', $this->id_entrada);
        $stmt->execute();
    }

    public function deletar()
    {
        $sql = 'DELETE FROM entradas WHERE id_entrada = :id';
        $conexao = Conexao::criaConexao();
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':id', $this->id_entrada);
        $stmt->execute();
    }
}