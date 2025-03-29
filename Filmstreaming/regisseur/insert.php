<?php
require __DIR__ . "/../DBConnect/DBconnect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name= $_POST["name"];
    $geburtsjahr = (int) $_POST["geburtsjahr"];
    $nationalitaet = $_POST["nationalitaet"];

    // execute prepare with SQL-statement
    $insertStmt = $pdo->prepare("insert into regisseur (name, geburtsjahr, nationalitaet) VALUES (:name, :geburtsjahr, :nationaltaet);");

    $insertStmt->bindParam(':name', $name, PDO::PARAM_STR);
    $insertStmt->bindParam(':geburtsjahr', $geburtsjahr, PDO::PARAM_INT);
    $insertStmt->bindParam(':nationaltaet', $nationalitaet, PDO::PARAM_STR);

    $insertStmt->execute();

    header("LOCATION: ./index.php");
}
?>

    <!DOCTYPE html>

    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Insert New Regisseur</title>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="./../styles/styles.css">
    </head>

    <body>
    <h1>Insert New Regisseur</h1>
    <div class="form-container">
        <a href="index.php" class="back-btn">X</a>
        <form action="" method="POST">

            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="geburtsjahr">Geburtsjahr:</label>
            <input type="number" id="geburtsjahr" name="geburtsjahr"  required min="1900" max="2100" value="1900">

            <label for="nationalitaet">Nationaltät:</label>
            <input type="text" id="nationalitaet" name="nationalitaet" required>

            <button type="submit">Add Regisseur</button>
        </form>
    </div>
    </body>
</html>
