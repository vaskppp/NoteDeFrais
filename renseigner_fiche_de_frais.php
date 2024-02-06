<?php
// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $etape = $_POST["etape"];
    $kilometres = $_POST["kilometres"];
    $nuitees = $_POST["nuitees"];
    $repas = $_POST["repas"];
    $date = $_POST["date"];
    $libelle = $_POST["libelle"];
    $montant = $_POST["montant"];
    
    // Valider les données (vous pouvez ajouter des validations supplémentaires ici)
    if (!is_numeric($etape) || !is_numeric($kilometres) || !is_numeric($nuitees) || !is_numeric($repas) || !is_numeric($montant)) {
        echo "Erreur : Les valeurs des frais doivent être numériques.";
        exit(); // Arrêter le script
    }

    // Connexion à votre système de stockage (par exemple, une base de données)
    // Remplacez les valeurs ci-dessous par vos propres informations de connexion
    $servername = "localhost";
    $username = "visiteur";
    $password = "1234";
    $dbname = "base";

    // Créer une connexion
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Vérifier la connexion
    if ($conn->connect_error) {
        die("Erreur de connexion à la base de données : " . $conn->connect_error);
    }

    // Préparer et exécuter la requête SQL pour insérer les données dans votre système de stockage
    $sql = "INSERT INTO fiches_de_frais (etape, kilometres, nuitees, repas, date, libelle, montant)
    VALUES ('$etape', '$kilometres', '$nuitees', '$repas', '$date', '$libelle', '$montant')";

    if ($conn->query($sql) === TRUE) {
        echo "Fiche de frais enregistrée avec succès.";
    } else {
        echo "Erreur lors de l'enregistrement de la fiche de frais : " . $conn->error;
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
    <title>Renseigner fiche de frais</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    
<div class="navbar">
    <a href="accueil_visiteur.php">Accueil</a>
    <a href="login.php">Connexion</a>
    <a href="consulter_fiches_de_frais.php">Consulter</a>
    <a href="renseigner_fiche_de_frais.php">Renseigner</a>
</div>

<div class="frais-container">
    <h2>Renseigner fiche de frais</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <h3>Frais forfaitaires :</h3>
        <label for="etape">Forfait Etape :</label>
        <input type="text" id="etape" name="etape" value="0"> (aucun)
        
        <label for="kilometres">Frais kilométriques :</label>
        <input type="text" id="kilometres" name="kilometres" value="750"> km
        
        <label for="nuitees">Nuitée hôtel :</label>
        <input type="text" id="nuitees" name="nuitees" value="9"> nuits
        
        <label for="repas">Repas restaurant :</label>
        <input type="text" id="repas" name="repas" value="12"> repas
        
        <!-- Champs pour les frais hors forfait -->
        <h3>Frais hors forfait :</h3>
        <label for="date">Date :</label>
        <input type="date" id="date" name="date" required>
        
        <label for="libelle">Libellé :</label>
        <input type="text" id="libelle" name="libelle" required>
        
        <label for="montant">Montant :</label>
        <input type="text" id="montant" name="montant" required>
        
        <input type="submit" value="Valider">
    </form>
</div>

</body>
</html>

<style>body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
}

.frais-container {
    max-width: 600px;
    margin: 20px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

h2, h3 {
    margin-bottom: 10px;
}

label {
    display: block;
    margin-bottom: 5px;
}

input[type="text"],
input[type="date"] {
    width: 100%;
    padding: 8px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

input[type="submit"] {
    background-color: #4caf50;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #45a049;
}
</style>
