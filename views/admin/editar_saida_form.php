<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/defi/models/saida.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/defi/models/categoria.php';

try {
    $id = $_GET['id'];
    $novaSaida = new Saida($id);
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
    <form action="/defi/controllers/saida_editar_controller.php" method="post">
        <input type="number" name="valor" id="valor" value='<?= $novaSaida->valor_saida ?>'>
        <input type="date" name="data" id="data" value='<?= $novaSaida->data_saida ?>'>
        <textarea name="descricao" id="descricao" cols="30" rows="10"><?= $novaSaida->descricao ?></textarea>
        <select name="categoria" id="categoria">
            <?php foreach ($categorias as $categoria) : ?>
                <option value="<?= $categoria['id_categoria'] ?>" <?= $novaSaida->id_categoria == $categoria['id_categoria'] ? 'selected' : '' ?>><?= $categoria['nome_categoria'] ?></option>
            <?php endforeach; ?>
        </select>

        <fieldset>
            <legend>Esta pago?</legend>
            <label for="radiosim">Sim</label>
            <input type="radio" name="pago" id="radiosim" value="1" <?= $novaSaida->pago == 1 ? 'checked' : '' ?>>
            <label for="radionao">Não</label>
            <input type="radio" name="pago" id="radionao" value="0" <?= $novaSaida->pago == 0 ? 'checked' : '' ?>>
        </fieldset>

        <input type="hidden" name="id" value="<?= $novaSaida->id_saida ?>">
        <input type="submit" value="Enviar">
    </form>
</body>

</html>