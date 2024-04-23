<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/defi/db/conexao.php';

class Saida{
    public $id_saida;
    public $valor_saida;
    public $data_saida;
    public $pago;
    public $descricao;
    public $id_categoria;
    public $id_usuario;

    public function __construct($id = false)
    {
        if ($id) {
            $this->id_saida = $id;
            $this->carregar();
        }
    }

    public function carregar()
    {
        $sql = 'SELECT * FROM saidas WHERE id_saida = :id';
        $conexao = Conexao::criaConexao();
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':id', $this->id_saida);
        $stmt->execute();
        $resultado = $stmt->fetch();
        $this->valor_saida = $resultado['valor_saida'];
        $this->data_saida = $resultado['data_saida'];
        $this->pago = $resultado['pago'];
        $this->descricao = $resultado['descricao'];
        $this->id_categoria = $resultado['id_categoria'];
        $this->id_usuario = $resultado['id_usuario'];
    }

    public function criar()
    {
        $sql = 'INSERT INTO saidas (valor_saida, data_saida, descricao, id_categoria, id_usuario) VALUES (:valor, :dia, :descr, :cat, :dono)';
        $conexao = Conexao::criaConexao();
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':valor', $this->valor_saida);
        $stmt->bindValue(':dia', $this->data_saida);
        $stmt->bindValue(':descr', $this->descricao);
        $stmt->bindValue(':cat', $this->id_categoria);
        $stmt->bindValue(':dono', $this->id_usuario);
        $stmt->execute();
    }

    public static function listar($id_usuario)
    {
        $sql = 'SELECT e.*, u.id_usuario, u.nome 
        FROM saidas e 
        JOIN usuarios u 
        ON e.id_usuario = u.id_usuario 
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
        $sql = 'UPDATE saidas SET valor_saida = :valor, pago = :pago, data_saida = :dia, descricao = :descr, id_categoria = :cat WHERE id_saida = :id';
        $conexao = Conexao::criaConexao();
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':valor', $this->valor_saida);
        $stmt->bindValue(':pago', $this->pago);
        $stmt->bindValue(':dia', $this->data_saida);
        $stmt->bindValue(':descr', $this->descricao);
        $stmt->bindValue(':cat', $this->id_categoria);
        $stmt->bindValue(':id', $this->id_saida);
        $stmt->execute();
    }

    public function deletar()
    {
        $sql = 'DELETE FROM saidas WHERE id_saida = :id';
        $conexao = Conexao::criaConexao();
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':id', $this->id_saida);
        $stmt->execute();
    }
}