<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/defi/db/conexao.php';

class Usuario
{
    public $id_usuario;
    public $nome;
    public $senha;
    public $email;
    public $foto_usuario;

    public function __construct($id = false)
    {
        if ($id) {
            $this->id_usuario = $id;
            $this->carregar();
        }
    }

    public function carregar()
    {
        $sql = 'SELECT * FROM usuarios WHERE id_usuario = :id';
        $conexao = Conexao::criaConexao();
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':id', $this->id_usuario);
        $stmt->execute();
        $resultado = $stmt->fetch();
        $this->nome = $resultado['nome'];
        $this->senha = $resultado['senha'];
        $this->email = $resultado['email'];
        $this->foto_usuario = $resultado['foto_usuario'];
    }

    public function criar()
    {
        $sql = 'INSERT INTO usuarios (nome, email, senha, foto_usuario) VALUES (:nome, :email, :senha, :foto)';
        $conexao = Conexao::criaConexao();
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':nome', $this->nome);
        $stmt->bindValue(':email', $this->email);
        $stmt->bindValue(':senha', $this->senha);
        $stmt->bindValue(':foto', $this->foto_usuario);
        $stmt->execute();
    }

    public static function listar()
    {
        $sql = 'SELECT * FROM usuarios';
        $conexao = Conexao::criaConexao();
        $stmt = $conexao->prepare($sql);
        $stmt->execute();
        $resultado = $stmt->fetchAll();
        return $resultado;
    }

    public function atualizar()
    {
        $sql = 'UPDATE usuarios SET nome = :nome, email = :email, foto_usuario = :foto WHERE id_usuario = :id';
        $conexao = Conexao::criaConexao();
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':nome', $this->nome);
        $stmt->bindValue(':email', $this->email);
        $stmt->bindValue(':foto', $this->foto_usuario);
        $stmt->bindValue(':id', $this->id_usuario);
        $stmt->execute();
    }

    public function atualizarSenha()
    {
        $sql = 'UPDATE usuarios SET senha = :senha WHERE id_usuario = :id';
        $conexao = Conexao::criaConexao();
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':senha', $this->senha);
        $stmt->bindValue(':id', $this->id_usuario);
        $stmt->execute();
    }

    public function deletar()
    {
        $sql = 'DELETE FROM usuarios WHERE id_usuario = :id';
        $conexao = Conexao::criaConexao();
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':id', $this->id_usuario);
        $stmt->execute();
    }

    public static function logar($email, $senha)
    {
        $sql = "SELECT * FROM usuarios WHERE email = :email";
        $conexao = Conexao::criaConexao();
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        $usuario = $stmt->fetch();
        session_start();
        if ($usuario['id_usuario'] && password_verify($senha, $usuario['senha'])) {
            $_SESSION['id_usuario'] = $usuario['id_usuario'];
            $_SESSION['nome'] = $usuario['nome'];
            $_SESSION['email'] = $usuario['email'];
            $_SESSION['foto_usuario'] = $usuario['foto_usuario'];

            header('Location: /defi/index.php');
        } else {
            $_SESSION['aviso'] = "Email ou Senha incorretos";
            header('Location: /defi/views/login.php');
        }
    }

    public static function gerarExtrato($id_usuario)
    {
        $sql = "SELECT e.data_entrada as 'DATA', e.descricao, e.valor_entrada as 'VALOR', c.nome_categoria as 'CATEGORIA' 
        FROM entradas e
        JOIN categorias c
        ON e.id_categoria = c.id_categoria
        WHERE e.id_usuario = :id 
        UNION ALL
        SELECT s.data_saida, s.descricao, -s.valor_saida, c.nome_categoria 
        FROM saidas s 
        JOIN categorias c
        ON s.id_categoria = c.id_categoria
        WHERE s.id_usuario = :id
        ORDER BY `DATA` ASC";
        $conexao = Conexao::criaConexao();
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':id', $id_usuario);
        $stmt->execute();
        $resultado = $stmt->fetchAll();
        return $resultado;
    }
}
