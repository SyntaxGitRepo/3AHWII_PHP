<?php
require __DIR__ . "/../DBConnect/DBconnect.php";

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];

    $regisseur = $pdo->prepare("select * from film where regisseur_id = :regisseur_id");
    $regisseur->bindParam(':regisseur_id', $id);
    $regisseur->execute();
    $regisseur = $regisseur->fetch(PDO::FETCH_ASSOC);

    $valid = false;
    if (gettype($regisseur) == "boolean") {
        $deleteStmt = $pdo->prepare("DELETE FROM regisseur WHERE ID = :id");
        $deleteStmt->bindParam(":id", $id);
        $deleteStmt->execute();

        $valid = true;
    }

   header("Location: ./index.php?valid=" . ($valid ? "true" : "false"));
}