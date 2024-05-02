<?php
$tituloPagina = 'Editar Senha';
require_once $_SERVER['DOCUMENT_ROOT'] . '/defi/templates/_cabecalho.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/defi/models/usuario.php';

?>

<section class="nav-right-cont">
    <form action="/defi/controllers/usuario_editar_senha_controller.php" method="post" enctype="multipart/form-data">
        <div class="login">
            <h1 class="txtLog">Editar senha</h1>
            <!-- <label for="email"> E-mail</label>
            <input class="inputLogin" type="text" placeholder="Digite seu email" /> -->
            <label for="">Nova Senha</label>
            <input class="inputLogin" type="password" placeholder="Digite a nova senha" />
            <!-- <input class="inputLogin" type="text" placeholder="Repita a nova senha" /> -->
            <button class="bEntrar" type="submit">Atualizar</button>
        </div>
    </form>
</section>

</body>

</html>