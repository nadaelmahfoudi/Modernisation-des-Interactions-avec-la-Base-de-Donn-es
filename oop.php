<?php
require 'connection.php';

class DatabaseHandler {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function insertRecord($table, $data) {
        // Use prepared statements to prevent SQL injection
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
}

// Example Usage:
// $databaseHandler = new DatabaseHandler($pdo);

// $data = ['name' => 'Nada', 'age' => 20];
// $result = $databaseHandler->insertRecord('users', $data);

// if ($result) {
//     echo "Record inserted successfully!";
// } else {
//     echo "Error inserting record.";
// }
class DatabaseHandler2{
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function updateRecord($table, $data, $id) {
        // Use prepared statements to prevent SQL injection
        $setStatements = array_map(function ($key) {
            return "$key = ?";
        }, array_keys($data));

        $sql = "UPDATE $table SET " . implode(', ', $setStatements) . " WHERE id = ?";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(array_merge(array_values($data), [$id]));

            // Get the result (number of affected rows)
            $result = $stmt->rowCount();

            return $result > 0; // Return true if any row was affected
        } catch (PDOException $e) {
            die("Error in prepared statement: " . $e->getMessage());
        }
    }
}

// Example Usage:
// $databaseHandler = new DatabaseHandler2($pdo);

// $dataToUpdate = ['name' => 'Laila', 'age' => 25];
// $idToUpdate = 4;

// $result = $databaseHandler->updateRecord('users', $dataToUpdate, $idToUpdate);

// if ($result) {
//     echo "Record updated successfully!";
// } else {
//     echo "Error updating record.";
// }



// fonction pour la suppression
class DatabaseHandler3{
    private $pdo;
    public function __construct($pdo) {
        $this->pdo = $pdo;
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
// $databaseHandler = new DatabaseHandler3($pdo);

// $idToDelete = 6;

// $result = $databaseHandler->deleteRecord('users', $idToDelete);

// if ($result) {
//     echo "Record deleted successfully!";
// } else {
//     echo "Error deleting record.";
// }


// fonction pour l'affichage
class DatabaseHandler4{
    private $pdo;

    public function __construct ($pdo){
        $this->pdp = $pdo;
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





