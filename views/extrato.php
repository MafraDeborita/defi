<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/defi/templates/_cabecalho.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/defi/models/usuario.php';

if(!isset($_SESSION['id_usuario'])){
    header('Location: /defi/views/login.php');
}

try {
    $listaExtrato = Usuario::gerarExtrato($_SESSION['id_usuario']);
} catch (PDOException $th) {
    echo $th->getMessage();
}

?>

<div id="fundoMeio">
    <main class="conteudoCentro">
        <div class="topoConteudo">
            <img class="imgExtrato" src="/defi/imgs/img_direita_grafico.png" alt="imagem extrato">
            <p class="topoConteudo2"> EXTRATO</p>

        </div>
        <?php foreach ($listaExtrato as $item) : ?>
            <div class="dadosConteudo">
                <p id=".data" class="dadosMain">Data: <?= $item['DATA'] ?></p>
                <p id="origem" class="dadosMain">Descrição: <?= $item['descricao'] ?></p>
                <p class="dadosMain">Valor: <?= $item['VALOR'] ?></p>
            </div>
        <?php endforeach; ?>
    </main>
</div>

<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/defi/templates/_rodape.php';

?>