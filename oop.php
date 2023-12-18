<?php
require 'connection.php';

class DatabaseHandler {
    private $pdo;

    public function __construct() {
        $this->pdo = Config::getPdo();
    }

    public function insertRecord($table, $data) {
        // Utiliser des déclarations préparées pour éviter les injections SQL
        $colonnes = implode(',', array_keys($data));
        $valeurs = implode(',', array_fill(0, count($data), '?'));

        $sql = "INSERT INTO $table($colonnes) VALUES($valeurs)";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(array_values($data));

            return true;
        } catch (PDOException $e) {
            die("Erreur dans la déclaration préparée : " . $e->getMessage());
        }
    }
}

// Example Usage:
// $databaseHandler = new DatabaseHandler();

// $data = ['name' => 'Malak', 'age' => 19];
// $result = $databaseHandler->insertRecord('users', $data);

// if ($result) {
//     echo "Enregistrement inséré avec succès !";
// } else {
//     echo "Erreur lors de l'insertion de l'enregistrement.";
// }
class DatabaseHandler2 {
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

// Example Usage:
// $databaseHandler = new DatabaseHandler2();

// $dataToUpdate = ['name' => 'Laila', 'age' => 25];
// $idToUpdate = 4;

// $result = $databaseHandler->updateRecord('users', $dataToUpdate, $idToUpdate);

// if ($result) {
//     echo "Record updated successfully!";
// } else {
//     echo "Error updating record.";
// }




class DatabaseHandler3 {
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

// Example Usage:
// $databaseHandler = new DatabaseHandler3();

// $idToDelete = 6;

// $result = $databaseHandler->deleteRecord('users', $idToDelete);

// if ($result) {
//     echo "Record deleted successfully!";
// } else {
//     echo "Error deleting record.";
// }



class DatabaseHandler4 {
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

// Example Usage:
// $databaseHandler = new DatabaseHandler4();

// $result = $databaseHandler->selectRecords('users', 'id, name, age');

// // Example: Fetch data from the result set
// foreach ($result as $row) {
//     print_r($row);
// }






