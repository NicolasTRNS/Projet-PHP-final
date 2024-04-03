<?php
// Inclure le fichier de configuration de la base de données
include 'database.php';

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifier les données postées
    if(isset($_POST['destination']) && isset($_POST['date_depart']) && isset($_POST['createur_id'])) {
        // Récupérer les données postées
        $destination = $_POST['destination'];
        $date_depart = $_POST['date_depart'];
        $createur_id = $_POST['createur_id'];

        // Préparer et exécuter la requête d'insertion du voyage
        $stmt_insert_voyage = $conn->prepare("INSERT INTO voyages (destination, date_depart, createur_id) VALUES (?, ?, ?)");
        $stmt_insert_voyage->bind_param("ssi", $destination, $date_depart, $createur_id);
        $stmt_insert_voyage->execute();

        // Vérifier si l'insertion a réussi
        if ($stmt_insert_voyage) {
            echo "Le voyage a été créé avec succès.";
        } else {
            echo "Erreur lors de la création du voyage : " . $conn->error;
        }
    } else {
        echo "Veuillez remplir tous les champs du formulaire.";
    }
} else {
    echo "Erreur : Le formulaire n'a pas été soumis.";
}

// Fermeture de la connexion à la base de données
$conn->close();
?>
