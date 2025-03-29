<?php

require __DIR__ . "/../DBConnect/DBconnect.php";

if (isset($_GET['id'])) {
    $filmID = (int) $_GET['id'];

    $selectedFilmStmt = $pdo->prepare("SELECT 
    f.ID as filmID, 
    f.titel as filmTitle, 
    f.erscheinungsjahr as filmErscheinungsjahr, 
    f.bewertung as filmBewertung,
    r.ID as regisseurID,
    r.name as regisseurName
    FROM film f
    LEFT JOIN filmstreamingdb.regisseur r on r.ID = f.regisseur_id
    WHERE f.id=:id");

    $selectedFilmStmt->bindParam(":id", $filmID);
    $selectedFilmStmt->execute();
    $film = $selectedFilmStmt->fetch(PDO::FETCH_ASSOC);

    $regisseursStmt = $pdo->prepare("SELECT * from regisseur;");
    $regisseursStmt->execute();
    $regisseurs = $regisseursStmt->fetchAll(PDO::FETCH_ASSOC);

    $genreStmt = $pdo->prepare("SELECT * from genre;");
    $genreStmt->execute();
    $genres = $genreStmt->fetchAll(PDO::FETCH_ASSOC);

    $filmGenreStmt = $pdo->prepare("SELECT * from h_film_genre where film_ID=:filmId;");
    $filmGenreStmt->bindParam(":filmId", $film['filmID']);
    $filmGenreStmt->execute();
    $filmGenres = $filmGenreStmt->fetchAll(PDO::FETCH_ASSOC);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $titel = $_POST["titel"];
        $erscheinungsjahr = $_POST["erscheinungsjahr"];
        $regisseur_id = $_POST["regisseur"];
        $bewertung = $_POST["bewertung"];
        $selectedGenres  = explode(";",$_POST["genre"]);

        $updateStmt= $pdo->prepare("UPDATE film SET titel=:titel, erscheinungsjahr=:erscheinungsjahr, regisseur_id=:regisseur_id, bewertung=:bewertung  WHERE `ID` = :id");

        $updateStmt->bindParam(':id', $filmID, PDO::PARAM_INT);
        $updateStmt->bindParam(':titel', $titel, PDO::PARAM_STR);
        $updateStmt->bindParam(':erscheinungsjahr', $erscheinungsjahr, PDO::PARAM_INT);
        $updateStmt->bindParam(':regisseur_id', $regisseur_id, PDO::PARAM_INT);
        $updateStmt->bindParam(':bewertung', $bewertung, PDO::PARAM_INT);
        $updateStmt->execute();

        $deleteGenresStmt = $pdo->prepare("DELETE FROM h_film_genre WHERE film_ID=:id");
        $deleteGenresStmt->bindParam(":id", $filmID);
        $deleteGenresStmt->execute();

        foreach ($selectedGenres as $genre) {
            $insertGenresStmt = $pdo->prepare("insert into h_film_genre (film_ID, genre_ID) VALUES (:filmID, :genreID)");

            $genreID = intval($genre);

            $insertGenresStmt->bindParam(':filmID', $filmID, PDO::PARAM_INT);
            $insertGenresStmt->bindParam(':genreID', $genreID, PDO::PARAM_INT);

            $insertGenresStmt->execute();
        }

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
        <a href="index.php" class="back-btn">X</a>
        <form action="" method="POST">
            <label for="titel">Titel:</label>
            <input type="text" id="titel" name="titel" required value="<?php echo $film['filmTitle']?>">

            <label for="erscheinungsjahr">Erscheinungsjahr:</label>
            <input type="number" id="erscheinungsjahr" name="erscheinungsjahr" required value="<?php echo $film['filmErscheinungsjahr']?>">

            <label for="bewertung">Bewertung:</label>
            <input type="number" id="bewertung" name="bewertung"  required  value="<?php echo $film['filmBewertung']?>">

            <label for="regisseur">Regisseur:</label>
            <select class="select" name="regisseur" id="regisseur">
                <?php foreach ($regisseurs as $regisseur):?>
                    <?php if ($regisseur['ID'] === $film['regisseurID']):?>
                        <option value="<?php echo $regisseur["ID"];?>" selected><?php echo $regisseur["name"];?></option>
                    <?php else:?>
                        <option value="<?php echo $regisseur["ID"];?>"><?php echo $regisseur["name"];?></option>
                    <?php endif;?>
                <?php endforeach?>
            </select>

            <label>Genre:</label>
            <genre-selector edit>
                <?php
                foreach ($genres as $genre):
                    $genreSelected = false;
                    foreach ($filmGenres as $filmGenre):
                        if ($filmGenre['genre_ID'] === $genre['ID']):?>
                            <option value="<?php echo $genre['name']; ?>" id="<?php echo $genre['ID']?>" selected></option>
                        <?php
                            $genreSelected = true;
                            break;
                            endif;
                        ?>
                    <?php endforeach?>
                    <?php
                    if (!$genreSelected):?>
                        <option value="<?php echo $genre['name']; ?>" id="<?php echo $genre['ID']?>"></option>
                    <?php endif;?>
                <?php endforeach;?>
            </genre-selector>

            <button type="submit">Update Film</button>
        </form>
    </div>
    </body>
    <script src="genre_selector.js"></script>
</html>

