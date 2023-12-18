<?php
class Config {
    public static function getPdo() {
        $serveur = 'localhost';
        $utilisateur = 'root';
        $motDePasse = '';
        $nomBDD = 'task_db';

        try {
            $pdo = new PDO("mysql:host=$serveur;dbname=$nomBDD;charset=utf8mb4", $utilisateur, $motDePasse);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            die("Échec de la connexion : " . $e->getMessage());
        }
    }
}
