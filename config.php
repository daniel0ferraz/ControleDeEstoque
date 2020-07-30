<?php
try {
    $pdo = new PDO("mysql:dbname=estoque;host=localhost", "root", "");

} catch (PDOException $e) {
    echo "erro na conexão".$e->getMessage();
}
