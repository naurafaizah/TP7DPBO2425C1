<?php
require_once __DIR__ . "/../config/db.php";

class Product {
    private $conn;

    public function __construct() {
        // memanggil class database dan menyimpan koneksi ke variabel conn
        $database = new Database();
        $this->conn = $database->conn;
    }

    public function getAll() {
        // mengambil semua data produk beserta nama kategori dan nama user yang menambahkan
        $query = $this->conn->prepare("
            SELECT product.*, category.name AS category_name, user.name AS user_name
            FROM product
            JOIN category ON product.category_id = category.id
            JOIN user ON product.user_id = user.id
        ");
        $query->execute();
        return $query->get_result(); // mengembalikan hasil data produk
    }

    public function add($name, $price, $category_id, $user_id) {
        // menambahkan produk baru dengan nama, harga, kategori, dan user yang terkait
        $query = $this->conn->prepare("
            INSERT INTO product (name, price, category_id, user_id)
            VALUES (?, ?, ?, ?)
        ");
        // binding: s = string, d = double, i = integer
        $query->bind_param("sdii", $name, $price, $category_id, $user_id);
        return $query->execute(); // menjalankan query insert
    }

    // update data produk
    public function update($id, $name, $price, $category_id, $user_id) {
        // memperbarui data produk berdasarkan id
        $query = $this->conn->prepare("
            UPDATE product 
            SET name = ?, price = ?, category_id = ?, user_id = ?
            WHERE id = ?
        ");
        $query->bind_param("sdiii", $name, $price, $category_id, $user_id, $id);
        return $query->execute(); // menjalankan query update
    }

    public function delete($id) {
        // menghapus produk berdasarkan id
        $query = $this->conn->prepare("DELETE FROM product WHERE id = ?");
        $query->bind_param("i", $id); // binding parameter integer
        return $query->execute(); // menjalankan query delete
    }
}
