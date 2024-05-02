<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/defi/templates/_cabecalho.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/defi/models/categoria.php';

try {
    $id = $_GET['id'];

    $categoria = new Categoria($id);
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>

<div class="form">
    <form action="/defi/controllers/categoria_editar_controller.php" method="post">
        <div>
            <img src="" alt="">
        </div>

        <h1 class="h3">Editar Categoria</h1>

        <div>
            <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome da Categoria" value="<?= $categoria->nome_categoria ?>">
            <!-- <label for="nome">Nome da Categoria</label> -->
        </div>

        <input type="hidden" name="id" value="<?= $categoria->id_categoria ?>">

        <button class="bEntrar" type="submit">Atualizar</button>
    </form>
</div>
</body>

</html>