<?php
$tituloPagina = 'Editar Categoria';
require_once $_SERVER['DOCUMENT_ROOT'] . '/defi/templates/_cabecalho.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/defi/models/categoria.php';

if(!isset($_SESSION['id_usuario'])){
    $_SESSION['aviso'] = "Você precisa estar logado";
    header('Location: /defi/views/login.php');
}


try {
    $id = $_GET['id'];

    $categoria = new Categoria($id);
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>

<section class="nav-right-cont">
    <form action="/defi/controllers/categoria_editar_controller.php" method="post">
        <div class="login">
            <input type="text" class="inputLogin" id="nome" name="nome" placeholder="Nome da Categoria" value="<?= $categoria->nome_categoria ?>">


            <input type="hidden" name="id" value="<?= $categoria->id_categoria ?>">

            <button class="bEntrar" type="submit">Atualizar</button>
        </div>
    </form>
</section>
</body>

</html>