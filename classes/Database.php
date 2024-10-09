<?php
class Database {
    private string $host = "localhost";
    private string $db = "planner";
    private string $user = "root";
    private string $pass = "";
    private $con;

    public function __construct() {
        try {
            $this->con = new PDO("mysql:host={$this->host};dbname={$this->db}", $this->user, $this->pass);
            $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
    public function conectar() {
        return $this->con;
    }
}