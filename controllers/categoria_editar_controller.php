<?php

session_start();
if(!isset($_SESSION['id_usuario'])){
    header('Location: /defi/views/login.php');
}


require_once $_SERVER['DOCUMENT_ROOT'] . '/defi/models/categoria.php';

try {
    $id = $_POST['id'];
    $nome = $_POST['nome'];

    $categoria = new Categoria($id);
    $categoria->nome_categoria = $nome;

    $categoria->atualizar();

    $_SESSION['aviso'] = "Categoria '$categoria->nome_categoria' atualizada com sucesso";
    header('Location: /defi/views/admin/gerenciar_categorias.php');
    exit();
} catch (PDOException $e) {
    echo $e->getMessage();
}
