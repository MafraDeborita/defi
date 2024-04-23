<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/defi/models/usuario.php';

try {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $senha = password_hash($senha, PASSWORD_DEFAULT);

    $foto = null;

    $usuario = new Usuario();
    $usuario->nome = $nome;
    $usuario->email = $email;
    $usuario->senha = $senha;
    $usuario->foto_usuario = $foto;

    $usuario->criar();

    header('Location: /defi/views/login.php');

} catch (PDOException $e) {
    echo $e->getMessage();
}