<?php
$tituloPagina = 'Saídas';
require_once $_SERVER['DOCUMENT_ROOT'] . '/smartcash/templates/_cabecalho.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/smartcash/models/saida.php';

if (!isset($_SESSION['id_usuario'])) {
    $_SESSION['aviso'] = "Você precisa estar logado";
    header('Location: /smartcash/views/login.php');
}


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
    <?php if (isset($_SESSION['aviso'])) : ?>
        <section>
            <div class="alert alert-danger text-center" role="alert">
                <?= $_SESSION['aviso'] ?>
                <?php unset($_SESSION['aviso']) ?>
            </div>
        </section>
    <?php endif; ?>
    
    <div class="d-flex flex-column">
        <div>
            <a href="/smartcash/views/admin/adicionar_saida_form.php" class="bEntrar">Adicionar</a>
        </div>


        <div class="row justify-content-between align-items-start">
            <div class="card-container col-md-6">
                <?php foreach ($lista as $s) : ?>
                    <div class="card">
                        R$ <?= $s['valor_saida'] ?>
                        <h5><?= $s['nome_categoria'] ?></h5>
                        <a class="bEntrar" href="/smartcash/views/admin/editar_saida_form.php?id=<?= $s['id_saida'] ?>">Editar</a>
                        <a class="bEntrar" href="/smartcash/controllers/saida_deletar_controller.php?id=<?= $s['id_saida'] ?>">Deletar</a>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="col-md-5 grafico-container">
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
            title: 'Minhas Saídas por Categoria',
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