<?php
require __DIR__ . "/../DBConnect/DBconnect.php";

$stmt2 = $pdo->prepare("SELECT * FROM regisseur");
$stmt2->execute();
$regisseurs = $stmt2->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titel = $_POST["titel"];
    $erscheinungjahr = $_POST["erscheinungjahr"];
    $regisseur_id = $_POST["regisseur_id"];
    $bewertung = $_POST["bewertung"];

    // execute prepare with SQL-statement
    $stmt = $pdo->prepare("insert into film (titel, erscheinungsjahr, regisseur_id, bewertung) VALUES (:titel, :erscheinungsjahr, :regisseur_id, :bewertung)");

    $stmt->bindParam(':titel', $titel);
    $stmt->bindParam(':erscheinungsjahr', $erscheinungjahr);
    $stmt->bindParam(':regisseur_id', $regisseur_id);
    $stmt->bindParam(':bewertung', $bewertung);

    $stmt->execute();

    header("LOCATION: ./index.php");
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
        <h1>Insert New Film</h1>
        <div class="form-container">
            <form action="" method="POST">

                <label for="titel">Titel:</label>
                <input type="text" id="titel" name="titel" required>

                <label for="erscheinungsjahr">Erscheinungsjahr:</label>
                <input type="number" id="erscheinungsjahr" name="Erscheinungsjahr">

                <label for="bewertung">Bewertung:</label>
                <input type="number" id="bewertung" name="bewertung"  required>

                <label for="regisseur">Regisseur:</label>
                <input type="text" id="regisseur" name="regisseur" required>

                <label for="">Genre:</label>
                <input type="" id="" name=""  required>

                <button type="submit">Add Film</button>
            </form>
        </div>
        <a href="index.php" class="back-btn">Back</a>
        <script src="autocomplete.js">
            <?php echo 'autocomplete();'?>
        </script>

    </body>
</html>
