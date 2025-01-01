<?php
// Connexion à la base de données
$conn = new mysqli('localhost', 'root', '', 'fitness_360');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Vérification si la méthode est POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty(trim($_POST['email'])) && !empty(trim($_POST['passwd']))) {
        $email = trim($_POST['email']);
        $password = trim($_POST['passwd']);

        // Préparer la requête pour récupérer l'utilisateur
        $stmt = $conn->prepare("SELECT password FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // Lier le mot de passe haché récupéré
            $stmt->bind_result($hashed_password);
            $stmt->fetch();

            // Vérifier le mot de passe avec password_verify()
            if (password_verify($password, $hashed_password)) {
                // Connexion réussie
                header("Location: index.php");
                exit();
            } else {
                echo "Mot de passe incorrect.";
            }
        } else {
            echo "Email non trouvé.";
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
