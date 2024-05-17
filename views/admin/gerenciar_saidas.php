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

    // Array associativo para armazenar os valores acumulados por categoria
    $categorias_valores = array();

    // Iterar sobre a lista de entradas
    foreach ($lista as $saida) {
        $categoria = $saida['nome_categoria'];
        $valor = (float)$saida['valor_saida'];

        // Se a categoria já estiver no array, acumular o valor
        if (isset($categorias_valores[$categoria])) {
            $categorias_valores[$categoria] += $valor;
        } else {
            // Se não, criar uma nova entrada no array
            $categorias_valores[$categoria] = $valor;
        }
    }

    // Converter os dados acumulados em um formato adequado para o gráfico
    $dados_grafico = array();
    $dados_grafico[] = ['Categoria', 'Valor'];
    foreach ($categorias_valores as $categoria => $valor) {
        $dados_grafico[] = [$categoria, $valor];
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

    <div class="d-flex flex-column w-100">
        <div>
            <a href="/smartcash/views/admin/adicionar_saida_form.php" class="bEntrar">Adicionar</a>
        </div>


        <div class="row">
            <div class="card-container col-lg-6 align-content-start">
                <?php foreach ($lista as $s) : ?>
                    <div class="card">
                        <div class="txt-card">
                            R$ <?= $s['valor_saida'] ?>
                            <h5><?= $s['nome_categoria'] ?></h5>
                        </div>

                        <div class="btn-card">
                            <a class="bEntrar" href="/smartcash/views/admin/editar_saida_form.php?id=<?= $s['id_saida'] ?>">Editar</a>
                            <a class="bEntrar" href="/smartcash/controllers/saida_deletar_controller.php?id=<?= $s['id_saida'] ?>">Deletar</a>
                        </div>
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
            title: 'Minhas Saídas por Categoria',
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



</body>

</html>