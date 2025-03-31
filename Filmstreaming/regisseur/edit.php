<?php

// Include the database connection file to establish a connection to the database
require __DIR__ . "/../DBConnect/DBconnect.php";

// Check if 'id' is set in the URL query parameters
if (isset($_GET['id'])) {
    // Convert the 'id' from the URL to an integer
    $id = (int) $_GET['id'];

    // Prepare a SQL query to fetch the regisseur (director) details based on the 'id'
    $stmt = $pdo->prepare("SELECT * FROM regisseur WHERE id=:id");

    // Bind the 'id' parameter to the SQL query
    $stmt->bindParam(":id", $id);
    $stmt->execute(); // Execute the query

    // Fetch the result as an associative array
    $regisseur = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if the form is submitted via POST method
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the form values from the POST request
        $name = $_POST["name"];
        $geburtsjahr = (int) $_POST["geburtsjahr"]; // Convert birth year to integer
        $nationalitaet = $_POST["nationalitaet"];

        // Prepare a SQL query to update the regisseur's details in the database
        $updateStmt = $pdo->prepare("UPDATE regisseur SET `name`=:name, `geburtsjahr`=:geburtsjahr, `nationalitaet`=:nationalitaet WHERE `ID`=:id");

        // Bind the values to the query parameters
        $updateStmt->bindParam(":id", $id, PDO::PARAM_INT); // Bind 'id' as integer
        $updateStmt->bindParam(':name', $name, PDO::PARAM_STR); // Bind 'name' as string
        $updateStmt->bindParam(':geburtsjahr', $geburtsjahr, PDO::PARAM_INT); // Bind 'geburtsjahr' (birth year) as integer
        $updateStmt->bindParam(':nationalitaet', $nationalitaet, PDO::PARAM_STR); // Bind 'nationalitaet' (nationality) as string
        $updateStmt->execute(); // Execute the update query

        // Redirect to 'index.php' after the form is successfully submitted
        header("LOCATION: ./index.php");
    }
}

?>

    <!DOCTYPE html>

    <html lang="en">
    <head>
        <!-- Character set and responsive meta tags -->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit Regisseur</title>
        <!-- Importing a Google font for styling -->
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
        <!-- Link to external CSS file for styling -->
        <link rel="stylesheet" href="./../styles/styles.css">
    </head>

    <body>
    <!-- Heading for the page -->
    <h1>Edit Regisseur</h1>
    <div class="form-container">
        <!-- Back button to return to the index page -->
        <a href="index.php" class="back-btn">X</a>
        <!-- Form to edit the regisseur's details -->
        <form action="" method="POST">
            <!-- Input field for name -->
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required value="<?php echo $regisseur['name'];?>">

            <!-- Input field for birth year -->
            <label for="geburtsjahr">Geburtsjahr:</label>
            <input type="number" id="geburtsjahr" name="geburtsjahr" required value="<?php echo $regisseur['geburtsjahr'];?>">

            <!-- Input field for nationality -->
            <label for="nationalitaet">Nationalität:</label>
            <input type="text" id="nationalitaet" name="nationalitaet" required value="<?php echo $regisseur['nationalitaet'];?>">

            <!-- Submit button to update the regisseur's details -->
            <button type="submit">Edit Regisseur</button>
        </form>
    </div>
    </body>
    </html>
<?php
