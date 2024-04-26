<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/defi/templates/_cabecalho.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/defi/models/entrada.php';

try {
    $lista = Entrada::listar($_SESSION['id_usuario']);

    $dados_grafico = array();
    $dados_grafico[] = ['Categoria', 'Valor'];
    foreach ($lista as $entrada) {
        $dados_grafico[] = [$entrada['nome_categoria'], (float)$entrada['valor_entrada']];
    }
//  Util::vardump_formatado($dados_grafico);
    $dados_grafico_json = json_encode($dados_grafico);
//  Util::vardump_formatado($dados_grafico_json);
} catch (PDOException $e) {
    echo $e->getMessage();
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <a href="/defi/views/admin/adicionar_entrada_form.php">Adicionar</a>
    <section class="row">
        <div class="col-md-6">
            <ul>
                <?php foreach ($lista as $e) : ?>
                    <li><?= $e['descricao'] ?></li>
                    <li><?= $e['valor_entrada'] ?></li>
                    <li><?= $e['nome_categoria'] ?></li>
                    <ul>
                        <li><a href="/defi/views/admin/editar_entrada_form.php?id=<?= $e['id_entrada'] ?>">Editar</a></li>
                        <li><a href="/defi/controllers/entrada_deletar_controller.php?id=<?= $e['id_entrada'] ?>">Deletar</a></li>
                    </ul>
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="col-md-6">
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