<?php
require __DIR__ . "/../DBConnect/DBconnect.php";

$regisseurSelectStmt = $pdo->prepare("SELECT * FROM regisseur");
$regisseurSelectStmt->execute();
$regisseurs = $regisseurSelectStmt->fetchAll(PDO::FETCH_ASSOC);

$genreSelectStmt = $pdo->prepare("SELECT * FROM genre");
$genreSelectStmt->execute();
$genres = $genreSelectStmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titel = $_POST["titel"];
    $erscheinungjahr = $_POST["Erscheinungsjahr"];
    $regisseur_id = $_POST["regisseur"];
    $bewertung = $_POST["bewertung"];
    $selectedGenres  = explode(";",$_POST["genre"]);

    // execute prepare with SQL-statement
    $insertStmt = $pdo->prepare("insert into film(titel, erscheinungsjahr, regisseur_id, bewertung) VALUES (:titel, :erscheinungsjahr, :regisseur_id, :bewertung)");

    $insertStmt->bindParam(':titel', $titel);
    $insertStmt->bindParam(':erscheinungsjahr', $erscheinungjahr, pdo::PARAM_INT);
    $insertStmt->bindParam(':regisseur_id', $regisseur_id, pdo::PARAM_INT);
    $insertStmt->bindParam(':bewertung', $bewertung, pdo::PARAM_INT);

    $insertStmt->execute();
    $filmID = $pdo->lastInsertId();

    foreach ($selectedGenres as $genre) {
        $genreInsertStmt = $pdo->prepare("insert into h_film_genre (film_ID, genre_ID) VALUES (:filmID, :genreID)");

        $genreID = intval($genre);

        $genreInsertStmt->bindParam(':filmID', $filmID, PDO::PARAM_INT);
        $genreInsertStmt->bindParam(':genreID', $genreID, PDO::PARAM_INT);

        $genreInsertStmt->execute();
    }

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
            <a href="index.php" class="back-btn">X</a>

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
                        <option value="<?php echo $regisseur['ID'];?>"><?php echo $regisseur['name'];?></option>
                    <?php endforeach?>
                </select>

                <label>Genre:</label>
                <genre-selector>
                    <?php foreach ($genres as $genre):?>
                        <option value="<?php echo $genre['name']; ?>" id="<?php echo $genre['ID']?>"></option>
                    <?php endforeach;?>
                </genre-selector>

                <button type="submit">Add Film</button>
            </form>
        </div>
    </body>
    <script src="genre_selector.js"></script>
</html>
