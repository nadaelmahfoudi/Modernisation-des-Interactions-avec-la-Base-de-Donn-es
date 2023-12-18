<?php 
require_once 'Config.php';

class Suppression {
    private $pdo;

    public function __construct() {
        $this->pdo = Config::getPdo();
    }

    public function deleteRecord($table, $id) {
        // Use prepared statements to prevent SQL injection
        $sql = "DELETE FROM $table WHERE id = ?";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(1, $id, PDO::PARAM_INT);
            $result = $stmt->execute();

            return $result;
        } catch (PDOException $e) {
            die("Error in prepared statement: " . $e->getMessage());
        }
    }
}