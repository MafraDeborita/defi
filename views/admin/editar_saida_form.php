<?php
$tituloPagina = 'Editar Saída';
require_once $_SERVER['DOCUMENT_ROOT'] . '/smartcash/templates/_cabecalho.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/smartcash/models/saida.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/smartcash/models/categoria.php';

if(!isset($_SESSION['id_usuario'])){
    $_SESSION['aviso'] = "Você precisa estar logado";
    header('Location: /smartcash/views/login.php');
}


try {
    $id = $_GET['id'];
    $novaSaida = new Saida($id);
    $categorias = Categoria::listarEntradaSaida('Despesa');
} catch (PDOException $e) {
    echo $e->getMessage();
}

?>

<section class="nav-right-cont">
    <form action="/smartcash/controllers/saida_editar_controller.php" method="post">
        <div class="login">
            <label for="valor">Valor</label>
            <input type="number" class="inputLogin" name="valor" id="valor" value='<?= $novaSaida->valor_saida ?>' min="0" step="0.01" required>

            <label for="descricao">Descrição</label>
            <textarea name="descricao" id="descricao" cols="30" rows="10"><?= $novaSaida->descricao ?></textarea>

            <label for="data">Data</label>
            <input type="date" class="inputLogin" name="data" id="data" value='<?= $novaSaida->data_saida ?>' required>

            <label for="categoria">Categoria</label>
            <select name="categoria" id="categoria" class="inputLogin">
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

            <button type="submit" class="bEntrar">Atualizar</button>
        </div>
    </form>
</section>
</body>

</html>