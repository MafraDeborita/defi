<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projeto Integrador</title>

    <link rel="stylesheet" href="css/style.css">
    <script src="js/script.js" defer></script>


</head>

<body>
    <?= $_SESSION['email'] ?>
    <a href="/defi/controllers/logout.php">Sair</a>
    <header>
        <nav>

        </nav>
    </header>

    <main>
        <section>

        </section>
    </main>

    <footer>

    </footer>
</body>

</html>