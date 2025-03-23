<?php

require __DIR__ . '/connect.php';

//Anpassung erforderlich: ID, Nachname, Vorname und Telefonnummer aus Kundentabelle (1 Punkt)
$stmt = $pdo->prepare("SELECT ID, nachname, vorname, telefon FROM customers");

$stmt->execute();

//Anpassung erforderlich: Holen der Datensätze als assoziatives Array (1 Punkt)
$results = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table with 3 Columns</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>
    <h1>Kundendaten</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Vorname</th>
                <th>Nachname</th>
                <th>Telefon</th>
            </tr>
        </thead>
        <tbody>
            <!-- Anpassung erforderlich: Schleife, die alle Kunden-Datensätze durchläuft (1 Punkt) -->
           
            <tr>
                <!-- Anpassung erforderlich: Ausgabe von ID, Vorname, Nachname und Telefonnummer (2 Punkte) -->
                <td>ID</td>
                <td>Vorname</td>
                <td>Nachname</td>
                <td>Telefonnummer</td>
            </tr>
            <!-- Schleife beenden (1 Punkt)-->
        
        </tbody>
    </table>
    <button><a href="insert.php">Kunde anlegen</a></button>
</body>
</html>

