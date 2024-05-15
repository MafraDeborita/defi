<?php
$tituloPagina = 'Editar Senha';
require_once $_SERVER['DOCUMENT_ROOT'] . '/smartcash/templates/_cabecalho.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/smartcash/models/usuario.php';

if(!isset($_SESSION)){
    $_SESSION['aviso'] = "Você precisa estar logado";
    header('Location: /smartcash/views/login.php');
}

?>

<section class="nav-right-cont">
    <form action="/smartcash/controllers/usuario_editar_senha_controller.php" method="post">
        <div class="login">
            <label for="">Nova Senha</label>
            <input class="inputLogin" type="password" placeholder="Digite a nova senha" />

            <button class="bEntrar" type="submit">Atualizar</button>
        </div>
    </form>
</section>

</body>

</html>