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

    // Array associativo para armazenar os valores acumulados por categoria
    $categorias_valores = array();

    // Iterar sobre a lista de entradas
    foreach ($lista as $entrada) {
        $categoria = $entrada['nome_categoria'];
        $valor = (float)$entrada['valor_entrada'];

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

    <div class="d-flex flex-column">
        <div>
            <a href="/smartcash/views/admin/adicionar_entrada_form.php" class="bEntrar">Adicionar</a>
        </div>

        <div class="row flex-lg-row flex-md-column justify-content-md-between justify-content-center align-items-start">
            <div class="card-container col-lg-6 col-md-12">
                <?php foreach ($lista as $e) : ?>
                    <div class="card">
                        <div class="txt-card">
                            R$ <?= $e['valor_entrada'] ?>
                            <h5><?= $e['nome_categoria'] ?></h5>
                        </div>

                        <div class="btn-card">
                            <a class="bEntrar" href="/smartcash/views/admin/editar_entrada_form.php?id=<?= $e['id_entrada'] ?>">Editar</a>
                            <a class="bEntrar" href="/smartcash/controllers/entrada_deletar_controller.php?id=<?= $e['id_entrada'] ?>">Deletar</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="col-lg-5 col-md-12">
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