<?php
include 'database.php';

// Affichage de la liste des voyages
$sql = "SELECT id, destination, date_depart FROM voyages";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "Destination: " . $row["destination"]. " - Date de départ: " . $row["date_depart"] . " <a href='delete_voyage.php?id=" . $row["id"] . "'>Supprimer</a> | <a href='donner_avis.php?voyage_id=" . $row["id"] . "'>Donner son avis</a><br>";

        // Afficher les commentaires associés à ce voyage
        $voyage_id = $row["id"];
        $sql_commentaires = "SELECT commentaire, date_publication FROM commentaires";
        $result_commentaires = $conn->query($sql_commentaires);

        if ($result_commentaires->num_rows > 0) {
            while($row_commentaire = $result_commentaires->fetch_assoc()) {
                echo "Commentaire: " . $row_commentaire["commentaire"] . " - Date de publication: " . $row_commentaire["date_publication"] . "<br>";
            }
        } else {
            echo "Aucun commentaire trouvé pour ce voyage.<br>";
        }
    }
} else {
    echo "Aucun voyage trouvé.";
}
?>
