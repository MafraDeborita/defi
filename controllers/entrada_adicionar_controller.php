<?php

session_start();
if(!isset($_SESSION['id_usuario'])){
    header('Location: /smartcash/views/login.php');
}


require_once $_SERVER['DOCUMENT_ROOT'] . '/smartcash/models/entrada.php';



try {
    $valor = abs($_POST['valor']);
    $descricao = $_POST['descricao'];
    $data = $_POST['data'];
    $cat = $_POST['categoria'];

    $entrada = new Entrada();
    $entrada->valor_entrada = $valor;
    $entrada->descricao = $descricao;
    $entrada->data_entrada = $data;
    $entrada->id_categoria = $cat;
    $entrada->id_usuario = $_SESSION['id_usuario'];

    $entrada->criar();

    $_SESSION['aviso'] = "Nova entrada criada com sucesso";
    header('Location: /smartcash/views/admin/gerenciar_entradas.php');
    exit();


} catch (PDOException $e) {
    echo $e->getMessage();
}