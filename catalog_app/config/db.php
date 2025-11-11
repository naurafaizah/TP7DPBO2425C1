<?php
class Database {
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $dbname = "catalog_db";

    public $conn;

    public function __construct() {
        try {
            $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->dbname);
        } catch (Exception $e) {
            die("Koneksi gagal: " . $e->getMessage());
        }
    }
}
