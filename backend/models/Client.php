<?php
require_once __DIR__ . '/../config/db.php';

class Client {
    private $conn;
    private $table = "clients";

    public $id;
    public $name;
    public $email;
    public $loan_amount;
    public $created_at;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    // new client
    public function create() {
        $query = "INSERT INTO " . $this->table . " (name, email, loan_amount) 
                  VALUES (:name, :email, :loan_amount)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":loan_amount", $this->loan_amount);
        return $stmt->execute();
    }

    
    public function readAll() {
        $query = "SELECT * FROM " . $this->table . " ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}
?>
