<?php

// Include the database connection file to establish a connection to the database
require __DIR__ . "/../DBConnect/DBconnect.php";

// Prepare an SQL query to fetch all records from the 'regisseur' (director) table
$selectStmt = $pdo->prepare("SELECT * FROM regisseur");

// Execute the SQL query
$selectStmt->execute();

// Fetch all results as an associative array
$result = $selectStmt->fetchAll(PDO::FETCH_ASSOC);

// Check if the request method is GET and if the 'valid' parameter is passed in the URL
if ($_SERVER["REQUEST_METHOD"] === "GET") {
    // Check if the 'valid' parameter is present in the query string
    if (in_array("valid", $_GET)) {
        // If 'valid' is 'false', show an alert indicating the regisseur cannot be deleted
        if ($_GET["valid"] === "false") {
            echo "<script>alert('You can not delete a regisseur who is registered to a film!');</script>";
        }
    }
}

?>
<!DOCTYPE html>

<html lang="en">
<head>
    <!-- Meta tags for character set and viewport configuration for responsiveness -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regisseur</title>
    <!-- Link to Google Fonts for font styling -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <!-- Link to the external stylesheet for styling the page -->
    <link rel="stylesheet" href="../styles/styles.css">
</head>

<body>
<!-- Header with navigation links -->
<header>
    <!-- Navigation links to other pages -->
    <a href="../"">Home</a>
    <a href="../film">Film</a>
    <a href="../regisseur"  class="activeBtn">Regisseur</a>
    <a href="../genre">Genre</a>
</header>

<!-- Page title -->
<h1>Regisseur</h1>

<!-- Table to display the list of directors (regisseurs) -->
<table>
    <thead>
    <tr>
        <!-- Table headers for displaying director's information -->
        <th>ID</th>
        <th>Name</th>
        <th>Geburtsjahr</th>
        <th>Nationalität</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($result as $row): ?>
        <tr>
            <!-- Table rows displaying individual director's data -->
            <td><?php echo $row['ID']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['geburtsjahr']; ?></td>
            <td><?php echo $row['nationalitaet']; ?></td>
            <!-- Edit button for each director -->
            <td><a href="edit.php?id=<?php echo $row['ID']; ?>" class="btn edit_btn">Edit</a></td>
            <!-- Delete button for each director -->
            <td><a href="delete.php?id=<?php echo $row['ID']; ?>" class="btn delete_btn">Delete</a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<!-- Button to add a new regisseur (director) -->
<a href="insert.php" class="add_btn">Add Regisseur</a>
</body>
</html>
