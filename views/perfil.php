<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <img src="data:image;base64,<?= base64_encode($_SESSION['foto_usuario']) ?>" alt="" width="100px">

    <p><?= $_SESSION['nome'] ?></p>

    <p><?= $_SESSION['email'] ?></p>

    <a href="/defi/views/editar_perfil.php">Editar Perfil</a>
    <a href="/defi/views/editar_senha.php">Editar Senha</a>
    <a href="/defi/views/admin/gerenciar_entradas.php">Gerenciar Entradas</a>
    <a href="/defi/views/admin/gerenciar_saidas.php">Gerenciar Saidas</a>
    <a href="/defi/views/admin/gerenciar_categorias.php">Gerenciar Categorias</a>
    <a href="/defi/controllers/logout.php">Sair</a>
</body>
</html>