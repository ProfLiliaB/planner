<?php
require_once "classes/Tarefa.php";

$id = isset($_GET['id']) ? $_GET['id'] : 0;
if ($id > 0) {
    $dados = Tarefa::readId($id);
    $checar = $dados['status_tarefa'] ? 'checked' : "";
} else {
    $dados = ['nome' => '', 'descricao' => '', 'status_tarefa' => 0];
    $checar = '';
}
?>
<form method="post" action="processa.php">
    <input type="hidden" name="id" value="<?=$id?>">
    <div>
        <label for="nome">Nome da Tarefa: </label>
        <input type="text" name="nome" id="nome" value="<?= $dados['nome'] ?>">
    </div>
    <div>
        <label for="descricao">Descricao: </label>
        <br>
        <textarea name="descricao" id="descricao" cols="30" rows="5"><?= $dados['descricao'] ?></textarea>
    </div>
    <div>
        <label for="status">Status:
            <input type="checkbox" name="status" id="status" value="<?= $dados['status_tarefa'] ?>" <?= $checar ?>>
        </label>
    </div>
    <div>
        <button type="submit">SALVAR</button>
    </div>
    <div>
        <?php echo $_GET['msg'] ?? ""; ?>
    </div>
</form>