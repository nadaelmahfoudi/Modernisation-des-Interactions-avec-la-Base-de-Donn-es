<?php
require 'Insertion.php';
require 'Modification.php';
require 'Suppression.php';
require 'Affichage.php';

// Example Usage:
// $Insertion = new Insertion();

// $data = ['name' => 'Mehdi', 'age' => 19];
// $result = $Insertion->insertRecord('users', $data);

// if ($result) {
//     echo "Enregistrement inséré avec succès !";
// } else {
//     echo "Erreur lors de l'insertion de l'enregistrement.";
// }

// Example Usage:
// $databaseHandler = new Modification();

// $dataToUpdate = ['name' => 'Laila', 'age' => 25];
// $idToUpdate = 4;

// $result = $databaseHandler->updateRecord('users', $dataToUpdate, $idToUpdate);

// if ($result) {
//     echo "Record updated successfully!";
// } else {
//     echo "Error updating record.";
// }


// Example Usage:
// $databaseHandler = new Suppression();

// $idToDelete = 6;

// $result = $databaseHandler->deleteRecord('users', $idToDelete);

// if ($result) {
//     echo "Record deleted successfully!";
// } else {
//     echo "Error deleting record.";
// }


// Example Usage:
// $databaseHandler = new Affichage();

// $result = $databaseHandler->selectRecords('users', 'id, name, age');

// // Example: Fetch data from the result set
// foreach ($result as $row) {
//     print_r($row);
// }
