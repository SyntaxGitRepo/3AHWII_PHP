<?php
// Include the database connection file to establish a connection to the database
require __DIR__ . "/../DBConnect/DBconnect.php";

// Check if the request method is POST (i.e., the form has been submitted)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST["name"];
    $geburtsjahr = (int) $_POST["geburtsjahr"]; // Cast birth year to an integer
    $nationalitaet = $_POST["nationalitaet"];

    // Prepare an SQL query to insert a new regisseur (director) into the database
    $insertStmt = $pdo->prepare("insert into regisseur (name, geburtsjahr, nationalitaet) VALUES (:name, :geburtsjahr, :nationaltaet);");

    // Bind the form data to the query parameters
    $insertStmt->bindParam(':name', $name, PDO::PARAM_STR);
    $insertStmt->bindParam(':geburtsjahr', $geburtsjahr, PDO::PARAM_INT);
    $insertStmt->bindParam(':nationaltaet', $nationalitaet, PDO::PARAM_STR);

    // Execute the prepared statement to insert the new regisseur into the database
    $insertStmt->execute();

    // Redirect to the index page after successfully inserting the regisseur
    header("LOCATION: ./index.php");
}
?>

<!DOCTYPE html>

<html lang="en">
<head>
    <!-- Meta tags for character set and viewport configuration for responsiveness -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert New Regisseur</title>
    <!-- Link to Google Fonts for font styling -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <!-- Link to external stylesheet for page styling -->
    <link rel="stylesheet" href="./../styles/styles.css">
</head>

<body>
<!-- Page heading -->
<h1>Insert New Regisseur</h1>
<div class="form-container">
    <!-- Back button to return to the index page -->
    <a href="index.php" class="back-btn">X</a>
    <!-- Form for adding a new regisseur -->
    <form action="" method="POST">

        <!-- Input field for the regisseur's name -->
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>

        <!-- Input field for the regisseur's birth year -->
        <label for="geburtsjahr">Geburtsjahr:</label>
        <input type="number" id="geburtsjahr" name="geburtsjahr" required min="1900" max="2100" value="1900">

        <!-- Input field for the regisseur's nationality -->
        <label for="nationalitaet">Nationalität:</label>
        <input type="text" id="nationalitaet" name="nationalitaet" required>

        <!-- Submit button to add the new regisseur -->
        <button type="submit">Add Regisseur</button>
    </form>
</div>
</body>
</html>
