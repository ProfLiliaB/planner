<?php
include_once "Database.php";

class Tarefa
{
    private ?int $id;
    private string $nome;
    private string $descricao;
    private ?int $status;
    private static $conn;
    public ?Database $database;
    
    public function __construct(?int $id = null, string $nome = '', string $descricao = '', int $status = 0)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->descricao = $descricao;
        $this->status = $status;
        $database = new Database();        
        self::$conn = $database->conectar();
    }

    public function getId(): ?int {
        return $this->id;
    }
    
    public function insert(): void
    {
        $sql = "INSERT INTO tarefas (nome, descricao, status_tarefa) VALUES (:nome, :descricao, :status)";
        $stmt = self::$conn->prepare($sql);
        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':descricao', $this->descricao);
        $stmt->bindParam(':status', $this->status);
        $stmt->execute();
        $this->id = self::$conn->lastInsertId();
    }

    public function update(): void
    {
        if ($this->id !== null) {
            $sql = "UPDATE tarefas SET nome = :nome, descricao = :descricao, status_tarefa = :status WHERE id = :id";
            $stmt = self::$conn->prepare($sql);
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
            $stmt = self::$conn->prepare($sql);
            $stmt->bindParam(':id', $this->id);
            $stmt->execute();
        }
    }

    public static function read(): mixed 
    {
        $database = new Database();        
        self::$conn = $database->conectar();
        $sql = "SELECT * FROM tarefas";
        $stmt = self::$conn->prepare($sql);
        $stmt->execute();
        if ($result = $stmt->fetchAll(PDO::FETCH_ASSOC)) {
            return $result;
        }
        return null;
    }
    
    public static function readId(int $id): mixed {
        $database = new Database();        
        self::$conn = $database->conectar();
        $sql = "SELECT * FROM tarefas WHERE id = :id";
        $stmt = self::$conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
