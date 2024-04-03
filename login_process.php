<?php
include 'database.php';

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifier si les champs username et password ont été remplis
    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Recherchez l'utilisateur dans la base de données
        $stmt_check_user = $conn->prepare("SELECT id, username, password FROM users WHERE username = ?");
        $stmt_check_user->bind_param("s", $username);
        $stmt_check_user->execute();
        $result = $stmt_check_user->get_result();

        if ($result->num_rows > 0) {
            // L'utilisateur existe, récupérer les informations de l'utilisateur
            $user_data = $result->fetch_assoc();
            $db_user_id = $user_data['id'];
            $db_password = $user_data['password'];

            // Vérifier le mot de passe
            if (password_verify($password, $db_password)) {
                // Le mot de passe est correct, connecter l'utilisateur
                session_start();
                $_SESSION['user_id'] = $db_user_id;
                $_SESSION['username'] = $username;
                header("Location: index.php");
                exit(); // Arrêter le script après la redirection
            } else {
                // Le mot de passe est incorrect
                echo "Nom d'utilisateur ou mot de passe incorrect.";
            }
        } else {
            // L'utilisateur n'existe pas, inscrivez-le
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt_insert_user = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
            $stmt_insert_user->bind_param("ss", $username, $hashed_password);
            $stmt_insert_user->execute();

            if ($stmt_insert_user) {
                // Connectez automatiquement l'utilisateur nouvellement inscrit
                $new_user_id = $stmt_insert_user->insert_id;
                session_start();
                $_SESSION['user_id'] = $new_user_id;
                $_SESSION['username'] = $username;
                header("Location: index.php");
                exit(); // Arrêter le script après la redirection
            } else {
                echo "Erreur lors de l'inscription : " . $conn->error;
            }
        }
    } else {
        // Les champs username et password ne sont pas remplis, afficher un message d'erreur
        echo "Veuillez remplir tous les champs.";
    }
} else {
    // Le formulaire n'a pas été soumis, afficher un message d'erreur
    echo "Erreur : Le formulaire n'a pas été soumis.";
}

// Fermeture de la connexion à la base de données
$conn->close();
?>
