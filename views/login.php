<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="/defi/controllers/login.php" method="post">
        <label for="email">Email</label>
        <input type="email" name="email" id="email">

        <label for="senha">Senha</label>
        <input type="password" name="senha" id="senha">

        <a href="/defi/views/registro.php">Registre-se</a>

        <input type="submit" value="login">
    </form>
</body>
</html>