<?php

session_start();
if(!isset($_SESSION['id_usuario'])){
    header('Location: /smartcash/views/login.php');
}


require_once $_SERVER['DOCUMENT_ROOT'] . "/smartcash/models/entrada.php";

try {
    $id = $_GET ['id'];

    $entrada = new Entrada ($id);
    $entrada->deletar();

    $_SESSION['aviso'] = "entrada deletada com sucesso";
    header('Location: /smartcash/views/admin/gerenciar_entradas.php');

} catch (PDOException $e) {
    echo $e->getMessage();
}
?>