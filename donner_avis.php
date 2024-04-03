<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donner son avis</title>
    <link rel="stylesheet" href="style.css"> <!-- Assurez-vous d'avoir un fichier style.css pour le stylisme -->
</head>
<body>
    <h2>Donner son avis sur le voyage</h2>
    <form action="process_avis.php" method="post"> <!-- Assurez-vous de créer le fichier process_avis.php pour gérer le traitement du formulaire -->
        <div class="form-group">
            <label for="voyage">Choisir le voyage :</label>
            <select name="voyage_id" id="voyage">
                <?php
                // Inclure le fichier de configuration de la base de données
                include 'database.php';

                // Requête pour récupérer les voyages disponibles depuis la base de données
                $sql = "SELECT id, destination FROM voyages";
                $result = $conn->query($sql);

                // Vérifier s'il y a des voyages disponibles
                if ($result->num_rows > 0) {
                    // Afficher chaque voyage comme une option dans la liste déroulante
                    while($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row["id"] . "'>" . $row["destination"] . "</option>";
                    }
                } else {
                    echo "<option value=''>Aucun voyage trouvé</option>";
                }

                // Fermer la connexion à la base de données
                $conn->close();
                ?>
            </select>
        </div>
        <div class="form-group">
            <label>Votre commentaire</label>
            <textarea name="commentaire" required></textarea>
        </div>
        <div class="form-group">
            <input type="submit" value="Envoyer">
        </div>
    </form>
</body>
</html>
