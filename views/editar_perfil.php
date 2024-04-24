<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/defi/models/usuario.php';
session_start();
$usuario = new Usuario($_SESSION['id_usuario']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="/defi/controllers/usuario_editar_controller.php" method="post" enctype="multipart/form-data">
        <label for="nome">Nome</label>
        <input type="text" name="nome" id="nome" value="<?= $usuario->nome ?>">

        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="<?= $usuario->email ?>">

        <label for="senha">Senha</label>
        <input type="password" name="senha" id="senha">

        <label for="foto">Foto</label>
        <input type="file" name="foto" id="foto">

        <input type="hidden" name="id" value="<?= $usuario->id_usuario ?>">

        <input type="submit" value="Atualizar">
    </form>
</body>
</html>