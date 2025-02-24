<?php
require __DIR__ . "/../DBConnect/DBconnect.php";

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];

    $stmt = $pdo->prepare("DELETE FROM skier WHERE ID = :id");
    $stmt->bindParam(":id", $id);
    $stmt->execute();

    header("Location: ./../skiverleih.php");
}
