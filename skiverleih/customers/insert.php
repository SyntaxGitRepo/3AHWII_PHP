<?php
require __DIR__ . "/../DBConnect/DBconnect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nachname = $_POST["nachname"];
    $vorname = $_POST["vorname"];
    $ausweis = $_POST["ausweis"];
    $telefon = $_POST["telefon"];

    // execute prepare with SQL-statement
    $stmt = $pdo->prepare("insert into kunden (nachname, vorname, ausweis, telefon) VALUES (:nachname, :vorname, :ausweis, :telefon)");

    $stmt->bindParam(':nachname', $nachname);
    $stmt->bindParam(':vorname', $vorname);
    $stmt->bindParam(':ausweis', $ausweis);
    $stmt->bindParam(':telefon', $telefon);

    $stmt->execute();

    header("LOCATION: ./index.php");
}
?>

<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Insert New Ski</title>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="./../styles/styles.css">
    </head>

    <body>
    <h1>Insert New Customer</h1>
    <div class="form-container">
        <form action="" method="POST">
            <label for="nachname">Nachname:</label>
            <input type="text" id="nachname" name="nachname" required>

            <label for="vorname">Vorname:</label>
            <input type="text" id="vorname" name="vorname" required>

            <label for="ausweis">Ausweis:</label>
            <input type="text" id="ausweis" name="ausweis">

            <label for="telefon">Telefon:</label>
            <input type="tel" id="telefon" name="telefon" required>

            <button type="submit">Add Customer</button>
        </form>
    </div>
    <a href="index.php" class="back-btn">Back</a>
    </body>
</html>
