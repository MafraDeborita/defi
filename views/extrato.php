<?php
$tituloPagina = 'Extrato';
require_once $_SERVER['DOCUMENT_ROOT'] . '/defi/templates/_cabecalho.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/defi/models/usuario.php';

if (!isset($_SESSION['id_usuario'])) {
    $_SESSION['aviso'] = "Você precisa estar logado";
    header('Location: /defi/views/login.php');
}

try {
    $listaExtrato = Usuario::gerarExtrato($_SESSION['id_usuario']);

    $dados_grafico = [];
    $dados_grafico[] = ['Data', 'Saldo'];

    $saldo_total = 0;
    foreach ($listaExtrato as $registro) {
        $saldo_total += $registro['VALOR'];
        $dados_grafico[] = [$registro['DATA'], (float)$saldo_total];
    }

    $dados_grafico_json = json_encode($dados_grafico);
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

        <p>TOTAL: <?= $resultado ?></p>
    </div>

    <section class="grafico-container">
        <div id="myChart"></div>
    </section>
</section>

<script>
    google.charts.load('current', {
        packages: ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var dados = <?= $dados_grafico_json; ?>; //inserindo o JSON gerado com PHP nessa variavel para manipular depois
        var data = google.visualization.arrayToDataTable(dados);
        var options = {
            title: 'Saldo ao longo do tempo',
            is3D: true,
            width: 600,
            height: 400,
            hAxis: {
                title: 'Data'
            },
            vAxis: {
                title: 'Saldo'
            }
        };
        var chart = new google.visualization.LineChart(document.getElementById('myChart'));
        chart.draw(data, options);
    }
</script>

<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/defi/templates/_rodape.php';

?>