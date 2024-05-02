<?php

session_start();
if(!isset($_SESSION['id_usuario'])){
    header('Location: /defi/views/login.php');
}


require_once $_SERVER['DOCUMENT_ROOT'] . '/defi/models/usuario.php';

try {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];

    if(!empty($_FILES['foto']['tmp_name'])){
        $foto = file_get_contents($_FILES['foto']['tmp_name']);
    }

    $usuario = new Usuario($id);
    $usuario->nome = $nome;
    $usuario->email = $email;
    
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