<?php

// Include the database connection file
require __DIR__ . "/../DBConnect/DBconnect.php";

// Prepare a SQL statement to fetch all films with their details, including director and genres
$selectStmt = $pdo->prepare("SELECT
    f.ID,
    f.titel,
    f.bewertung,
    f.erscheinungsjahr,
    r.name as regisseurName,
    GROUP_CONCAT(g.name SEPARATOR ', ') as genreNames
FROM film f
LEFT JOIN regisseur r on r.ID = f.regisseur_id
LEFT JOIN h_film_genre hfg on f.ID = hfg.film_ID
LEFT JOIN genre g on g.ID = hfg.genre_ID
GROUP BY f.ID, f.titel, f.bewertung, f.erscheinungsjahr, r.name;");

// Execute the query
$selectStmt->execute();

// Fetch all results as an associative array
$result = $selectStmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Films</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../styles/styles.css">
</head>

<body>
<header>
    <!-- Navigation links -->
    <a href="../">Home</a>
    <a href="../film" class="activeBtn">Film</a>
    <a href="../regisseur">Director</a>
    <a href="../genre">Genre</a>
</header>
<h1>Films</h1>
<table style="width: 70%">
    <thead>
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Release Year</th>
        <th>Director</th>
        <th>Rating</th>
        <th>Genres</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($result as $row): ?>
        <tr>
            <td><?php echo $row['ID']; ?></td>
            <td><?php echo $row['titel']; ?></td>
            <td><?php echo $row['erscheinungsjahr']; ?></td>
            <td><?php echo $row['regisseurName']; ?></td>
            <td><?php echo $row['bewertung']; ?></td>
            <td><?php echo $row['genreNames']; ?></td>
            <td><a href="edit.php?id=<?php echo $row['ID']; ?>" class="btn edit_btn">Edit</a></td>
            <td><a href="delete.php?id=<?php echo $row['ID']; ?>" class="btn delete_btn">Delete</a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<!-- Button to add a new film -->
<a href="insert.php" class="add_btn">Add Film</a>
</body>
</html>
