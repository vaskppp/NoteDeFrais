<?php
session_start(); // Démarrer la session pour stocker les informations de connexion


// Vérifier si le formulaire de connexion a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les informations d'identification
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Connexion à la base de données
    $servername = "localhost";
    $usernameDB = "visiteur";
    $passwordDB = "1234";
    $dbname = "base";

    $conn = new mysqli($servername, $usernameDB, $passwordDB, $dbname);

    // Vérifier la connexion
    if ($conn->connect_error) {
        die("Erreur de connexion à la base de données : " . $conn->connect_error);
    }

    // Requête SQL pour récupérer les informations du compte
    $sql = "SELECT * FROM comptes WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Compte trouvé, vérifier le mot de passe
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // Mot de passe correct, stocker les informations de connexion dans la session
            $_SESSION["username"] = $username;
            $_SESSION["profil"] = $row['profil'];

            // Rediriger vers la page appropriée selon le profil
            if ($row['username'] === 'Visiteur') {
                header("Location: accueil_visiteur.php");
                exit(); // Arrêter le script après la redirection
            } elseif ($row['username'] === 'Comptable') {
                header("Location: accueil_comptable.php");
                exit(); // Arrêter le script après la redirection
            }
        } else {
            // Mot de passe incorrect
            $messageErreur = "Nom d'utilisateur ou mot de passe incorrect. Veuillez réessayer.";
        }
    } else {
        // Compte non trouvé
        $messageErreur = "Nom d'utilisateur ou mot de passe incorrect. Veuillez réessayer.";
    }

    // Fermer la connexion à la base de données
    $conn->close();
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
