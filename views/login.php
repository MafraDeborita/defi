<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/defi/templates/_cabecalho.php';

?>


<div id="fundoMeio">
    <main class="conteudoCentro">
        <form action="/defi/controllers/login.php" method="post">
            <div class="login">
                <h1 class="txtLog"> Login</h1>
                <label for="email">E-mail</label>
                <input class="inputLogin" type="text" id="email" name="email" placeholder="Digite seu e-mail">
                <label for="senha">Senha</label>
                <input class="inputLogin" type="password" id="senha" name="senha" placeholder="Digite sua senha">
                <button class="bEntrar" type="submit">Entrar</button>
            </div>
        </form>

    </main>
</div>


<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/defi/templates/_rodape.php';

?>