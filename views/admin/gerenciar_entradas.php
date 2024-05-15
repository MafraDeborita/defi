<?php
$tituloPagina = 'Entradas';
require_once $_SERVER['DOCUMENT_ROOT'] . '/smartcash/templates/_cabecalho.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/smartcash/models/entrada.php';

if (!isset($_SESSION['id_usuario'])) {
    $_SESSION['aviso'] = "Você precisa estar logado";
    header('Location: /smartcash/views/login.php');
}


try {
    $lista = Entrada::listar($_SESSION['id_usuario']);

    $dados_grafico = array();
    $dados_grafico[] = ['Categoria', 'Valor'];
    foreach ($lista as $entrada) {
        $dados_grafico[] = [$entrada['nome_categoria'], (float)$entrada['valor_entrada']];
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
            <a href="/smartcash/views/admin/adicionar_entrada_form.php" class="bEntrar">Adicionar</a>
        </div>

        <div class="row justify-content-between align-items-start">
            <div class="card-container col-md-6">
                <?php foreach ($lista as $e) : ?>
                    <div class="card">
                        R$ <?= $e['valor_entrada'] ?>
                        <h5><?= $e['nome_categoria'] ?></h5>
                        <a class="bEntrar" href="/smartcash/views/admin/editar_entrada_form.php?id=<?= $e['id_entrada'] ?>">Editar</a>
                        <a class="bEntrar" href="/smartcash/controllers/entrada_deletar_controller.php?id=<?= $e['id_entrada'] ?>">Deletar</a>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="col-md-5 grafico-container">
                <div id="myChart"></div>
            </div>
        </div>
    </div>



</section>

<script>
    google.charts.load('current', {
        packages: ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var dados = <?= $dados_grafico_json ?>; //inserindo o JSON gerado com PHP nessa variavel para manipular depois
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