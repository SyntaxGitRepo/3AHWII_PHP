<?php
// Include the database connection file
require __DIR__ . "/../DBConnect/DBconnect.php";

// Check if 'id' parameter is set in the URL
if (isset($_GET['id'])) {
    // Retrieve and cast the 'id' parameter as an integer
    $id = (int) $_GET['id'];

    // Prepare a query to fetch records from the 'film' table where the 'regisseur_id' matches the given 'id'
    $regisseur = $pdo->prepare("select * from film where regisseur_id = :regisseur_id");
    $regisseur->bindParam(':regisseur_id', $id); // Bind the 'id' parameter to the query
    $regisseur->execute(); // Execute the query

    // Fetch the result as an associative array
    $regisseur = $regisseur->fetch(PDO::FETCH_ASSOC);

    // Initialize a flag to indicate whether the deletion was successful
    $valid = false;

    // Check if the query returned a boolean value (i.e., no result found)
    if (gettype($regisseur) == "boolean") {
        // Prepare a query to delete the 'regisseur' record based on the given 'id'
        $deleteStmt = $pdo->prepare("DELETE FROM regisseur WHERE ID = :id");
        $deleteStmt->bindParam(":id", $id); // Bind the 'id' parameter to the query
        $deleteStmt->execute(); // Execute the delete query

        // Set the 'valid' flag to true since the deletion was successful
        $valid = true;
    }

    // Redirect the user to the 'index.php' page with a 'valid' parameter indicating success or failure
    header("Location: ./index.php?valid=" . ($valid ? "true" : "false"));
}
?>
