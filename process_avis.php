<?php
// Inclure le fichier de configuration de la base de données
include 'database.php';

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer l'ID du voyage à partir des données postées
    $voyage_id = $_POST['voyage_id'];

    // Vérifier si le commentaire est vide
    if (!empty($_POST['commentaire'])) {
        // Préparer et exécuter la requête d'insertion du commentaire avec le bon voyage
        $stmt_insert_commentaire = $conn->prepare("INSERT INTO commentaires (voyage_id, commentaire) VALUES (?, ?)");
        $stmt_insert_commentaire->bind_param("is", $voyage_id, $_POST['commentaire']);
        $stmt_insert_commentaire->execute();

        // Vérifier si l'insertion a réussi
        if ($stmt_insert_commentaire) {
            echo "Votre avis a été enregistré avec succès.";
        } else {
            echo "Erreur lors de l'enregistrement de votre avis : " . $conn->error;
        }
    } else {
        echo "Veuillez saisir un commentaire.";
    }
} else {
    echo "Erreur : Le formulaire n'a pas été soumis.";
}

// Fermeture de la connexion à la base de données
$conn->close();
?>
