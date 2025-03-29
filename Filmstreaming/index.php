<?php

require __DIR__ . "/DBConnect/DBconnect.php";

$selectStmt = $pdo->prepare("SELECT
    f.titel,
    f.bewertung,
    f.erscheinungsjahr,
    r.name as regisseurName,
    GROUP_CONCAT(g.name SEPARATOR ', ') as genreNames
FROM film f
LEFT JOIN regisseur r on r.ID = f.regisseur_id
LEFT JOIN h_film_genre hfg on f.ID = hfg.film_ID
LEFT JOIN genre g on g.ID = hfg.genre_ID
GROUP BY f.ID, f.titel, f.bewertung, f.erscheinungsjahr, r.name
ORDER BY f.bewertung DESC;");

$selectStmt->execute();
$result = $selectStmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Film Streaming</title>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="styles/styles.css">

    </head>
    <body>
    <header>
        <a href="index.php" class="activeBtn">Home</a>
        <a href="./film/index.php">Film</a>
        <a href="./regisseur/index.php">Regisseur</a>
        <a href="./genre/index.php">Genre</a>
    </header>

    <h1>Beste Filme</h1>
    <table style="width: 70%">
        <thead>
        <tr>
            <th>Titel</th>
            <th>Erscheinungsjahr</th>
            <th>Regisseur</th>
            <th>Bewertung</th>
            <th>Genres</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($result as $row): ?>
            <tr>
                <td><?php echo $row['titel']; ?></td>
                <td><?php echo $row['erscheinungsjahr']; ?></td>
                <td><?php echo $row['regisseurName']; ?></td>
                <td><?php echo $row['bewertung']; ?></td>
                <td><?php echo $row['genreNames']; ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    </body>
</html>