<?php
require_once __DIR__ . "/../config/db.php";

class Category {
    private $conn;

    public function __construct() {
        // memanggil class database dan menyimpan koneksi ke variabel conn
        $database = new Database();
        $this->conn = $database->conn;
    }

    public function getAll() {
        // mengambil semua data kategori dari tabel category
        $query = $this->conn->prepare("SELECT * FROM category");
        $query->execute();
        return $query->get_result(); // mengembalikan hasil data
    }

    public function add($name) {
        // menambahkan data kategori baru berdasarkan input nama
        $query = $this->conn->prepare("INSERT INTO category (name) VALUES (?)");
        $query->bind_param("s", $name); // binding parameter string
        return $query->execute(); // menjalankan query insert
    }

    public function delete($id) {
        // menghapus kategori berdasarkan id
        $query = $this->conn->prepare("DELETE FROM category WHERE id = ?");
        $query->bind_param("i", $id); // binding parameter integer
        return $query->execute(); // menjalankan query delete
    }
    
    public function update($id, $name) {
        // mengedit data kategori berdasarkan id
        $query = $this->conn->prepare("UPDATE category SET name = ? WHERE id = ?");
        $query->bind_param("si", $name, $id); // binding parameter (string, integer)
        return $query->execute(); // menjalankan query update
    }

}
