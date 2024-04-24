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
    <form action="/defi/controllers/saida_adicionar_controller.php" method="post">
        <input type="number" name="valor" id="valor">
        <textarea name="descricao" id="descricao" cols="30" rows="10"></textarea>
        <input type="date" name="data" id="data">
        <select name="categoria" id="categoria">
            <?php foreach($lista as $c): ?>
                <option value="<?= $c['id_categoria'] ?>"><?= $c['nome_categoria'] ?></option>
            <?php endforeach; ?>
        </select>

        <input type="submit" value="Cadastrar">
    </form>
</body>
</html>