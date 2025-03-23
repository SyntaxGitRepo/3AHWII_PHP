<?php

require __DIR__ . "/../DBConnect/DBconnect.php";

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];

    $stmt = $pdo->prepare("SELECT * FROM film WHERE id=:id");

    $stmt->bindParam(":id", $id);
    $stmt->execute();
    $ski = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $titel = $_POST["titel"];
        $erscheinungsjahr = $_POST["erscheinungsjahr"];
        $regisseur_id = $_POST["regisseur_id"];
        $bewertung = $_POST["bewertung"];

        $stmt2 = $pdo->prepare("UPDATE film SET titel=:titel, erscheinungsjahr=:erscheinungsjahr, regisseur_id=:regisseur_id, bewertung=:bewertung  WHERE `ID` = :id");

      //  $stmt2->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt2->bindParam(':titel', $titel, PDO::PARAM_STR);
        $stmt2->bindParam(':erscheinungsjahr', $erscheinungsjahr, PDO::PARAM_INT);
        $stmt2->bindParam(':regisseur_id', $regisseur_id, PDO::PARAM_INT);
        $stmt2->bindParam(':bewertung', $bewertung, PDO::PARAM_INT);
        $stmt2->execute();

        header("LOCATION: ./index.php");
    }
}

?>

    <!DOCTYPE html>

    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Insert New Film</title>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="./../styles/styles.css">
    </head>

    <body>
    <h1>Edit Film</h1>
    <div class="form-container">
        <form action="" method="POST">
            <label for="titel">Titel:</label>
            <input type="text" id="titel" name="titel" required>

            <label for="erscheinungsjahr">Erscheinungsjahr:</label>
            <input type="number" id="erscheinungsjahr" name="Erscheinungsjahr"  required>

            <label for="regisseur_id">Regisseur:</label>
            <input type="number" id="regisseur_id" name="regisseur_id" required>

            <label for="bewertung">Bewertung:</label>
            <input type="number" id="bewertung" name="bewertung"  required>

            <button type="submit">Update Film</button>
        </form>
    </div>
    <a href="index.php" class="back-btn">Back</a>
    </body>
    </html>
<?php
