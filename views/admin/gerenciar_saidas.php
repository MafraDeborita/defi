<?php
$tituloPagina = 'Saídas';
require_once $_SERVER['DOCUMENT_ROOT'] . '/defi/templates/_cabecalho.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/defi/models/saida.php';

try {
    $lista = Saida::listar($_SESSION['id_usuario']);

    $dados_grafico = array();
    $dados_grafico[] = ['Categoria', 'Valor'];
    foreach ($lista as $saida) {
        $dados_grafico[] = [$saida['nome_categoria'], (float)$saida['valor_saida']];
    }

    $dados_grafico_json = json_encode($dados_grafico);
} catch (PDOException $e) {
    echo $e->getMessage();
}

?>

<section class="nav-right-cont">
    <a href="/defi/views/admin/adicionar_saida_form.php" class="bEntrar">Adicionar</a>

    <div class="card-container">
        <?php foreach ($lista as $s) : ?>
            <div class="card">
                <?= $s['valor_saida'] ?>
                <h1><?= $s['nome_categoria'] ?></h1>
                <a class="bEntrar" href="/defi/views/admin/editar_saida_form.php?id=<?= $s['id_saida'] ?>">Editar</a>
                <a class="bEntrar" href="/defi/controllers/saida_deletar_controller.php?id=<?= $s['id_saida'] ?>">Deletar</a>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="col-md-5">
        <div id="myChart"></div>
    </div>
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
            title: 'Minhas Entradas por Categoria',
            is3D: true,
            width: 600,
            height: 400
        };
        var chart = new google.visualization.PieChart(document.getElementById('myChart'));
        chart.draw(data, options);
    }
</script>



</body>

</html>