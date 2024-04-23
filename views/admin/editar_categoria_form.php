<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/defi/models/categoria.php';

try {
    $id = $_GET['id'];

    $categoria = new Categoria($id);
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
    <form action="/defi/controllers/categoria_editar_controller.php" method="post">
        <label for="nome">Nome da Categoria</label>
        <input type="text" id="nome" name="nome" value="<?= $categoria->nome_categoria ?>">

        <input type="hidden" name="id" value="<?= $categoria->id_categoria ?>">

        <input type="submit" value="Atualizar">
    </form>
</body>
</html>