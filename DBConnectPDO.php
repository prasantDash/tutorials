<?php
class DBConnectPDO{
    private $hostname = '127.0.0.1:3306';
    private $username = 'root';
    private $password = '';
    private $database = 'bank';

    public $conn;

    

    public function createConnection() {
        try {
            $this->conn = new PDO("mysql:host=$this->hostname;dbname=$this->database", $this->username, $this->password);
            // set the PDO error mode to exception
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           
            
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
}



?>