<?php
// Connexion à la base de données (à adapter avec vos paramètres de connexion)
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "nom_de_la_base_de_donnees";

// Créer une connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}

// Récupérer le mois sélectionné par l'utilisateur
$mois = $_POST["mois"];

// Requête SQL pour récupérer les informations de la fiche de frais du mois sélectionné
$sql = "SELECT * FROM fiches_de_frais WHERE mois = '$mois' AND utilisateur_id = 'id_de_l_utilisateur_connecte'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Afficher les informations de la fiche de frais
    while($row = $result->fetch_assoc()) {
        echo "Date associée : " . $row["date_associée"] . "<br>";
        echo "Éléments forfaitisés : <br>";
        echo "Quantité pour chaque type de frais forfaitisé : <br>";
        // Afficher les éléments forfaitisés
        echo "Éléments non forfaitisés : <br>";
        // Afficher les éléments non forfaitisés
    }
} else {
    echo "Aucune fiche de frais disponible pour le mois sélectionné.";
}
$conn->close();
?>
