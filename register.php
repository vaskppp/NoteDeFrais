<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les informations du formulaire
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Validation des informations (exemple simplifié)
    if (!empty($username) && !empty($password)) {
        // Enregistrer le compte dans une base de données ou un autre système de stockage
        // Exemple : enregistrement dans un fichier texte (à des fins de démonstration uniquement)
        $data = $username . ":" . $password . "\n";
        file_put_contents("comptes.txt", $data, FILE_APPEND);

        // Redirection vers la page de connexion après la création du compte
        header("Location: login.html");
        exit();
    } else {
        echo "Veuillez saisir un nom d'utilisateur et un mot de passe.";
    }
}
?>
