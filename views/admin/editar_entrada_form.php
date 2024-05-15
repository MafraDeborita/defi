<?php
$tituloPagina = 'Editar Entrada';
require_once $_SERVER['DOCUMENT_ROOT'] . '/smartcash/templates/_cabecalho.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/smartcash/models/entrada.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/smartcash/models/categoria.php';

if(!isset($_SESSION['id_usuario'])){
    $_SESSION['aviso'] = "Você precisa estar logado";
    header('Location: /smartcash/views/login.php');
}


try {
    $id = $_GET['id'];
    $novaEntrada = new Entrada($id);
    $categorias = Categoria::listar();
} catch (PDOException $e) {
    echo $e->getMessage();
}

?>

<section class="nav-right-cont">
    <form action="/smartcash/controllers/entrada_edit_controller.php" method="post">
        <div class="login">
            <label for="valor">Valor</label>
            <input type="number" class="inputLogin" name="valor" id="valor" value='<?= $novaEntrada->valor_entrada ?>' min="0" step="0.01" required>

            <label for="descricao">Descrição</label>
            <textarea name="descricao" id="descricao" cols="30" rows="10"><?= $novaEntrada->descricao ?></textarea>

            <label for="data">Data</label>
            <input type="date" class="inputLogin" name="data" id="data" value='<?= $novaEntrada->data_entrada ?>' required>

            <label for="categoria">Categoria</label>
            <select name="categoria" id="categoria" class="inputLogin">
                <?php foreach ($categorias as $categoria) : ?>
                    <option value="<?= $categoria['id_categoria'] ?>" <?= $novaEntrada->id_categoria == $categoria['id_categoria'] ? 'selected' : '' ?>><?= $categoria['nome_categoria'] ?></option>
                <?php endforeach; ?>
            </select>

            <input type="hidden" name="id" value="<?= $novaEntrada->id_entrada ?>">

            <button type="submit" class="bEntrar">Atualizar</button>
        </div>
    </form>
</section>
</body>

</html>