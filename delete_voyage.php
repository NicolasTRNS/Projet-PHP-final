<?php
// Inclure le fichier de configuration de la base de données
include 'database.php';

// Vérifier si l'ID du voyage est passé en tant que paramètre dans l'URL
if(isset($_GET["id"])) {
    // Récupérer l'ID du voyage à supprimer
    $voyage_id = $_GET["id"];

    // Requête SQL pour supprimer le voyage
    $sql_delete_voyage = "DELETE FROM voyages WHERE id = ?";
    $stmt_delete_voyage = $conn->prepare($sql_delete_voyage);

    // Vérifier si la préparation de la requête a réussi
    if ($stmt_delete_voyage) {
        $stmt_delete_voyage->bind_param("i", $voyage_id);

        // Exécuter la requête de suppression du voyage
        if ($stmt_delete_voyage->execute()) {
            echo "Le voyage a été supprimé avec succès.";
        } else {
            echo "Erreur lors de la suppression du voyage : " . $stmt_delete_voyage->error;
        }
    } else {
        echo "Erreur lors de la préparation de la requête de suppression du voyage : " . $conn->error;
    }
} else {
    echo "L'ID du voyage n'a pas été spécifié dans l'URL.";
}

// Fermeture de la connexion à la base de données
$conn->close();
?>
