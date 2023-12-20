<?php
require_once 'Config.php';

class ORM {
    private $pdo;

    public function __construct() {
        $this->pdo = Config::getPdo();
    }

    public function insertRecord($table, $data) {
        $columns = implode(',', array_keys($data));
        $values = implode(',', array_fill(0, count($data), '?'));

        $sql = "INSERT INTO $table($columns) VALUES($values)";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(array_values($data));

            return true;
        } catch (PDOException $e) {
            die("Error in prepared statement: " . $e->getMessage());
        }
    }

    public function updateRecord($table, $data, $id) {
        $setStatements = array_map(function ($key) {
            return "$key = ?";
        }, array_keys($data));

        $sql = "UPDATE $table SET " . implode(', ', $setStatements) . " WHERE id = ?";

        try {
            $stmt = $this->pdo->prepare($sql);
            $params = array_merge(array_values($data), [$id]);
            $stmt->execute($params);

            $result = $stmt->rowCount();

            return $result > 0;
        } catch (PDOException $e) {
            die("Error in prepared statement: " . $e->getMessage());
        }
    }

    public function deleteRecord($table, $id) {
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

    public function selectRecords($table, $columns = "*", $where = null) {
        $sql = "SELECT $columns FROM $table";

        if ($where !== null) {
            $sql .= " WHERE $where";
        }

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $result;
        } catch (PDOException $e) {
            die("Error in prepared statement: " . $e->getMessage());
        }
    }
}

