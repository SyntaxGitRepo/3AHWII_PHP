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
} catch (PDOException $_) {
    echo "Exception on connect!";
    exit;
}
