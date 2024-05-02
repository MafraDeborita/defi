<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/defi/templates/_cabecalho.php';

?>
<div class="form">
    <form action="/defi/controllers/categoria_adicionar_controller.php" method="post">
        <div>
            <img src="" alt="">
        </div>

        <h1 class="h3">Cadastrar Categoria</h1>

        <div>
            <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome da Categoria">
            <!-- <label for="nome">Nome da Categoria</label> -->
        </div>

        <button class="bEntrar" type="submit">Cadastrar</button>
    </form>
</div>
</body>

</html>