<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/defi/models/categoria.php';

try {
    $lista = Categoria::listar();
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
    <a href="/defi/views/admin/adicionar_categoria_form.php">Adicionar</a>
    <ul>
        <?php foreach($lista as $c): ?>
            <li><?= $c['nome_categoria'] ?></li>
            <ul>
                <li><a href="/defi/views/admin/editar_categoria_form.php?id=<?= $c['id_categoria'] ?>">Editar</a></li>
                <li><a href="/defi/controllers/categoria_deletar_controller.php?id=<?= $c['id_categoria'] ?>">Deletar</a></li>
            </ul>
        <?php endforeach;?>
    </ul>
</body>
</html>