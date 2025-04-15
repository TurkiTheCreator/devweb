<?php
// filepath: c:\xampp\htdocs\php\leboncoin\home.php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_name'])) {
    // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    header("Location: login.php");
    exit;
}

// Récupérer le prénom de l'utilisateur
$user_name = htmlspecialchars($_SESSION['user_name']);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <!-- Inclure la barre de navigation en haut de la page -->
    <?php include("navbar.php"); ?>

    <div class="container">
        <h1>Bonjour, <?= $user_name ?> !</h1>
        <p>Bienvenue sur votre espace personnel.</p>
    </div>
</body>
</html>