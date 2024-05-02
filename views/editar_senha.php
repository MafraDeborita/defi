<?php
$tituloPagina = 'Editar Senha';
require_once $_SERVER['DOCUMENT_ROOT'] . '/defi/templates/_cabecalho.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/defi/models/usuario.php';

if(!isset($_SESSION)){
    header('Location: /defi/views/login.php');
}

?>

<section class="nav-right-cont">
    <form action="/defi/controllers/usuario_editar_senha_controller.php" method="post">
        <div class="login">
            <label for="">Nova Senha</label>
            <input class="inputLogin" type="password" placeholder="Digite a nova senha" />

            <button class="bEntrar" type="submit">Atualizar</button>
        </div>
    </form>
</section>

</body>

</html>