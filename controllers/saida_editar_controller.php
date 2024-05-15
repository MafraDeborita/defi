<?php

session_start();
if (!isset($_SESSION['id_usuario'])) {
    header('Location: /smartcash/views/login.php');
}

require_once $_SERVER['DOCUMENT_ROOT'] . "/smartcash/models/saida.php";

try {
    $valor = abs($_POST['valor']);
    $data = $_POST['data'];
    $descricao = $_POST['descricao'];
    $categoria = $_POST['categoria'];
    $pago = $_POST['pago'];
    $id = $_POST['id'];

    $saida = new Saida($id);
    $saida->valor_saida = $valor;
    $saida->data_saida = $data;
    $saida->descricao = $descricao;
    $saida->pago = $pago;
    $saida->id_categoria = $categoria;

    $saida->atualizar();

    $_SESSION['aviso'] = "Saída atualizada com sucesso";
    header('Location: /smartcash/views/admin/gerenciar_saidas.php');
} catch (PDOException $e) {
    echo $e->getMessage();
}
