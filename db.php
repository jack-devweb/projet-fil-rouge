<?php
class Db {
    private $host = 'localhost';
    private $db_name = 'mobi';
    private $username = 'root';
    private $password = '';
    private $conn;

    public function getConnection() {
        try {
            $this->conn = new PDO('mysql:host='.$this->host.';dbname='.$this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $exception) {
            throw new Exception('Erreur de connexion à la base de données : '.$exception->getMessage());
        }

        return $this->conn;
    }

    public function getUserById($id) {
        $conn = $this->getConnection();
        $stmt = $conn->prepare('SELECT * FROM users WHERE id = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
