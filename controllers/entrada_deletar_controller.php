<?php
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