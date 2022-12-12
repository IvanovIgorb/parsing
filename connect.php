<?php
global $pdo;

try {
    $pdo = new PDO('mysql:host=localhost;dbname=parsing', 'root', '');
}

catch (PDOException $e) {
    print "Error!: " . $e->getMessage();
    die();
}

?>