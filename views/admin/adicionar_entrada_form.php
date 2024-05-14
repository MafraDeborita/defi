<?php
$tituloPagina = 'Adicionar Entrada';
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
    <form action="/defi/controllers/entrada_adicionar_controller.php" method="post">
        <div class="login">
            <label for="valor">Valor</label>
            <input type="number" class="inputLogin" name="valor" id="valor" min="0" required>

            <label for="descricao">Descrição</label>
            <textarea name="descricao" id="descricao" cols="30" rows="10"></textarea>

            <label for="data">Data</label>
            <input type="date" class="inputLogin" name="data" id="data" required>

            <label for="categoria">Categoria</label>
            <select name="categoria" id="categoria" class="inputLogin">
                <?php foreach ($lista as $c) : ?>
                    <option value="<?= $c['id_categoria'] ?>"><?= $c['nome_categoria'] ?></option>
                <?php endforeach; ?>
            </select>

            <button type="submit" class="bEntrar">Cadastrar</button>
        </div>
    </form>
</section>

</body>

</html>