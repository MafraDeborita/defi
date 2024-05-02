<?php
$tituloPagina = 'Editar Perfil';
require_once $_SERVER['DOCUMENT_ROOT'] . '/defi/templates/_cabecalho.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/defi/models/usuario.php';

if(!isset($_SESSION)){
    header('Location: /defi/views/login.php');
}

try {
    $usuario = new Usuario($_SESSION['id_usuario']);
} catch (PDOException $e) {
    echo $e->getMessage();
}


?>
<section class="nav-right-cont">
    <main class="conteudoCentro">

        <form action="/defi/controllers/usuario_editar_controller.php" method="post" enctype="multipart/form-data">
            <div class="login">
                <h1 class="txtLog"> Editar perfil</h1>
                <label for=""> Nome</label>
                <input class="inputLogin" type="text" name="nome" placeholder="Digite seu nome" value="<?= $usuario->nome ?>">
                <label for="email"> E-mail</label>
                <input class="inputLogin" type="email" name="email" placeholder="Digite seu email" value="<?= $usuario->email ?>">
                <input class="inputFoto" type="file" name="foto" placeholder="teste">

                <input type="hidden" name="id" value="<?= $usuario->id_usuario ?>">

                <button class="bEntrar" type="submit"> Atualizar</button>
            </div>
        </form>

    </main>
</section>

</body>

</html>