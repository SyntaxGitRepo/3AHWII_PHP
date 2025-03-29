<?php
require __DIR__ . "/../DBConnect/DBconnect.php";

$genres = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];

    $genresStmt = $pdo->prepare("select * from genre where name=:name");
    $genresStmt->bindParam(":name", $name);
    $genresStmt->execute();
    $genres = $genresStmt->fetchAll();

    if (count($genres) <= 0) {
        // execute prepare with SQL-statement
        $insertStmt = $pdo->prepare("insert into genre (name) VALUES (:name);");

        $insertStmt->bindParam(':name', $name, PDO::PARAM_STR);
        $insertStmt->execute();

        $location = "";
        if (isset($_GET["fromFilm"])){
            $location = "./../film/insert.php";
        } else {
            $location = "./index.php";
        }

        header("LOCATION: ".$location);
    }
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
            <a href="<?php if (isset($_GET["fromFilm"])): echo "./../film/insert.php"; else: echo "index.php"; endif;?>" class="back-btn">X</a>
            <form action="" method="POST">

                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>

                <?php if (count($genres) > 0):?>
                    <label style="color: #d32f2f">Name already exists!</label>
                <?php endif?>

                <button type="submit">Add Genre</button>
            </form>
        </div>
    </body>
</html>
<?php
