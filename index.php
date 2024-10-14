<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planner</title>
</head>

<body>
    <header>
        <nav>
            <ul>
                <li>Home</li>
                <li>Novo</li>
            </ul>
        </nav>
    </header>
    <main>
        <?php
        require_once "classes/Tarefa.php";
        include_once "conexao.php";
        ?>
        <h1>Lista de tarefas</h1>

        <table>
            <tr>
                <th>Tarefa</th>
                <th>Descricao</th>
                <th>Status</th>
            </tr>
            <?php
            $select = Tarefa::read();
            foreach ($select as $result) {
                echo "<tr>";
                $id = $result["id"];
                $status = $result['status_tarefa'] ? "Concluída" : "A fazer";
                    echo "<td>" . $result['nome'] . "</td>";
                    echo "<td>" . $result['descricao'] . "</td>";
                    echo "<td>" . $status . "<a href='formulario.php?id=$id'>Editar</a></td>";
                echo "</tr>";
            }
            ?>
            <tr>
                <td colspan="3">
                    <?php echo $_GET['msg'] ?? ""; ?>
                </td>
            </tr>
        </table>
    </main>
</body>

</html>