<?php
require_once __DIR__ . "/../config/db.php";

class User {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->conn;
    }

    public function getAll() {
        $query = $this->conn->prepare("SELECT * FROM user");
        $query->execute();
        return $query->get_result();
    }

    public function add($name) {
        $query = $this->conn->prepare("INSERT INTO user (name) VALUES (?)");
        $query->bind_param("s", $name);
        return $query->execute();
    }

    public function delete($id) {
        $query = $this->conn->prepare("DELETE FROM user WHERE id = ?");
        $query->bind_param("i", $id);
        return $query->execute();
    }

    public function update($id, $name) {
        $query = $this->conn->prepare("UPDATE user SET name = ? WHERE id = ?");
        $query->bind_param("si", $name, $id);
        return $query->execute();
    }

}
