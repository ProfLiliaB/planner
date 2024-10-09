<?php
include_once "conexao.php";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $status = $_POST['status']??0;

    $insert = $con->prepare('INSERT INTO tarefas (nome, descricao, status_tarefa) VALUES (:nome, :descricao, :stts)');
    $insert->bindParam('nome', $nome);
    $insert->bindParam('descricao', $descricao);
    $insert->bindParam('stts', $status);
    if($insert->execute()){
        header('location: index.php?msg=Cadastrado com sucesso!');
    } else {
        header('location: index.php?msg=Não foi possível cadastrar!');
    }
}