<?php
include_once "conexao.php";
$id = isset($_GET['id']) ? $_GET['id'] : 0;
$select = $con->prepare('SELECT * FROM tarefas WHERE id = ?');
$select->execute([$id]);
$dados = $select->fetch();
$checar = $dados['status_tarefa']?'checked':"";
?>
<form method="post">
    <div>
        <label for="nome">Nome da Tarefa: </label>
        <input type="text" name="nome" id="nome" value="<?=$dados['nome']?>">
    </div>
    <div>
        <label for="descricao">Descricao: </label>
        <br>
        <textarea name="descricao" id="descricao" cols="30" rows="5"><?=$dados['descricao']?></textarea>
    </div>
    <div>
        <label for="status">Status:
            <input type="checkbox" name="status" id="status" 
            value="<?=$dados['status_tarefa']?>" <?=$checar?>>
        </label>
    </div>
    <div>
        <button type="submit">Aletar</button>
    </div>
</form>
<?php
if ($id < 1) {
    header('location: index.php');
} else {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nome = $_POST['nome'];
        $descricao = $_POST['descricao'];
        $status = $_POST['status'] ?? 0;

        $update = $con->prepare("UPDATE tarefas SET 
        nome = :nome,
        descricao = :descricao,
        status_tarefa = :stts 
        WHERE id = :id");

        $update->bindParam('nome', $nome);
        $update->bindParam('descricao', $descricao);
        $update->bindParam('stts', $status);
        $update->bindParam('id', $id);
        if ($update->execute()) {
            header('location: index.php?msg=Alterado com sucesso!');
        } else {
            header('location: index.php?msg=Não foi possível alterar!');
        }
    }
}
