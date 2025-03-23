<?php

require __DIR__ . "/../DBConnect/DBconnect.php";

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];

    $stmt = $pdo->prepare("SELECT * FROM genre WHERE id=:id");

    $stmt->bindParam(":id", $id);
    $stmt->execute();
    $genre = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name= $_POST["name"];

        $stmt2 = $pdo->prepare("UPDATE genre SET `name`=:name WHERE `ID`=:id");

        //  $stmt2->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt2->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt2->bindParam(':name', $name, PDO::PARAM_STR);
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
        <title>Edit Regisseur</title>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="./../styles/styles.css">
    </head>

    <body>
        <h1>Edit Genre</h1>
        <div class="form-container">
            <form action="" method="POST">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required value="<?php echo $genre['name'];?>">

                <button type="submit">Edit Genre</button>
            </form>
        </div>
        <a href="index.php" class="back-btn">Back</a>
    </body>
</html>
<?php
