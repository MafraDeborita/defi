<?php
$tituloPagina = 'Login';
require_once $_SERVER['DOCUMENT_ROOT'] . '/smartcash/templates/_cabecalho.php';

if (isset($_SESSION['id_usuario'])) {
    header('Location: /smartcash/views/perfil.php');
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

    <form action="/smartcash/controllers/login.php" method="post">
        <div class="login">
            <label for="email">E-mail</label>
            <input class="inputLogin" type="text" id="email" name="email" placeholder="Digite seu e-mail" required>
            <label for="senha">Senha</label>
            <input class="inputLogin" type="password" id="senha" name="senha" placeholder="Digite sua senha" required>

            <a href="/smartcash/views/registro.php">Registrar</a>

            <button class="bEntrar" type="submit">Entrar</button>
        </div>
    </form>
</section>


<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/smartcash/templates/_rodape.php';

?>