<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/smartcash/models/usuario.php';

try {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $senha = password_hash($senha, PASSWORD_DEFAULT);

    if(!empty($_FILES['foto']['tmp_name'])){
        $foto = file_get_contents($_FILES['foto']['tmp_name']);
    }

    $usuario = new Usuario();
    $usuario->nome = $nome;
    $usuario->email = $email;
    $usuario->senha = $senha;
    
    if($foto){
        $usuario->foto_usuario = $foto;
    } else {
        $usuario->foto_usuario = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/smartcash/imgs/dummy_usuario.png');
    }
    

    $usuario->criar();

    header('Location: /smartcash/views/login.php');

} catch (PDOException $e) {
    echo $e->getMessage();
}