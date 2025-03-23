<?php

try {
    $pdo = new PDO('mysql:host=localhost;dbname=skiverleih', 'root', '', [
        PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION
    ]);
    }
    
catch (PDOException $e) {
    echo "Fehler beim Verbindungsaufbau zur Datenbank";
    die();
}
