<?php
class Database {
    private string $host = "localhost";
    private string $db = "planner";
    private string $user = "root";
    private string $pass = "";
    private ?PDO $con = null;

    public function __construct() {
        try {
            $this->con = new PDO("mysql:host={$this->host};dbname={$this->db}", $this->user, $this->pass);
            $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->con->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Conexao falhou: " . $e->getMessage();
        }
    }

    public function conectar(): ?PDO {
        return $this->con;
    }
}
?>