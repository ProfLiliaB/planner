<?php
require_once "classes/Tarefa.php";
include_once "conexao.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = isset($_POST['id']) ? $_POST['id'] : null;
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $status = isset($_POST['status']) ? 1 : 0;
    $tarefa = new Tarefa($id, $nome, $descricao, $status);
    if ($id == null) {
        $tarefa->insert();
        if ($tarefa->getId()) {
            header('Location: index.php?msg=Cadastrado com sucesso!');
        } else {
            //header('Location: index.php?msg=Não foi possível cadastrar!');
        }
    } else {
        $tarefa->update();
        header('Location: index.php?msg=Alterado com sucesso!');
    }
}
