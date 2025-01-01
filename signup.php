<?php
// Connexion à la base de données
$conn = new mysqli('localhost', 'root', '', 'fitness_360');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Vérification si la méthode est POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty(trim($_POST['name'])) && isset($_POST['email']) && isset($_POST['passwd'])) {
        $nom = trim($_POST['name']);
        $email = trim($_POST['email']);
        $password = trim($_POST['passwd']);

        // Hacher le mot de passe
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Préparer la requête d'insertion
        $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nom, $email, $hashed_password);

        // Exécuter la requête
        if ($stmt->execute()) {
            // Rediriger vers la page de login
            header("Location: login.php");
            exit();
        } else {
            echo "Erreur : " . $stmt->error;
        }

        // Fermer la requête
        $stmt->close();
    } else {
        echo "Veuillez remplir tous les champs.";
    }
}

// Fermer la connexion
$conn->close();
?>
