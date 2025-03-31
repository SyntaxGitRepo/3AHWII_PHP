<?php
// Include the database connection file
require __DIR__ . "/../DBConnect/DBconnect.php";

// Check if an 'id' parameter is provided in the URL
if (isset($_GET['id'])) {
    // Convert the 'id' parameter to an integer to prevent SQL injection
    $id = (int) $_GET['id'];

    // Prepare a SQL statement to delete a film record with the specified ID
    $deleteStmt = $pdo->prepare("DELETE FROM film WHERE ID = :id");

    // Bind the 'id' parameter to the prepared statement
    $deleteStmt->bindParam(":id", $id);

    // Execute the delete statement
    $deleteStmt->execute();

    // Redirect the user back to the index page after deletion
    header("Location: ./index.php");
}
