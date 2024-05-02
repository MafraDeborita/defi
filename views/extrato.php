<?php
$tituloPagina = 'Extrato';
require_once $_SERVER['DOCUMENT_ROOT'] . '/defi/templates/_cabecalho.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/defi/models/usuario.php';

if (!isset($_SESSION['id_usuario'])) {
    header('Location: /defi/views/login.php');
}

try {
    $listaExtrato = Usuario::gerarExtrato($_SESSION['id_usuario']);
} catch (PDOException $th) {
    echo $th->getMessage();
}

$resultado = 0;

foreach ($listaExtrato as $item) {
    $resultado += $item['VALOR'];
}

$_SESSION['extrato'] = $listaExtrato;
$_SESSION['resultado'] = $resultado;

?>

<section class="nav-right-cont">

    <div class="conteudoCentro">

        <div class="botao-relatorio-container">
            <button class="bEntrar"><a href="/defi/controllers/gerar_relatorio_controller.php" target="_blank">Gerar Relatório</a></button>
        </div>


        <?php foreach ($listaExtrato as $item) : ?>
            <div class="dadosConteudo">
                <p class="dadosMain">Data: <?= date('d/m/Y', strtotime($item['DATA']))  ?></p>
                <p class="dadosMain">Descrição: <?= $item['descricao'] ?></p>
                <p class="dadosMain">Valor: <?= $item['VALOR'] ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/defi/templates/_rodape.php';

?>