<?php
// Start the session
session_start();

// Check if $_SESSION["username"] is set
if(isset($_SESSION["username"])) {
    $username = $_SESSION["username"];
} else {
    $username = "Guest"; // Provide a default value if $_SESSION["username"] is not set
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil Visiteur</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="navbar">
        <a href="index.php">Accueil</a>
        <a href="login.php">Connexion</a>
        <a href="consulter_fiches_de_frais.php">Consulter</a>
        <a href="renseigner_fiche_de_frais.php">Renseigner</a>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <input type="submit" name="logout" value="Déconnexion">
    </form>
    </div>
    <h1>Bienvenue, <?php echo $username; ?></h1>
    <!-- Ajoutez le lien vers traitement_frais.php -->
    <a href="renseigner_fiche_de_frais.php">Saisir les frais</a>
    <a href="consulter_fiches_de_frais.php">Consulter les frais</a>
    
    <!-- Autres éléments de la page accueil_comptable.php -->
</body>
</html>

