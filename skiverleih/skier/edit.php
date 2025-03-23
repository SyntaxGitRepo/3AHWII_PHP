<?php

require __DIR__ . "/../DBConnect/DBconnect.php";

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];

    $stmt = $pdo->prepare("SELECT * FROM verleih WHERE id=:id");

    $stmt->bindParam(":id", $id);
    $stmt->execute();
    $ski = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $hersteller = $_POST["hersteller"];
        $preis = $_POST["preis"];

        $stmt2 = $pdo->prepare("UPDATE verleih SET leihbeginn=:leihbeginn, leihdauer_Tage=:leihdauer_Tage,  WHERE `ID` = :id");

        $stmt2->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt2->bindParam(':hersteller', $hersteller, PDO::PARAM_STR);
        $stmt2->bindParam(':preis', $preis, PDO::PARAM_INT);
        $stmt2->execute();

        header("LOCATION: ./index.php");
    }
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
    <h1>Edit Ski</h1>
    <div class="form-container">
        <form action="" method="POST">
            <label for="hersteller">Hersteller:</label>
            <input type="text" id="hersteller" name="hersteller" required value="<?php echo $ski["hersteller"]; ?>">

            <label for="preis">Preis:</label>
            <input type="number" id="preis" name="preis" step="5" min="0" required value="<?php echo $ski["preis"]; ?>">

            <button type="submit">Update Ski</button>
        </form>
    </div>
    <a href="index.php" class="back-btn">Back</a>
    </body>
</html>
