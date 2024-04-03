<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Informations d'identification MySQL
$host_name = 'db5015586453.hosting-data.io'; // Nom d'hôte
$database = 'dbs12730233'; // Nom de la base de données
$user_name = 'dbu3547471'; // Nom d'utilisateur MySQL
$password = '200060578478500Dunico&2004'; // Mot de passe MySQL
$port = 3306; // Port MySQL

// Connexion à la base de données MySQL
$conn = new mysqli($host_name, $user_name, $password, $database, $port);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    // Afficher un message de succès si la connexion est établie
    echo '<p>Connexion au serveur MySQL établie avec succès.</p>';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Voyages</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* CSS pour définir l'image en fond d'écran */
        body {
            background-image: url('voyage.jpg'); /* Chemin relatif vers votre image */
            background-size: cover; /* Redimensionner l'image pour couvrir tout l'élément */
            background-position: center; /* Centrer l'image */
            background-repeat: no-repeat; /* Ne pas répéter l'image */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Liste des Voyages</h1>
        
        <?php 
            // Inclure la liste des voyages depuis voyages.php
            include 'voyages.php'; 
            
            // Afficher le formulaire de création de voyage
            include 'create_voyage.php';

            // Afficher le formulaire de suppression de voyage
            include 'delete_voyage.php';

            // Afficher le formulaire pour donner son avis
            include 'donner_avis.php';
            
            // Bouton pour se déconnecter
            echo "<a href='logout.php'>Se déconnecter</a>";
        ?>

        <!-- Contenu de la page -->    
    </div>
</body>
</html>
