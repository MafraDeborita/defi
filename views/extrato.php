<?php
$tituloPagina = 'Extrato';
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

<section class="nav-right-cont">
    <main class="conteudoCentro">
        <?php foreach ($listaExtrato as $item) : ?>
            <div class="dadosConteudo">
                <p class="dadosMain">Data: <?= $item['DATA'] ?></p>
                <p class="dadosMain">Descrição: <?= $item['descricao'] ?></p>
                <p class="dadosMain">Valor: <?= $item['VALOR'] ?></p>
            </div>
        <?php endforeach; ?>
    </main>
</section>

<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/defi/templates/_rodape.php';

?>