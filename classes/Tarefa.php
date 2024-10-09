<?php
include_once "Database.php";

class Tarefa
{
    private ?int $id;
    private string $nome;
    private string $descricao;
    private ?int $status;
    private $con;

    public function __construct(?int $id = null, string $nome, string $descricao, int $status = 0)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->descricao = $descricao;
        $this->status = $status;
        $this->con->conectar();
    }

    public function insert(): void
    {
        $sql = "INSERT INTO tarefas (nome, descricao, status) VALUES (:nome, :descricao, :status)";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':descricao', $this->descricao);
        $stmt->bindParam(':status', $this->status);
        $stmt->execute();
        $this->id = $this->con->lastInsertId();
    }

    public function update(): void
    {
        if ($this->id !== null) {
            $sql = "UPDATE tarefas SET nome = :nome, descricao = :descricao, status = :status WHERE id = :id";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':nome', $this->nome);
            $stmt->bindParam(':descricao', $this->descricao);
            $stmt->bindParam(':status', $this->status);
            $stmt->execute();
        }
    }

    public function delete(): void
    {
        if ($this->id !== null) {
            $sql = "DELETE FROM tarefas WHERE id = :id";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':id', $this->id);
            $stmt->execute();
        }
    }

    public function read(): mixed 
    {
        $sql = "SELECT * FROM tarefas";
        $stmt = $this->con->prepare($sql);
        $stmt->execute();
        if ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
            return $result;
        }
        return null;
    }
    public function readId($id): mixed
    {
        if ($id !== null) {
            $sql = "SELECT * FROM tarefas WHERE id = :id";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':id', $this->id);
            $stmt->execute();
            if ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                return $result;
            }
            return null;
        }
        return null;
    }
}
