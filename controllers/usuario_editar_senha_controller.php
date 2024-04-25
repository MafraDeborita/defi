<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/defi/models/usuario.php';

session_start();

try {
    $senha = $_POST['senha'];
    $senha = password_hash($senha, PASSWORD_DEFAULT);

    $usuario = new Usuario($_SESSION['id_usuario']);
    $usuario->senha = $senha;
    

    $usuario->atualizarSenha();

    header('Location: /defi/views/perfil.php');

} catch (PDOException $e) {
    echo $e->getMessage();
}