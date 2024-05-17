<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/smartcash/db/conexao.php';

class Grafico
{
    public $id_grafico;
    public $origem;
    public $valor;
    public $RESULTADO;
    public $LUCRATIVIDADE;

    public function __construct($id = false)
    {
        if ($id) {
            $this->id_grafico = $id;
            $this->carregar();
        }
    }

    public function carregar()
    {
        $sql = "SELECT  u.id_usuario, c.origem, SUM(e.valor_entrada) as 'valor'
        FROM entradas e 
        JOIN usuarios u 
        ON e.id_usuario = u.id_usuario
        JOIN categorias c
        ON c.id_categoria = e.id_categoria 
        WHERE u.id_usuario = :id        
        UNION ALL     
        SELECT u.id_usuario, c.origem, SUM(s.valor_saida) as 'valor'
        FROM saidas s 
        JOIN usuarios u 
        ON s.id_usuario = u.id_usuario
        JOIN categorias c
        ON c.id_categoria = s.id_categoria 
        WHERE u.id_usuario = :id
        UNION ALL     
        SELECT u.id_usuario, 'Saldo' as total, 
           (SELECT  SUM(e.valor_entrada) 
                FROM entradas e
                JOIN categorias c
                ON e.id_categoria = c.id_categoria
                WHERE e.id_usuario = :id
        ) - SUM(s.valor_saida) as 'RESULTADO'
        FROM saidas s 
        JOIN usuarios u 
        ON s.id_usuario = u.id_usuario
        JOIN categorias c
        ON c.id_categoria = s.id_categoria 
        WHERE u.id_usuario = :id";

        $conexao = Conexao::criaConexao();
        var_dump($conexao);
        $stmt = $conexao->prepare($sql);
        var_dump($stmt);
        /*$stmt->bindValue(':id', $this->id_grafico);*/
        $stmt->execute();
        $resultado = $stmt->fetch();
        $this->RECEITA = $resultado['origem'];
        $this->DESPESA = $resultado['valor'];
    }
    public static function tblGrafico($id_usuario)
    {
        $sql = "SELECT  u.id_usuario, c.origem, SUM(e.valor_entrada) as 'valor'
        FROM entradas e 
        JOIN usuarios u 
        ON e.id_usuario = u.id_usuario
        JOIN categorias c
        ON c.id_categoria = e.id_categoria 
        WHERE u.id_usuario = :id        
        UNION ALL     
        SELECT u.id_usuario, c.origem, SUM(s.valor_saida) as 'valor'
        FROM saidas s 
        JOIN usuarios u 
        ON s.id_usuario = u.id_usuario
        JOIN categorias c
        ON c.id_categoria = s.id_categoria 
        WHERE u.id_usuario = :id";

        $conexao = Conexao::criaConexao();
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':id', $id_usuario);
        $stmt->execute();
        $resultado = $stmt->fetchAll();
        return $resultado;
    }
}
