<?php

/** Create new prod object; connects to database
 * if an exception is thrown (for example wrong credentials entered) the password and username are shown.
 * catches PDO exceptions
 * PDO::ErrMode_Exception is a constant that is not needed in PHP8 but might be needed on older versions.
 * For example if the server is changed
 */

try {
    $pdo = new PDO('mysql:host=localhost;dbname=skiverleih','root', '', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (PDOException $ex) {
    echo "Exception on connect!";
    exit;
}

// execute prepare with SQL-statement
$stmt = $pdo->prepare("SELECT * FROM skier WHERE id =:id");

// security feature: block SQL-Injections
$stmt->bindValue(':id', $_GET['id']);

// execute SQL-statement
$stmt->execute();

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

// var_dump($result);


foreach ($result as $row) {
    foreach ($row as $key => $value) {
        echo $key . ": " . $value . "<br>";
    }
}