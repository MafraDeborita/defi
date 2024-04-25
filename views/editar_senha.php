<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/defi/models/usuario.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="/defi/controllers/usuario_editar_senha_controller.php" method="post" enctype="multipart/form-data">
        <label for="senha">Senha Nova</label>
        <input type="password" name="senha" id="senha">

        <input type="submit" value="Atualizar">
    </form>
</body>
</html>