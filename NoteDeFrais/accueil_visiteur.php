<?php
// Start the session
session_start();

// Check if $_SESSION["username"] is set
if(isset($_SESSION["username"])) {
    $username = $_SESSION["username"];
    $user_role = isset($_SESSION["user_role"]) ? $_SESSION["user_role"] : "Visiteur";
} else {
    $username = "Non connecté";
    $user_role = "Visiteur";
}

// Check if the logout button is clicked
if(isset($_POST["logout"])) {
    // Unset all session variables
    $_SESSION = array();

    // Destroy the session
    session_destroy();

    // Redirect to index.php or any other page after logout
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil Visiteur</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Styles CSS supplémentaires */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .navbar {
            background-color: #333;
            overflow: hidden;
        }
        .navbar a {
            float: left;
            display: block;
            color: #f2f2f2;
            text-align: center;
            padding: 14px 20px;
            text-decoration: none;
        }
        .navbar a:hover {
            background-color: #ddd;
            color: black;
        }
        .navbar a.active {
            background-color: #ddd;
            color: black;
        }
        h1 {
            text-align: center;
            margin-top: 50px;
        }
        .content {
            text-align: center;
            margin-top: 20px;
        }
        .button {
            background-color: #4CAF50; /* Green */
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 8px;
        }
        .logout-form {
            text-align: center;
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <a href="index.php">Accueil</a>
        <a href="consulter_fiches_de_frais.php">Consulter</a>
        <a href="renseigner_fiche_de_frais.php">Renseigner</a>
        <span style="float:right; padding: 14px 20px; color: white;"> <?php echo $username; ?></span>
    </div>
    
    <h1>Bienvenue, <?php echo $username; ?>!</h1>
    
    <div class="content">
        <?php if($user_role === "Visiteur") : ?>
            <a href="renseigner_fiche_de_frais.php" class="button">Saisir les frais</a>
            <a href="consulter_fiches_de_frais.php" class="button">Consulter les frais</a>
        <?php elseif($user_role === "Comptable") : ?>
            <!-- Ajoutez des liens ou des actions spécifiques aux comptables -->
        <?php endif; ?>
    </div>
    
    <form method="post" class="logout-form">
        <button type="submit" name="logout" class="button">Déconnexion</button>
    </form>
</body>
</html>
