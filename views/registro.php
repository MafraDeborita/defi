<?php
$tituloPagina = 'Cadastro';
require_once $_SERVER['DOCUMENT_ROOT'] . '/smartcash/templates/_cabecalho.php';

if(isset($_SESSION['id_usuario'])){
    header('Location: /smartcash/views/perfil.php');
}

?>


<section class="nav-right-cont">
    <form action="/smartcash/controllers/usuario_adicionar_controller.php" method="post" enctype="multipart/form-data">
        <div class="input-group">
            <div class="input-box">
                <label for="nome">Nome</label>
                <input type="texto" name="nome" id="nome" placeholder="Nome Completo" required>
            </div>

            <div class="input-box">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="exemplo@mail.com" required>
            </div>

            <div class="input-box">
                <label for="password">Senha</label>
                <input type="password" name="senha" id="password" placeholder="Digite Sua Senha" required>
            </div>

            <div class="input-box">
                <label for="foto">Foto</label>
                <input type="file" name="foto" id="foto">
            </div>
        </div>

        <div class="continue-botton">
            <button class="bEntrar" type="submit">Continuar</button>
        </div>

    </form>
</section>



<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/smartcash/templates/_rodape.php';
?>