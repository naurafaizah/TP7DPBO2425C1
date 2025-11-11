<?php
class Database {
    // menyimpan data kredensial untuk koneksi database
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $dbname = "catalog_db";

    // variabel untuk menampung koneksi ke database
    public $conn;

    public function __construct() {
        // mencoba melakukan koneksi ke database
        try {
            $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->dbname);
        } catch (Exception $e) {
            // jika koneksi gagal, tampilkan pesan error
            die("koneksi gagal: " . $e->getMessage());
        }
    }
}
