<?php
require __DIR__ . "/../DBConnect/DBconnect.php";

$getKundenStmt = $pdo->prepare("SELECT * FROM kunden; ");
$getKundenStmt->execute();
$kunden = $getKundenStmt->fetchAll(PDO::FETCH_ASSOC);

$getSkierStmt = $pdo->prepare("SELECT * FROM skier; ");
$getSkierStmt->execute();
$skier = $getSkierStmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $leihbeginn = $_POST["leihbeginn"];
    $leihdauer_Tage = $_POST["leihdauer_Tage"];
    $FkundenID = $_POST["FKunden-ID"];
    $FskierID = $_POST["FskierID"];

    // execute prepare with SQL-statement
    $stmt = $pdo->prepare("insert into verleih (leihbeginn, leihdauer_Tage, `Fskier-ID`, `Fkunden-ID`) VALUES (STR_TO_DATE('2025/02/02', '%Y/%M/%D'), ':leihdauer_Tage', ':FKunden-ID', ':Fskier-ID')");

//    $stmt->bindParam(':leihbeginn', $leihbeginn);
    $stmt->bindParam(':leihdauer_Tage', $leihdauer_Tage, PDO::PARAM_INT);
    $stmt->bindParam(':FKunden-ID', $FkundenID, PDO::PARAM_INT);
    $stmt->bindParam(':Fskier-ID', $FskierID, PDO::PARAM_INT);

    $stmt->execute();

    header("LOCATION: ./index.php");
}
?>

<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert New Ski</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./../styles/styles.css">
</head>

<body>
<h1>Neuen Verleih erstellen</h1>
<div class="form-container">
    <form action="" method="POST">
        <label for="FKunden-ID">Kunde:</label>
        <select class="select_1" name="FKunden-ID" id="FKunden-ID">
            <?php foreach ($kunden as $kunde):  ?>
                <option class="option_1" value="<?php echo $kunde["ID"]?>"><?php echo $kunde["nachname"], " ", $kunde["vorname"]?></option>
            <?php endforeach;?>
        </select>

        <label for="FskierID">Ski:</label>
        <select class="select_1" name="FskierID" id="FskierID">
            <?php foreach ($skier as $ski):  ?>
                <option class="option_1" value="<?php echo $ski["ID"]?>"><?php echo $ski["hersteller"]?></option>
            <?php endforeach;?>
        </select>

        <label for="leihbeginn">Leihbeginn:</label>
        <input type="date" id="leihbeginn" name="leihbeginn" required>

        <label for="leihdauer_Tage">Leihdauer:</label>
        <input type="number" id="leihdauer_Tage" name="leihdauer_Tage" step="1" min="1" required>

        <button type="submit">Add Ski</button>
    </form>
</div>
<a href="index.php" class="back-btn">Back</a>
</body>
</html>
