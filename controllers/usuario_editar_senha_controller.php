<?php

session_start();
if(!isset($_SESSION['id_usuario'])){
    header('Location: /smartcash/views/login.php');
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/smartcash/models/usuario.php';


try {
    $senha = $_POST['senha'];
    $senha = password_hash($senha, PASSWORD_DEFAULT);

    $usuario = new Usuario($_SESSION['id_usuario']);
    $usuario->senha = $senha;
    

    $usuario->atualizarSenha();

    header('Location: /smartcash/index.php');

} catch (PDOException $e) {
    echo $e->getMessage();
}