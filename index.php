<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .login-button {
            display: block;
            width: 200px;
            margin: 20px auto;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
            font-size: 18px;
        }

        .login-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="navbar">
    <a href="index.php">Accueil</a>
    <a href="login.php">Connexion</a>
</div>

<div class="content">
    <h2>Bienvenue sur la page d'accueil</h2>
    <!-- Contenu de la page d'accueil -->
    <a href="login.php" class="login-button">Connexion</a>
</div>

</body>
</html>
<?php
session_start();

// Fonction pour lire les comptes depuis le fichier texte
function lireComptes($fichier) {
    $comptes = [];
    $handle = fopen($fichier, "r");
    if ($handle !== false) {
        while (($data = fgetcsv($handle, 1000, ",")) !== false) {
            $comptes[] = $data;
        }
        fclose($handle);
    }
    return $comptes;
}

// Vérifier si le formulaire de connexion a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les informations d'identification
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Chemin vers le fichier contenant les comptes
    $fichierComptes = "comptes.txt";

    // Lire les comptes depuis le fichier
    $comptes = lireComptes($fichierComptes);

    // Vérifier les informations d'identification
    $identifiantsCorrects = false;
    foreach ($comptes as $compte) {
        if ($compte[0] == $username && $compte[1] == $password) {
            $identifiantsCorrects = true;
            $_SESSION["username"] = $username;
            $_SESSION["profil"] = $compte[2];
            break;
        }
    }

    // Rediriger l'utilisateur si les informations d'identification sont correctes
    if ($identifiantsCorrects) {
        if ($_SESSION['profil'] === 'Visiteur') {
            header("Location: accueil_visiteur.php");
            exit();
        } elseif ($_SESSION['profil'] === 'Comptable') {
            header("Location: accueil_comptable.php");
            exit();
        }
    } else {
        $messageErreur = "Nom d'utilisateur ou mot de passe incorrect. Veuillez réessayer.";
    }
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de connexion</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="login-container">
        <h2>Connexion</h2>
        <?php if (isset($messageErreur)) : ?>
            <div class="error-message"><?php echo $messageErreur; ?></div>
        <?php endif; ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="username">Nom d'utilisateur :</label>
            <input type="text" id="username" name="username" required>
            
            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" required>
            
            <input type="submit" value="Se connecter">
        </form>
    </div>
</body>
</html>
