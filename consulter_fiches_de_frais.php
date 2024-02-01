<?php
// Connexion à la base de données (à adapter avec vos paramètres de connexion)
$servername = "localhost";
$username = "visiteur";
$password = "1234";
$dbname = "base";

// Créer une connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}

// Requête SQL pour sélectionner toutes les lignes de la table fiches_de_frais
$sql = "SELECT * FROM fiches_de_frais";

$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulter fiches de frais</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="navbar">
        <a href="accueil_visiteur.php">Accueil</a>
        <a href="login.html">Connexion</a>
        <a href="consulter_fiches_de_frais.html">consulter</a>
        <a href="renseigner_fiche_de_frais.php">renseigner</a>
    </div>
    <div class="fiches-container">
        <h2>Consulter fiches de frais</h2>
        <form action="consulter_fiches_de_frais.php" method="post">
            <label for="mois">Sélectionner un mois :</label>
            <select id="mois" name="mois" required>
                <!-- Options de sélection des mois -->
                <!-- Vous pouvez générer dynamiquement les options en fonction des mois disponibles pour l'utilisateur -->
                <option value="01">Janvier</option>
                <option value="02">Février</option>
                <!-- Ajoutez les autres mois jusqu'au mois actuel -->
            </select>
            <input type="submit" value="Valider">
        </form>
    </div>

    <div class="content">
        <!-- Contenu de la page -->
        <?php
        if ($result->num_rows > 0) {
            // Afficher les données de chaque ligne
            while($row = $result->fetch_assoc()) {
                echo "ID: " . $row["id"]. "<br>";
                echo "Etape: " . $row["etape"]. "<br>";
                echo "Kilomètres: " . $row["kilometres"]. "<br>";
                echo "Nuitées: " . $row["nuitees"]. "<br>";
                echo "Repas: " . $row["repas"]. "<br>";
                echo "Date: " . $row["date"]. "<br>";
                echo "Libellé: " . $row["libelle"]. "<br>";
                echo "Montant: " . $row["montant"]. "<br>";
                echo "<hr>"; // Séparateur entre chaque ligne
            }
        } else {
            echo "Aucune fiche de frais disponible.";
        }
        $conn->close();
        ?>
    </div>
</body>
</html>
<?php
session_start(); // Démarrer la session pour stocker les informations de connexion

// Vérifier si l'utilisateur est connecté
if(!isset($_SESSION["username"])) {
    header("Location: login.php"); // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    exit(); // Arrêter le script
}

// Vérifier si le bouton de déconnexion a été cliqué
if (isset($_POST["logout"])) {
    session_unset(); // Effacer toutes les variables de session
    session_destroy(); // Détruire la session
    header("Location: login.php"); // Rediriger vers la page de connexion après la déconnexion
    exit(); // Arrêter le script
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page protégée</title>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <input type="submit" name="logout" value="Déconnexion">
    </form>
</body>
</html>
