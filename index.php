<?php
require 'SimpleORM.php';

// Example Usage:
// $orm = new ORM();

// $data = ['name' => 'Nada', 'age' => 30];
// $result = $orm->insertRecord('users', $data);

// if ($result) {
//     echo "Record inserted successfully!";
// } else {
//     echo "Error inserting record.";
// }


// Example Usage:
// $orm = new ORM();
// $dataToUpdate = ['name' => 'Nada', 'age' => 30];
// $idToUpdate = 11;

// $result = $orm->updateRecord('users', $dataToUpdate, $idToUpdate);

// if ($result) {
//     echo "Record updated successfully!";
// } else {
//     echo "Error updating record.";
// }




// Example Usage 
    // $orm = new ORM();

    // $idToDelete = 11;
    // $result = $orm->deleteRecord('users', $idToDelete);
    
    // if ($result) {
    //     echo "Record deleted successfully!";
    // } else {
    //     echo "Error deleting record.";
    // }
    
// Example Usage
    $orm = new ORM();
    
    $columnsToSelect = 'id, name, age';
    
    $result = $orm->selectRecords('users', $columnsToSelect);
    
    foreach ($result as $row) {
        print_r($row);
    }
