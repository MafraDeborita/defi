<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="/defi/controllers/usuario_adicionar_controller.php" method="post" enctype="multipart/form-data">
        <label for="nome">Nome</label>
        <input type="text" name="nome" id="nome">

        <label for="email">Email</label>
        <input type="email" name="email" id="email">

        <label for="senha">Senha</label>
        <input type="password" name="senha" id="senha">

        <label for="foto">Foto</label>
        <input type="file" name="foto" id="foto">

        <input type="submit" value="Cadastrar">
    </form>
</body>
</html>