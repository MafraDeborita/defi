<?php

session_start();
if(!isset($_SESSION['id_usuario'])){
    header('Location: /defi/views/login.php');
}


require_once $_SERVER['DOCUMENT_ROOT'] . "/defi/models/entrada.php";

try {
    $id = $_GET ['id'];

    $entrada = new Entrada ($id);
    $entrada->deletar();
    header('Location: /defi/views/admin/gerenciar_entradas.php');

} catch (PDOException $e) {
    echo $e->getMessage();
}
?>