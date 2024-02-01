<?php
session_start(); // Démarrer la session pour stocker les informations de connexion

// Fonction pour vérifier si l'utilisateur est connecté
function estConnecte() {
    return isset($_SESSION['username']);
}

// Fonction pour se déconnecter
function deconnexion() {
    session_unset(); // Effacer toutes les variables de session
    session_destroy(); // Détruire la session
}

// Vérifier si l'utilisateur est déjà connecté
if (estConnecte()) {
    // Rediriger vers la page appropriée selon le profil
    if ($_SESSION['profil'] === 'Visiteur') {
        header("Location: accueil_visiteur.php");
    } elseif ($_SESSION['profil'] === 'Comptable') {
        header("Location: accueil_comptable.php");
    }
    exit(); // Arrêter le script pour éviter l'exécution du reste du code
}

// Vérifier si le formulaire de connexion a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les informations d'identification
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Lecture des comptes à partir du fichier texte
    $comptes = file("comptes.txt", FILE_IGNORE_NEW_LINES);

    // Parcourir les comptes pour vérifier les informations d'identification
    foreach ($comptes as $ligne) {
        list($nomUtilisateur, $motDePasse, $profilUtilisateur) = explode(":", $ligne);
        if ($username === $nomUtilisateur && $password === $motDePasse) {
            // Stocker les informations de connexion dans la session
            $_SESSION["username"] = $username;
            $_SESSION["profil"] = $profilUtilisateur;

            // Rediriger vers la page appropriée selon le profil
            if ($profilUtilisateur === 'Visiteur') {
                header("Location: accueil_visiteur.php");
            } elseif ($profilUtilisateur === 'Comptable') {
                header("Location: accueil_comptable.php");
            }
            exit(); // Arrêter le script après la redirection
        }
    }

    // Si les informations d'identification ne sont pas valides, afficher un message d'erreur
    echo "Nom d'utilisateur ou mot de passe incorrect. Veuillez réessayer.";
}
?>
