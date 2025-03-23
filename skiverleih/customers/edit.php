<?php

require __DIR__ . "/../DBConnect/DBconnect.php";

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];

    $stmt = $pdo->prepare("SELECT * FROM kunden WHERE id=:id");

    $stmt->bindParam(":id", $id);
    $stmt->execute();
    $kunde = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nachname = $_POST["nachname"];
        $vorname = $_POST["vorname"];
        $ausweis = $_POST["ausweis"];
        $telefon = $_POST["telefon"];

        $stmt2 = $pdo->prepare("UPDATE kunden SET `nachname` = :nachname, `vorname` = :vorname, `ausweis` = :ausweis, `telefon` = :telefon WHERE `ID` = :id");

        $stmt2->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt2->bindParam(':nachname', $nachname);
        $stmt2->bindParam(':vorname', $vorname);
        $stmt2->bindParam(':ausweis', $ausweis);
        $stmt2->bindParam(':telefon', $telefon);
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
    <h1>Edit Customer</h1>
    <div class="form-container">
        <form action="" method="POST">
            <label for="nachname">Nachname:</label>
            <input type="text" id="nachname" name="nachname" required value="<?php echo $kunde["nachname"]; ?>">

            <label for="vorname">Vorname:</label>
            <input type="text" id="vorname" name="vorname" required value="<?php echo $kunde["vorname"]; ?>">

            <label for="ausweis">Ausweis:</label>
            <input type="text" id="ausweis" name="ausweis" required value="<?php echo $kunde["ausweis"]; ?>">

            <label for="telefon">Telefon:</label>
            <input type="tel" id="telefon" name="telefon" required value="<?php echo $kunde["telefon"]; ?>">

            <button type="submit">Update Customer</button>
        </form>
    </div>
    <a href="index.php" class="back-btn">Back</a>
    </body>
</html>
