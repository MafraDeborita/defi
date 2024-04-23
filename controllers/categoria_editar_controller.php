<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/defi/models/categoria.php';

try {
    $id = $_POST['id'];
    $nome = $_POST['nome'];

    $categoria = new Categoria($id);
    $categoria->nome_categoria = $nome;

    $categoria->atualizar();

    header('Location: /defi/views/admin/gerenciar_categorias.php');
    exit();
} catch (PDOException $e) {
    echo $e->getMessage();
}
