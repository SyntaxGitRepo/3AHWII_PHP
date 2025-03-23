<?php
require __DIR__ . "/../DBConnect/DBconnect.php";

// execute prepare with SQL-statement
$stmt = $pdo->prepare(
        "select
                v.id as skiID, leihbeginn, leihdauer_tage,
                s.hersteller,
                k.nachname, k.vorname
               from verleih v
                LEFT JOIN skiverleih.kunden k on k.ID = v.`Fkunden-ID`
                LEFT JOIN skier s on v.`Fskier-ID` = s.ID;"
);

// execute SQL-statement
$stmt->execute();

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verleih</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../styles/styles.css">
</head>

<body>
<h1>Verleih</h1>
<table>
    <thead>
    <tr>
        <th>Verleih ID</th>
        <th>Leihbeginn</th>
        <th>Leihdauer</th>
        <th>Nachname</th>
        <th>Vorname</th>
        <th>Ski</th>
        <th>Bearbeiten</th>
        <th>Löschen</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($result as $row): ?>
        <tr>
            <td><?php echo $row['skiID']; ?></td>
            <td><?php echo $row['leihbeginn']; ?></td>
            <td><?php echo $row['leihdauer_tage']; ?></td>
            <td><?php echo $row['nachname']; ?></td>
            <td><?php echo $row['vorname']; ?></td>
            <td><?php echo $row['hersteller']; ?></td>
            <td><a href="./edit.php?id=<?php echo $row['skiID']; ?>" class="btn edit_btn">Bearbeiten</a></td>
            <td><a href="./delete.php?id=<?php echo $row['skiID']; ?>" class="btn delete_btn">Löschen</a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<a href="insert.php" class="add_ski_btn">Neuer  Verleih</a>
</body>
</html>
