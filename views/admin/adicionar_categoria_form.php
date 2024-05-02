<?php
$tituloPagina = 'Adicionar Categoria';
require_once $_SERVER['DOCUMENT_ROOT'] . '/defi/templates/_cabecalho.php';

if(!isset($_SESSION['id_usuario'])){
    header('Location: /defi/views/login.php');
}


?>
<section class="nav-right-cont">

    <form action="/defi/controllers/categoria_adicionar_controller.php" method="post">
        <div class="login">
            <label for="nome">Nome da Categoria</label>
            <input type="text" class="inputLogin" id="nome" name="nome" placeholder="Nome da Categoria">

            <button class="bEntrar" type="submit">Cadastrar</button>
        </div>
    </form>

</section>
</body>

</html>