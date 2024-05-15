<?php
$tituloPagina = 'Adicionar Categoria';
require_once $_SERVER['DOCUMENT_ROOT'] . '/smartcash/templates/_cabecalho.php';

if(!isset($_SESSION['id_usuario'])){
    $_SESSION['aviso'] = "Você precisa estar logado";
    header('Location: /smartcash/views/login.php');
}


?>
<section class="nav-right-cont">

    <form action="/smartcash/controllers/categoria_adicionar_controller.php" method="post">
        <div class="login">
            <label for="nome">Nome da Categoria</label>
            <input type="text" class="inputLogin" id="nome" name="nome" placeholder="Nome da Categoria" required>

            <button class="bEntrar" type="submit">Cadastrar</button>
        </div>
    </form>

</section>
</body>

</html>