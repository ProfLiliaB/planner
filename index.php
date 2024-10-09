<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planner</title>
</head>
<body>
    <?php include_once "conexao.php"; ?>
    <h1>Lista de tarefas</h1>
    <div>
        <form action="processar.php" method="post">
            <div>
                <label for="nome">Nome da Tarefa: </label>
                <input type="text" name="nome" id="nome">
            </div>
            <div>
                <label for="descricao">Descricao: </label>
                <br>
                <textarea name="descricao" id="descricao" cols="30" rows="5"></textarea>
            </div>
            <div>
                <label for="status">Status: 
                    <input type="checkbox" name="status" id="status" value="1">
                </label>
            </div>
            <div>
                <button type="submit">Cadastrar</button>
            </div>
            <div>
                <?php 
                echo $_GET['msg']??"";
                ?>
            </div>
        </form>
    </div>
    <hr>
    <?php 
    $select = $con->query("SELECT * FROM tarefas");
    while($result = $select->fetch()){
        $id = $result["id"];
        $status = $result['status_tarefa']?"Tarefa Concluída":"Tarefa a fazer";
        echo "<div>".$result['nome'].": ".$result['descricao']." - ".$status."<a href='editar.php?id=$id'>Editar</a></div>";
    }
    ?>
</body>
</html>