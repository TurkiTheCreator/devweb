<?php
// filepath: c:\xampp\htdocs\php\leboncoin\logout.php
session_start();

// Détruire toutes les données de la session
session_unset();
session_destroy();

// Rediriger vers la page de connexion
header("Location: login.php");
exit;
?>