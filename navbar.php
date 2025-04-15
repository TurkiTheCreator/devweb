<?php
// filepath: c:\xampp\htdocs\php\leboncoin\navbar.php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Vérifier si l'utilisateur est connecté
$is_logged_in = isset($_SESSION['user_name']);
?>

<nav class="navbar">
    <ul class="navbar-list">
        <li><a href="home.php">Accueil</a></li>
        <li><a href="compte.php">Mon compte</a></li>
        <li><a href="annonces.php">Annonces</a></li>
        <li><a href="messagerie.php">Messagerie</a></li>
        <?php if ($is_logged_in): ?>
            <li><a href="logout.php">Se déconnecter</a></li>
        <?php else: ?>
            <li><a href="login.php">Se connecter</a></li>
        <?php endif; ?>
    </ul>
</nav>