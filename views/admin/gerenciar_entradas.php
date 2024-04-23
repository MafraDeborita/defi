<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/defi/models/entrada.php';

session_start();

try {
    $lista = Entrada::listar($_SESSION['id_usuario']);
} catch (PDOException $e) {
    echo $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<a href="/defi/views/admin/adicionar_entrada_form.php">Adicionar</a>
    <ul>
        <?php foreach($lista as $e): ?>
            <li><?= $e['descricao'] ?></li>
            <li><?= $e['valor_entrada'] ?></li>
            <ul>
                <li><a href="/defi/views/admin/editar_entrada_form.php?id=<?= $e['id_entrada'] ?>">Editar</a></li>
                <li><a href="/defi/controllers/entrada_deletar_controller.php?id=<?= $e['id_entrada'] ?>">Deletar</a></li>
            </ul>
        <?php endforeach;?>
    </ul>
</body>
</html>