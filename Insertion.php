<?php
require_once 'Config.php';

class Insertion {
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







