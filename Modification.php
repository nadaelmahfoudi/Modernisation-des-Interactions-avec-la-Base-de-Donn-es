<?php
require_once 'Config.php';

class Modification {
    private $pdo;

    public function __construct() {
        $this->pdo = Config::getPdo();
    }

    public function updateRecord($table, $data, $id) {
        // Use prepared statements to prevent SQL injection
        $setStatements = array_map(function ($key) {
            return "$key = ?";
        }, array_keys($data));

        $sql = "UPDATE $table SET " . implode(', ', $setStatements) . " WHERE id = ?";

        try {
            $stmt = $this->pdo->prepare($sql);
            $params = array_merge(array_values($data), [$id]);
            $stmt->execute($params);

            // Get the result (number of affected rows)
            $result = $stmt->rowCount();

            return $result > 0; // Return true if any row was affected
        } catch (PDOException $e) {
            die("Error in prepared statement: " . $e->getMessage());
        }
    }
}