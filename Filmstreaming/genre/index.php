<?php

require __DIR__ . "/../DBConnect/DBconnect.php";

// execute prepare with SQL-statement
$stmt = $pdo->prepare("SELECT * FROM genre");

// execute SQL-statement
$stmt->execute();

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Filme</title>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="../styles/styles.css">
    </head>

    <body>
        <header>
            <a href="../"">Home</a>
            <a href="../film">Film</a>
            <a href="../regisseur">Regisseur</a>
            <a href="../genre" class="active">Genre</a>
        </header>
        <h1>Genre</h1>
        <table>
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($result as $row): ?>
                <tr>
                    <td><?php echo $row['ID']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><a href="edit.php?id=<?php echo $row['ID']; ?>" class="btn edit_btn">Edit</a></td>
                    <td><a href="delete.php?id=<?php echo $row['ID']; ?>" class="btn delete_btn">Delete</a></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <a href="insert.php" class="add_ski_btn">Add Genre</a>
    </body>
</html>

