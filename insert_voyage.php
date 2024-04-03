<?php
include 'database.php';

// Vérification de l'existence et de la validité des données POST
if(isset($_POST["destination"]) && isset($_POST["date_depart"])) {
    // Récupération des données du formulaire
    $destination = $_POST["destination"];
    $date_depart = $_POST["date_depart"];
    
    // Vérification de la validité de la date de départ
    if (strtotime($date_depart) === false) {
        echo "La date de départ est invalide.";
        exit(); // Arrêter l'exécution du script si la date est invalide
    }
    
    // Récupération de l'ID de l'utilisateur actuel depuis la session
    session_start();
    if(isset($_SESSION['user_id'])) {
        $createur_id = $_SESSION['user_id'];

        // Requête SQL pour insérer un nouveau voyage dans la base de données
        $sql = "INSERT INTO voyages (destination, date_depart, createur_id) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $destination, $date_depart, $createur_id);

        if ($stmt->execute()) {
            echo "Le voyage a été créé avec succès.";
        } else {
            echo "Erreur lors de la création du voyage : " . $stmt->error;
        }
    } else {
        echo "Utilisateur non connecté.";
    }
} else {
    echo "Les données du formulaire sont invalides.";
}

// Fermeture de la connexion à la base de données
$conn->close();
?>
