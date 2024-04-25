<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/defi/templates/_cabecalho.php';

?>



<main id="crp">
    <div id="dashbord"><strong> MENSAL ANUAL RECEITA DESPESA</strong></div>
    <div id="mardoce">
        <div class="card">

            <h2>RECEITAS</h2>
            <p>R$ 10.600</p>

        </div>

        <div class="card">

            <h2>DESPESAS</h2>
            <p>$ 7.400</p>

        </div>

        <div class="card">

            <h2>LUCRO/PREJUÍZO</h2>
            <p>R$ 3.200</p>

        </div>

        <div class="card">

            <h2>LUCRATIVIDADE</h2>
            <p>30.19%</p>

        </div>
    </div>




    <div id="grafi">
        <div id="myChart" style="width:1200px; max-width:1200px; height:600px;"></div>
    </div>

</main>

<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/defi/templates/_rodape.php';

?>