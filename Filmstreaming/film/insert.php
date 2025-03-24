<?php
require __DIR__ . "/../DBConnect/DBconnect.php";

$stmt2 = $pdo->prepare("SELECT * FROM regisseur");
$stmt2->execute();
$regisseurs = $stmt2->fetchAll(PDO::FETCH_ASSOC);

$stmt3 = $pdo->prepare("SELECT * FROM genre");
$stmt3->execute();
$genres = $stmt3->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    var_dump($_POST);

    $titel = $_POST["titel"];
    $erscheinungjahr = $_POST["erscheinungjahr"];
    $regisseur_id = $_POST["regisseur_id"];
    $bewertung = $_POST["bewertung"];

    // execute prepare with SQL-statement
    $stmt = $pdo->prepare("insert into film(titel, erscheinungsjahr, regisseur_id, bewertung) VALUES (:titel, :erscheinungsjahr, :regisseur_id, :bewertung)");

    $stmt->bindParam(':titel', $titel);
    $stmt->bindParam(':erscheinungsjahr', $erscheinungjahr);
    $stmt->bindParam(':regisseur_id', $regisseur_id);
    $stmt->bindParam(':bewertung', $bewertung);

    #$stmt->execute();

    #header("LOCATION: ./index.php");
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
                <select class="select" name="regisseur" id="regisseur">
                    <option class="option" value="">- Bitte Auswählen - </option>
                    <hr>
                    <?php foreach ($regisseurs as $regisseur):?>
                        <option value="<?php echo $regisseur['name'];?>"><?php echo $regisseur['name'];?></option>
                    <?php endforeach?>
                </select>

                <label>Genre:</label>
                <multi-input name="genre" id="genre">
                    <input list="speakers">
                    <datalist id="speakers">
                        <?php foreach ($genres as $genre):?>
                            <option value="<?php echo $genre['name']; ?>"><?php echo $genre['name']; ?></option>
                        <?php endforeach;?>
                    </datalist>
                </multi-input>

                <label>Genre:</label>
                <genre-selector>
                    <?php foreach ($genres as $genre):?>
                        <option value="<?php echo $genre['name']; ?>"></option>
                    <?php endforeach;?>
                </genre-selector>

                <button type="submit">Add Film</button>
            </form>
        </div>
        <a href="index.php" class="back-btn">Back</a>
    </body>
    <script src="multi-input.js"></script>
    <script src="genre_selector.js"></script>
</html>
