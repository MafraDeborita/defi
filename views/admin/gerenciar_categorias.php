<?php
$tituloPagina = 'Gerenciar Categorias';
require_once $_SERVER['DOCUMENT_ROOT'] . '/smartcash/templates/_cabecalho.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/smartcash/models/categoria.php';

if(!isset($_SESSION['id_usuario'])){
    $_SESSION['aviso'] = "Você precisa estar logado";
    header('Location: /smartcash/views/login.php');
}


try {
    $lista = Categoria::listar();
} catch (PDOException $e) {
    echo $e->getMessage();
}

?>


<section class="nav-right-cont">
    <?php if (isset($_SESSION['aviso'])) : ?>
        <section>
            <div class="alert alert-danger text-center" role="alert">
                <?= $_SESSION['aviso'] ?>
                <?php unset($_SESSION['aviso']) ?>
            </div>
        </section>
    <?php endif; ?>
    
    <div style="overflow-x: auto; width:100%">
        <table style="width:100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th colspan="2"><a href="/smartcash/views/admin/adicionar_categoria_form.php">Adicionar</a></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($lista as $c) : ?>
                    <tr>
                        <td><?= $c['id_categoria'] ?></td>
                        <td><?= $c['nome_categoria'] ?></td>
                        <td><a href="/smartcash/views/admin/editar_categoria_form.php?id=<?= $c['id_categoria'] ?>">Editar</a></td>
                        <td><a href="/smartcash/controllers/categoria_deletar_controller.php?id=<?= $c['id_categoria'] ?>">Deletar</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>


</body>

</html>