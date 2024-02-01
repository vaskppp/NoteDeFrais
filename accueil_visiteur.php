<!-- Dans le fichier accueil_comptable.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <h1>Bienvenue, <?php echo $_SESSION["username"]; ?></h1>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="navbar">
    <a href="index.php">Accueil</a>
    <a href="login.html">Connexion</a>
    <a href="consulter_fiches_de_frais.php">consulter</a>
        <a href="renseigner_fiche_de_frais.php">renseigner</a>
</div>
    <h1>Accueil Visiteur</h1>
    <!-- Ajoutez le lien vers traitement_frais.php -->
    <a href="renseigner_fiche_de_frais.php">Saisir les frais</a>
    <a href="consulter_fiches_de_frais.php">Consulter les  frais</a>
    
    <!-- Autres éléments de la page accueil_comptable.php -->
</body>
</html>
