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
    $username = "votre_nom_utilisateur";
    $password = "votre_mot_de_passe";
    $dbname = "base.sql";

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

    // Fermer la connexion
    $conn->close();
}
?>
