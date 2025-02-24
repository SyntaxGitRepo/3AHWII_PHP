<?php
require __DIR__ . "/../DBConnect/DBconnect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $hersteller = $_POST["hersteller"];
    $preis = $_POST["preis"];

    // execute prepare with SQL-statement
    $stmt = $pdo->prepare("insert into skier (hersteller, preis) VALUES (:hersteller, :preis)");

    $stmt->bindParam(':hersteller', $hersteller);
    $stmt->bindParam(':preis', $preis);

    $stmt->execute();
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
    <h1>Insert New Ski</h1>
    <div class="form-container">
        <form action="" method="POST">

            <label for="hersteller">Hersteller:</label>
            <input type="text" id="hersteller" name="hersteller" required>

            <label for="preis">Preis:</label>
            <input type="number" id="preis" name="preis" step="5" min="0" required>

            <button type="submit">Add Ski</button>
        </form>
    </div>
    <a href="../skiverleih.php" class="back-btn">Back</a>
    </body>
</html>
