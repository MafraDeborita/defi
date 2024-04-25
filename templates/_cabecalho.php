<?php

session_start()

?>


<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pi</title>
    <link rel="stylesheet" href="/defi/css/style.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous" />
    <script src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="/defi/js/script.js" defer></script>
</head>

<body>
    <div id="conteudo">
        <nav class="left">
            <div class="left-bar">
                <div class="logo">
                    <a href="/defi/index.php">
                        <img src="/defi/imgs/logo.png" alt="" />
                        <span class="title-logo">Início</span>
                    </a>
                </div>
                <div class="left-buttons">
                    <a href="#">
                        <img src="/defi/imgs/img_contas_pagar.png" alt="" />
                        <span>Contas a pagar</span>
                    </a>
                    <a href="#">
                        <img src="/defi/imgs/img_contas_receber.png" alt="" />
                        <span>Contas a receber</span>
                    </a>
                    <a href="#">
                        <img src="/defi/imgs/Img_pessoa.png" alt="" />
                        <span>Clientes</span>
                    </a>
                    <a href="#">
                        <img src="/defi/imgs/Img_pessoa.png" alt="" />
                        <span>Fornecedor</span>
                    </a>
                    <a href="/defi/views/educacao_financeira.php">
                        <img src="/defi/imgs/img_mensagens.png" alt="" />
                        <span>Educação Financeira</span>
                    </a>
                </div>
            </div>
        </nav>
        <nav id="right">
            <div class="right-bar">
                <div class="itens">
                    <h1>Home</h1>
                    <div class="buttons-right">
                        <input type="search" class="form-control rounded" placeholder="Saldo, Extrato, DRE, etc ..." aria-label="Search" aria-describedby="search-addon" />
                        <?php if (!isset($_SESSION['id_usuario'])) : ?>
                            <a class="login" href="/defi/views/login.php" style="color: #8c52ff">Login</a>
                        <?php else : ?>
                            <a class="login" href="/defi/controllers/logout.php" style="color: #8c52ff">Sair</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </nav>