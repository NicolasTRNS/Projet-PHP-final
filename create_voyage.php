<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un nouveau voyage</title>
    <link rel="stylesheet" href="style.css">
    <script>
        function validateForm() {
            var destination = document.getElementById("destination").value;
            var dateDepart = document.getElementById("date_depart").value;

            if (destination.trim() === "") {
                alert("Veuillez entrer une destination.");
                return false;
            }

            if (dateDepart.trim() === "") {
                alert("Veuillez sélectionner une date de départ.");
                return false;
            }

            return true;
        }
    </script>
</head>
<body>
    <h2>Créer un nouveau voyage</h2>
    <form action="insert_voyage.php" method="post" onsubmit="return validateForm()">
        <div class="form-group">
            <label for="destination">Destination</label>
            <input type="text" id="destination" name="destination" required>
        </div>
        <div class="form-group">
            <label for="date_depart">Date de départ</label>
            <input type="date" id="date_depart" name="date_depart" required>
        </div>
        <div class="form-group">
            <input type="submit" value="Créer">
        </div>
    </form>
</body>
</html>
