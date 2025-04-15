<?php

require("config.php");

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    // Vérifier si l'utilisateur existe
    $sql = "SELECT * FROM utilisateurs WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user["mot_de_passe"])) {
        // Stocker le prénom dans la session
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["user_name"] = $user["prenom"]; 
        header("Location: home.php");
        exit;
    } else {
        $error = "Email ou mot de passe incorrect.";
        
    }
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Se connecter</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="bg-secondary">
    <form action="login.php" class="p-3 mt-3 rounded shadow container bg-light" method="post">
        <h1 class="text-center text-danger">Se connecter</h1>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <label for="email" class="form-label">Email</label>
        <input required type="email" class="form-control" id="email" name="email">

        <label for="password" class="form-label">Mot de passe</label>
        <input required type="password" class="form-control" id="password" name="password">

        <br>
        <input type="submit" value="Se connecter" class="mt-3 btn btn-primary">
        <a href="register.php" class="mt-3 ms-4 btn btn-outline-primary">Créer un compte</a>
    </form>
</body>
</html>

