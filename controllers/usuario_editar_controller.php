<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/defi/models/usuario.php';

session_start();

try {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];

    if(isset($_POST['senha'])){
        $senha = $_POST['senha'];
        $senha = password_hash($senha, PASSWORD_DEFAULT);
    }

    if(!empty($_FILES['foto']['tmp_name'])){
        $foto = file_get_contents($_FILES['foto']['tmp_name']);
    }

    $usuario = new Usuario($id);
    $usuario->nome = $nome;
    $usuario->email = $email;
    if($senha){
        $usuario->senha = $senha;
    } else {
        $usuario->senha = $usuario->senha;
    }
    
    if($foto){
        $usuario->foto_usuario = $foto;
    } else {
        $usuario->foto_usuario = $usuario->foto_usuario;
    }

    $usuario->atualizar();

    $_SESSION['nome'] = $nome;
    $_SESSION['email'] = $email;
    $_SESSION['foto_usuario'] = $foto;

    header('Location: /defi/views/perfil.php');

} catch (PDOException $e) {
    echo $e->getMessage();
}