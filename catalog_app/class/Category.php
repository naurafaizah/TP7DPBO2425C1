<?php
require_once __DIR__ . "/../config/db.php";

class Category {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->conn;
    }

    public function getAll() {
        $query = $this->conn->prepare("SELECT * FROM category");
        $query->execute();
        return $query->get_result();
    }

    public function add($name) {
        $query = $this->conn->prepare("INSERT INTO category (name) VALUES (?)");
        $query->bind_param("s", $name);
        return $query->execute();
    }

    public function delete($id) {
        $query = $this->conn->prepare("DELETE FROM category WHERE id = ?");
        $query->bind_param("i", $id);
        return $query->execute();
    }
    
    public function update($id, $name) {
        $query = $this->conn->prepare("UPDATE category SET name = ? WHERE id = ?");
        $query->bind_param("si", $name, $id);
        return $query->execute();
    }

}
