<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $servername = "localhost";
    $usernameDB = "visiteur";
    $passwordDB = "1234";
    $dbname = "gsbV2";

    $conn = new mysqli($servername, $usernameDB, $passwordDB, $dbname);

    if ($conn->connect_error) {
        die("Erreur de connexion à la base de données : " . $conn->connect_error);
    }

    // Afficher les informations de connexion à la base de données pour débogage
    echo "Connecté avec succès à la base de données<br>";

    $sql = "SELECT * FROM comptes WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION["username"] = $username;
            $_SESSION["profil"] = $row['profil'];

            if ($row['profil'] === 'Visiteur') {
                header("Location: accueil_visiteur.php");
                exit();
            } elseif ($row['profil'] === 'Comptable') {
                header("Location: accueil_comptable.php");
                exit();
            }
        } else {
            $messageErreur = "Nom d'utilisateur ou mot de passe incorrect. Veuillez réessayer.";
        }
    } else {
        $messageErreur = "Nom d'utilisateur ou mot de passe incorrect. Veuillez réessayer.";
    }

    // Fermer la requête préparée
    $stmt->close();
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
