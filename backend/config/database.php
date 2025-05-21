<?php

$host = 'db'; // numele containerului db
$db   = 'my_database';
$user = 'postgres';
$pass = 'postgres';

$dsn = "pgsql:host=$host;port=5432;dbname=$db";

try {
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);
    return $pdo;
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
