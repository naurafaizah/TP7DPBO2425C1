<?php
require_once __DIR__ . "/../config/db.php";

class User {
    private $conn;

    public function __construct() {
        // memanggil class database dan mengambil koneksi yang sudah dibuat
        $database = new Database();
        $this->conn = $database->conn;
    }

    public function getAll() {
        // mengambil semua data user dari tabel user
        $query = $this->conn->prepare("SELECT * FROM user");
        $query->execute();
        return $query->get_result(); // mengembalikan hasil data
    }

    public function add($name) {
        // menambahkan user baru ke tabel user
        $query = $this->conn->prepare("INSERT INTO user (name) VALUES (?)");
        $query->bind_param("s", $name); // s = string
        return $query->execute(); // menjalankan query
    }

    public function delete($id) {
        // menghapus user berdasarkan id
        $query = $this->conn->prepare("DELETE FROM user WHERE id = ?");
        $query->bind_param("i", $id); // i = integer
        return $query->execute(); // menjalankan query
    }

    public function update($id, $name) {
        // mengubah nama user berdasarkan id
        $query = $this->conn->prepare("UPDATE user SET name = ? WHERE id = ?");
        $query->bind_param("si", $name, $id); // s = string, i = integer
        return $query->execute(); // menjalankan query
    }

}
