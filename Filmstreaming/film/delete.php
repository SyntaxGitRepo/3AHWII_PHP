<?php
require __DIR__ . "/../DBConnect/DBconnect.php";

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];

    $deleteStmt = $pdo->prepare("DELETE FROM film WHERE ID = :id");
    $deleteStmt->bindParam(":id", $id);
    $deleteStmt->execute();

    header("Location: ./index.php");
}

