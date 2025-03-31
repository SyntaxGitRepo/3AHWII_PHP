<?php
// Include the database connection file to establish a connection to the database
require __DIR__ . "/../DBConnect/DBconnect.php";

// Prepare an SQL query to fetch all records from the 'regisseur' (director) table
$regisseurSelectStmt = $pdo->prepare("SELECT * FROM regisseur");
$regisseurSelectStmt->execute();
$regisseurs = $regisseurSelectStmt->fetchAll(PDO::FETCH_ASSOC);

// Prepare an SQL query to fetch all records from the 'genre' table
$genreSelectStmt = $pdo->prepare("SELECT * FROM genre");
$genreSelectStmt->execute();
$genres = $genreSelectStmt->fetchAll(PDO::FETCH_ASSOC);

// Check if the request method is POST (form has been submitted)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $titel = $_POST["titel"];
    $erscheinungjahr = $_POST["Erscheinungsjahr"];
    $regisseur_id = $_POST["regisseur"];
    $bewertung = $_POST["bewertung"];
    // Split the selected genres into an array using ";" as the delimiter
    $selectedGenres = explode(";", $_POST["genre"]);

    // Prepare an SQL query to insert the film into the 'film' table
    $insertStmt = $pdo->prepare("insert into film(titel, erscheinungsjahr, regisseur_id, bewertung) VALUES (:titel, :erscheinungsjahr, :regisseur_id, :bewertung)");

    // Bind the form data to the SQL query parameters
    $insertStmt->bindParam(':titel', $titel);
    $insertStmt->bindParam(':erscheinungsjahr', $erscheinungjahr, pdo::PARAM_INT);
    $insertStmt->bindParam(':regisseur_id', $regisseur_id, pdo::PARAM_INT);
    $insertStmt->bindParam(':bewertung', $bewertung, pdo::PARAM_INT);

    // Execute the insert query to add the new film to the database
    $insertStmt->execute();
    // Get the last inserted film ID to use in genre association
    $filmID = $pdo->lastInsertId();

    // Loop through each selected genre and associate it with the new film
    foreach ($selectedGenres as $genre) {
        // Prepare an SQL query to associate the film with a genre in the 'h_film_genre' table
        $genreInsertStmt = $pdo->prepare("insert into h_film_genre (film_ID, genre_ID) VALUES (:filmID, :genreID)");

        // Convert the genre value to an integer (genre ID)
        $genreID = intval($genre);

        // Bind the film ID and genre ID to the SQL query parameters
        $genreInsertStmt->bindParam(':filmID', $filmID, PDO::PARAM_INT);
        $genreInsertStmt->bindParam(':genreID', $genreID, PDO::PARAM_INT);

        // Execute the query to associate the genre with the film
        $genreInsertStmt->execute();
    }

    // Redirect to the index page after successfully adding the film
    header("LOCATION: ./index.php");
}
?>

<!DOCTYPE html>

<html lang="en">
<head>
    <!-- Meta tags for character set and viewport configuration for responsiveness -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert New Film</title>
    <!-- Link to Google Fonts for font styling -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <!-- Link to the external stylesheet for page styling -->
    <link rel="stylesheet" href="./../styles/styles.css">
</head>

<body>
<!-- Page heading -->
<h1>Insert New Film</h1>
<div class="form-container">
    <!-- Back button to return to the index page -->
    <a href="index.php" class="back-btn">X</a>

    <!-- Form for adding a new film -->
    <form action="" method="POST">
        <!-- Input field for the film title -->
        <label for="titel">Titel:</label>
        <input type="text" id="titel" name="titel" required>

        <!-- Input field for the film's release year -->
        <label for="erscheinungsjahr">Erscheinungsjahr:</label>
        <input type="number" id="erscheinungsjahr" name="Erscheinungsjahr">

        <!-- Input field for the film's rating -->
        <label for="bewertung">Bewertung:</label>
        <input type="number" id="bewertung" name="bewertung" required>

        <!-- Dropdown for selecting the film's director (regisseur) -->
        <label for="regisseur">Regisseur:</label>
        <select class="select" name="regisseur" id="regisseur">
            <option class="option" value="">- Bitte Auswählen - </option>
            <hr>
            <!-- Loop through the directors and display them in the dropdown -->
            <?php foreach ($regisseurs as $regisseur):?>
                <option value="<?php echo $regisseur['ID'];?>"><?php echo $regisseur['name'];?></option>
            <?php endforeach?>
        </select>

        <!-- Dropdown for selecting genres -->
        <label>Genre:</label>
        <genre-selector>
            <!-- Loop through the genres and display them as options -->
            <?php foreach ($genres as $genre):?>
                <option value="<?php echo $genre['name']; ?>" id="<?php echo $genre['ID']?>"></option>
            <?php endforeach;?>
        </genre-selector>

        <!-- Submit button to add the new film -->
        <button type="submit">Add Film</button>
    </form>
</div>
</body>

<!-- Link to the external JavaScript file for genre selection functionality -->
<script src="genre_selector.js"></script>
</html>
