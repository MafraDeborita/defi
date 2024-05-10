<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/defi/configs/utilitarios.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/defi/configs/duracaoSessao.php';
session_start();
Sessao::duracao();
?>


<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Defi</title>
    <link rel="shortcut icon" href="/defi/imgs/logo.png" type="image/x-icon">

    <link rel="stylesheet" href="/defi/css/bootstrap.css">
    <link rel="stylesheet" href="/defi/css/style.css" />

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <script src="/defi/js/bootstrap.bundle.js" defer></script>
    <script src="https://www.gstatic.com/charts/loader.js"></script>


    <!-- <script src="/defi/js/script.js" defer></script> -->
</head>

<body>
    <div id="conteudo">
        <nav class="left">
            <div class="left-bar">
                <div class="logo">
                    <a href="/defi/index.php">
                        <img src="/defi/imgs/logo.png" alt="" class="logo-img" />
                        <span class="title-logo">Início</span>
                    </a>
                </div>
                <div class="left-buttons">
                    <?php if (isset($_SESSION['id_usuario'])) : ?>
                        <a href="/defi/views/admin/gerenciar_saidas.php">
                            <span class="material-symbols-outlined">mintmark</span>
                            <span>Gerenciar Saidas</span>
                        </a>
                        <a href="/defi/views/admin/gerenciar_entradas.php">
                            <span class="material-symbols-outlined">price_check</span>
                            <span>Gerenciar Entradas</span>
                        </a>
                        <a href="/defi/views/extrato.php">
                            <span class="material-symbols-outlined">account_balance</span>
                            <span>Extrato</span>
                        </a>
                        <!-- <a href="/defi/views/graficos.php">
                        <span class="material-symbols-outlined">pie_chart</span>
                        <span>Grafico</span>
                    </a> -->
                        <a href="/defi/views/editar_perfil.php">
                            <span class="material-symbols-outlined">account_circle</span>
                            <span>Editar Perfil</span>
                        </a>
                        <a href="/defi/views/editar_senha.php">
                            <span class="material-symbols-outlined">pin</span>
                            <span>Editar Senha</span>
                        </a>
                        <a href="/defi/views/admin/gerenciar_categorias.php">
                            <span class="material-symbols-outlined">category</span>
                            <span>Gerenciar Categorias</span>
                        </a>
                    <?php endif; ?>
                    <a href="/defi/views/educacao_financeira.php">
                        <span class="material-symbols-outlined">school</span>
                        <span>Educação Financeira</span>
                    </a>
                </div>
            </div>
        </nav>
        <nav id="right">
            <div class="right-bar">
                <div class="itens">
                    <h1><?= $tituloPagina ?></h1>
                    <div class="buttons-right">
                        <!-- <input type="search" class="form-control rounded" placeholder="Saldo, Extrato, DRE, etc ..." aria-label="Search" aria-describedby="search-addon" /> -->
                        <?php if (!isset($_SESSION['id_usuario'])) : ?>
                            <a class="login-btn" href="/defi/views/login.php" style="color: #8c52ff">Login</a>
                        <?php else : ?>
                            <img src="data:image;base64,<?= base64_encode($_SESSION['foto_usuario']) ?>" alt="" class="foto-perfil">
                            <a class="login-btn" href="/defi/controllers/logout.php" style="color: #8c52ff">Sair</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </nav>