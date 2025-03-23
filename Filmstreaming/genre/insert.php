<?php
require __DIR__ . "/../DBConnect/DBconnect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name= $_POST["name"];

    // execute prepare with SQL-statement
    $stmt = $pdo->prepare("insert into genre (name) VALUES (:name);");

    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->execute();

    header("LOCATION: ./index.php");
}
?>

<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Insert New Regisseur</title>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="./../styles/styles.css">
    </head>

    <body>
        <h1>Insert New Genre</h1>
        <div class="form-container">
            <form action="" method="POST">

                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>

                <button type="submit">Add Genre</button>
            </form>
        </div>
        <a href="index.php" class="back-btn">Back</a>
    </body>
</html>
<?php
