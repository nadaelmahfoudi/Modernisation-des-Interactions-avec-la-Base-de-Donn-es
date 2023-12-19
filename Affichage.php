<?php
require_once 'Config.php';

class Affichage {
    private $pdo;

    public function __construct() {
        $this->pdo = Config::getPdo();
    }

    public function selectRecords($table, $columns = "*", $where = null) {
        // Use prepared statements to prevent SQL injection
        $sql = "SELECT $columns FROM $table";

        if ($where !== null) {
            $sql .= " WHERE $where";
        }

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();

            // Get the result set
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $result;
        } catch (PDOException $e) {
            die("Error in prepared statement: " . $e->getMessage());
        }
    }
}
