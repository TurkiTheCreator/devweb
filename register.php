<?php

require("config.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = trim($_POST["name"]);
    $prenom = trim($_POST["prenom"]);
    $email = trim($_POST["mail"]);
    $password = $_POST["password"];
    $confirm_password = $_POST["password_conf"];

    if (strlen($password) < 10) {
        die("Le mot de passe doit contenir au moins 10 caractères");
    }

    // Vérifier si les mots de passe correspondent
    if ($password !== $confirm_password) {
        die("Les mots de passe ne correspondent pas !");
    }

    // Hacher le mot de passe
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Vérifier si l'utilisateur existe déjà
    $sql = "SELECT * FROM utilisateurs WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch();

    if ($user) {
        die("Cet utilisateur existe déjà !");
    }

    try {
        // Insérer les données dans la base de données
        $sql = "INSERT INTO utilisateurs (nom, prenom, email, mot_de_passe) VALUES (:nom, :prenom, :email, :mot_de_passe)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'nom' => $nom,
            'prenom' => $prenom,
            'email' => $email,
            'mot_de_passe' => $hashed_password,
        ]);

        // Après avoir inséré les données dans la base
        $_SESSION["user_name"] = $prenom; 
        header("Location: home.php");
        exit;
    } catch (PDOException $e) {
        die("Erreur lors de l'enregistrement : " . $e->getMessage());
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>créer un compte</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="bg-secondary">
    <form action="register.php" class="p-3 mt-3 rounded shadow container bg-light" method="post">
        <h1 class="text-center text-danger">s'inscrire</h1>

        <label for="name" class="form-label">Nom</label>
        <input required type="text" class="form-control" id="name" name="name">

        <label for="prenom" class="form-label">Prénom</label>
        <input required type="text" class="form-control" id="prenom" name="prenom">

        <label for="mail" class="form-label">Email</label>
        <input required type="email" class="form-control" id="mail" name="mail">

        <label for="password" class="form-label">Mot de passe</label>
        <input required type="password" class="form-control" id="password" name="password">

        <label for="password_conf" class="form-label">Confirmer le mot de passe</label>
        <input required type="password" class="form-control" id="password_conf" name="password_conf">

        <br>
        <input type="submit" value="créer mon compte" class="mt-3 btn btn-primary">
        <a href="login.php" class="mt-3 ms-4 btn btn-outline-primary">se connecter</a>
    </form>
</body>
</html>