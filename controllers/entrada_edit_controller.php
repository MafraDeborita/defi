<?php
session_start();
if (!isset($_SESSION['id_usuario'])) {
    header('Location: /defi/views/login.php');
}

require_once $_SERVER['DOCUMENT_ROOT'] . "/defi/models/entrada.php";

try {
    $valor = abs($_POST['valor']);
    $data =   $_POST['data'];
    $descricao =  $_POST['descricao'];
    $categoria =  $_POST['categoria'];
    $id =  $_POST['id'];

    $entrada = new Entrada($id);
    $entrada->valor_entrada = $valor;
    $entrada->data_entrada = $data;
    $entrada->descricao = $descricao;
    $entrada->id_categoria = $categoria;

    $entrada->atualizar();

    $_SESSION['aviso'] = "Entrada atualizada com sucesso";
    header('Location: /defi/views/admin/gerenciar_entradas.php');
} catch (PDOException $e) {
    echo $e->getMessage();
}
