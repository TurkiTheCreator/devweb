<?php

$host = 'localhost';
$dbname = 'leboncoin';
$username = 'root'; 
$password = ''; 

try {
    // PDO pour la connexion
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // erreurs de connexion
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
?>