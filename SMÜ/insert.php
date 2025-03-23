<?php

require __DIR__ . '/connect.php';

/* Anpassungen:
    - if-Statement zur Prüfung, ob das Formular abgesendet wurde (1 Punkt)
    - falls Formular korrekt gepostet wurde:
      Zuweisung des Werts des Input-Feldes mit der Kunden-ID an die Variable $id (1 Punkt)
    - Ausgabe mittels echo-Befehl: Neuer Kunde mit ID <Kunden-ID> angelegt. (1 Punkt)
*/

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nachname = $_POST['nachname'];
    $vorname = $_POST['vorname'];
    $telefonnummer = $_POST['telefonnummer'];

    $stmt = $pdo->prepare('INSERT INTO customers (ID, nachname, vorname, telefon) VALUES(:id, :nachname, :vorname, :telefonnummer)');
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':nachname', $nachname);
    $stmt->bindParam(':vorname', $vorname);
    $stmt->bindParam(':telefonnummer', $telefonnummer);

    $stmt->execute();
}

?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ski anlegen</title>
</head>
<body>
    <form action="" method="POST">
        <label for="id">ID:</label>
        <input type="text" id="id" name="id" required>
        <br><br>
        
        <label for="hersteller">Nachname</label>
        <input type="text" id="nachname" name="nachname" required>
        <br><br>
        
        <label for="preis">Vorname</label>
        <input type="text" id="preis" name="vorname" step="0.01" required>
        <br><br>

        <label for="preis">Telefon</label>
        <input type="text" id="preis" name="telefonnummer" step="0.01" required>
        <br><br>
        
        <button type="submit">Kunde anlegen</button>
    </form>
</body>
</html>
