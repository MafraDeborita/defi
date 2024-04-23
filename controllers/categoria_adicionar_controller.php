<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/defi/models/categoria.php';

try {
    $nome = $_POST['nome'];

    $categoria = new Categoria();
    $categoria->nome_categoria = $nome;

    $categoria->criar();

    header('Location: /defi/views/admin/gerenciar_categorias.php');
    exit();
} catch (PDOException $e) {
    echo $e->getMessage();
}
