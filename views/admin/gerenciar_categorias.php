<?php
$tituloPagina = 'Gerenciar Categorias';
require_once $_SERVER['DOCUMENT_ROOT'] . '/defi/templates/_cabecalho.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/defi/models/categoria.php';

if(!isset($_SESSION['id_usuario'])){
    $_SESSION['aviso'] = "Você precisa estar logado";
    header('Location: /defi/views/login.php');
}


try {
    $lista = Categoria::listar();
} catch (PDOException $e) {
    echo $e->getMessage();
}

?>


<section class="nav-right-cont">
    <div style="overflow-x: auto; width:100%">
        <table style="width:100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th colspan="2"><a href="/defi/views/admin/adicionar_categoria_form.php">Adicionar</a></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($lista as $c) : ?>
                    <tr>
                        <td><?= $c['id_categoria'] ?></td>
                        <td><?= $c['nome_categoria'] ?></td>
                        <td><a href="/defi/views/admin/editar_categoria_form.php?id=<?= $c['id_categoria'] ?>">Editar</a></td>
                        <td><a href="/defi/controllers/categoria_deletar_controller.php?id=<?= $c['id_categoria'] ?>">Deletar</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>


</body>

</html>