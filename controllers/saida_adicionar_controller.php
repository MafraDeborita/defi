<?php

session_start();
if(!isset($_SESSION['id_usuario'])){
    header('Location: /defi/views/login.php');
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/defi/models/saida.php';


try {
    $valor = abs($_POST['valor']);
    $descricao = $_POST['descricao'];
    $data = $_POST['data'];
    $cat = $_POST['categoria'];

    $saida = new Saida();
    $saida->valor_saida = $valor;
    $saida->descricao = $descricao;
    $saida->data_saida = $data;
    $saida->id_categoria = $cat;
    $saida->id_usuario = $_SESSION['id_usuario'];

    $saida->criar();

    $_SESSION['aviso'] = "Nova saída criada com sucesso";
    header('Location: /defi/views/admin/gerenciar_saidas.php');
    exit();


} catch (PDOException $e) {
    echo $e->getMessage();
}