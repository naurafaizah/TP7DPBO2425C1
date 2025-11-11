<?php
require_once __DIR__ . "/../config/db.php";

class Product {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->conn;
    }

    public function getAll() {
        $query = $this->conn->prepare("
            SELECT product.*, category.name AS category_name, user.name AS user_name
            FROM product
            JOIN category ON product.category_id = category.id
            JOIN user ON product.user_id = user.id
        ");
        $query->execute();
        return $query->get_result();
    }

    public function add($name, $price, $category_id, $user_id) {
        $query = $this->conn->prepare("
            INSERT INTO product (name, price, category_id, user_id)
            VALUES (?, ?, ?, ?)
        ");
        $query->bind_param("sdii", $name, $price, $category_id, $user_id);
        return $query->execute();
    }

    // update data produk
    public function update($id, $name, $price, $category_id, $user_id) {
        $query = $this->conn->prepare("
            UPDATE product 
            SET name = ?, price = ?, category_id = ?, user_id = ?
            WHERE id = ?
        ");
        $query->bind_param("sdiii", $name, $price, $category_id, $user_id, $id);
        return $query->execute();
    }

    public function delete($id) {
        $query = $this->conn->prepare("DELETE FROM product WHERE id = ?");
        $query->bind_param("i", $id);
        return $query->execute();
    }
}
