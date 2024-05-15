<?php
session_start();
if(!isset($_SESSION['id_usuario'])){
    header('Location: /smartcash/views/login.php');
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/smartcash/models/categoria.php';

try {
    $nome = $_POST['nome'];

    $categoria = new Categoria();
    $categoria->nome_categoria = $nome;

    $categoria->criar();

    $_SESSION['aviso'] = "Categoria '$categoria->nome_categoria' criada com sucesso";
    header('Location: /smartcash/views/admin/gerenciar_categorias.php');
    exit();
} catch (PDOException $e) {
    echo $e->getMessage();
}
