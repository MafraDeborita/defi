<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/defi/models/entrada.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/defi/models/categoria.php';

try {
    $id = $_GET['id'];
    $novaEntrada = new Entrada($id);
    $categorias = Categoria::listar();
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
    <form action="/defi/controllers/entrada_edit_controller.php" method="post">
        <input type="number" name="valor" id="valor" value='<?= $novaEntrada->valor_entrada ?>'>
        <input type="date" name="data" id="data" value='<?= $novaEntrada->data_entrada ?>'>
        <textarea name="descricao" id="descricao" cols="30" rows="10"><?= $novaEntrada->descricao ?></textarea>
        <select name="categoria" id="categoria">
            <?php foreach ($categorias as $categoria) : ?>
                <option value="<?= $categoria['id_categoria']?>" <?= $novaEntrada->id_categoria == $categoria['id_categoria'] ? 'selected' : '' ?>><?= $categoria['nome_categoria']?></option>
            <?php endforeach; ?>
        </select>
        <input type="hidden" name="id" value="<?= $novaEntrada->id_entrada ?>">
        <input type="submit" value="Enviar">
    </form>
</body>

</html>