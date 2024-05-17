<?php
$tituloPagina = 'Gráficos';
require_once $_SERVER['DOCUMENT_ROOT'] . '/smartcash/templates/_cabecalho.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/smartcash/models/grafico.php';

if (!isset($_SESSION['id_usuario'])) {
    header('Location: /smartcash/views/login.php');
}
try {
    $tblGrafico = Grafico::tblGrafico($_SESSION['id_usuario']);

    $dados_grafico = array();
    $dados_grafico[] = ['origem', 'valor'];

    foreach ($tblGrafico as $grafico) {
        $dados_grafico[] = [$grafico['origem'], (float)$grafico['valor']];
    }

    $dados_grafico_json = json_encode($dados_grafico);
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>


<section class="nav-right-cont">
    <div class="d-flex flex-column w-100">
        <div class="row justify-content-between align-items-start">
            <div class="card-container col-lg-6">
                <?php foreach ($tblGrafico as $grafico) : ?>
                    <div class="card">
                        <h2><?= $grafico['origem']  ?></h2>
                        <p><?= $grafico['valor'] ?></p>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="col-lg-6 my-3">
                <div id="myChart"></div>
            </div>
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
            title: 'Relação Receitas x Despesas',
            is3D: true,
            width: '100%', // Definir a largura como 100% para que o gráfico se ajuste automaticamente ao tamanho do contêiner
            height: '100%', // Definir a altura como 100% para que o gráfico se ajuste automaticamente ao tamanho do contêiner
            chartArea: { // Definir a área do gráfico para garantir que o gráfico se ajuste corretamente
                width: '80%',
                height: '80%'
            }
        };
        var chart = new google.visualization.PieChart(document.getElementById('myChart'));
        chart.draw(data, options);
    }
</script>


<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/smartcash/templates/_rodape.php';
?>