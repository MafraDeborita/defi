<?php

session_start();
if(!isset($_SESSION['id_usuario'])){
    header('Location: /smartcash/views/login.php');
}

require_once $_SERVER['DOCUMENT_ROOT'] . "/smartcash/models/saida.php";

try {
    $id = $_GET ['id'];

    $saida = new Saida ($id);
    $saida->deletar();

    $_SESSION['aviso'] = "Saída deletada com sucesso";
    header('Location: /smartcash/views/admin/gerenciar_saidas.php');

} catch (PDOException $e) {
    echo $e->getMessage();
}
?>