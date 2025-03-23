<?php

require __DIR__ . "/../DBConnect/DBconnect.php";

// execute prepare with SQL-statement
$stmt = $pdo->prepare("SELECT * FROM kunden");

// execute SQL-statement
$stmt->execute();

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Simple Table</title>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="../styles/styles.css">
    </head>

    <body>
    <h1>Kunden</h1>
    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Nachname</th>
            <th>Vorname</th>
            <th>Ausweis</th>
            <th>Telefon</th>
            <th>Bearbeiten</th>
            <th>Löschen</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($result as $row): ?>
            <tr>
                <td><?php echo $row['ID']; ?></td>
                <td><?php echo $row['nachname']; ?></td>
                <td><?php echo $row['vorname']; ?></td>
                <td><?php echo $row['ausweis']; ?></td>
                <td><?php echo $row['telefon']; ?></td>
                <td><a href="edit.php?id=<?php echo $row['ID']; ?>" class="btn edit_btn">Bearbeiten</a></td>
                <td><a href="delete.php?id=<?php echo $row['ID']; ?>" class="btn delete_btn">Löschen</a></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <a href="insert.php" class="add_ski_btn">Kunde hinzufügen</a>
    </body>
</html>
