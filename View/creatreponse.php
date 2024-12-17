<?php
include '../Controller/reponseC.php';

// Initialiser le message d'erreur
$error = "";
$repController = new repController(); // Instancier le contrôleur

// Vérifier si l'ID de la réclamation est passé dans l'URL
if (isset($_GET['idrec'])) {
    $idrec = $_GET['idrec']; // Récupérer l'ID de la réclamation
    
    // Récupérer les détails de la réclamation
    $reclamation = $repController->getReclamationById($idrec);

    if (!$reclamation) {
        $error = "Réclamation introuvable.";
    }
} else {
    $error = "Aucune réclamation sélectionnée.";
}

// Gérer la soumission du formulaire
if (isset($_POST["reponse_rep"]) && isset($_POST["nom_rep"]) && isset($_POST["adressmail_rep"])) {
    if (!empty($_POST["reponse_rep"]) && !empty($_POST["nom_rep"]) && !empty($_POST["adressmail_rep"])) {
        // Créer un nouvel objet réponse
        $reponse = new reponse(
            $_GET['idrec'], // ID de la réclamation
            $_POST['reponse_rep'], // Réponse
            $_POST['nom_rep'], // Nom
            $_POST['adressmail_rep'] // Email
        );

        // Ajouter la réponse dans la base de données
        $repController->addreponse($reponse);

        // Rediriger vers la liste des réponses
        header('Location: listreponse.php');
        exit();
    } else {
        $error = "Tous les champs sont obligatoires.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contactez-nous : Réponse</title>
    <script src="JS/validation.js" defer></script>
    
    <!-- Inclusion des styles CSS -->
    <link rel="stylesheet" href="./reclamation.css">
    <link rel="stylesheet" href="./font.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            height: 100vh;
            color: #333;
        }

        .sidebar {
            width: 250px;
            background-color: #2c3e50;
            color: #ecf0f1;
            padding: 20px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        }

        .sidebar .logo {
            display: block;
            width: 100%;
            margin-bottom: 20px;
        }

        .sidebar-btn {
            display: block;
            color: #ecf0f1;
            text-decoration: none;
            font-size: 1rem;
            padding: 10px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .sidebar-btn:hover {
            background-color: #34495e;
        }

        .main-content {
            flex-grow: 1;
            padding: 20px;
            background-color: #f8f9fa;
        }

        .main-content h2 {
            font-size: 1.5rem;
            margin-bottom: 20px;
            color: #2c3e50;
        }

        .contact-form {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .contact-form label {
            display: block;
            margin-bottom: 8px;
            font-size: 1rem;
            color: #333;
        }

        .contact-form input,
        .contact-form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .contact-form button {
            background-color: #3498db;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .contact-form button:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        
        <a href="#" class="sidebar-btn">Réponse</a>
        <a href="listRec.php" class="sidebar-btn">Gestion des Réclamations</a>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <h2>Ajouter une Réponse</h2>

        <!-- Affichage du message d'erreur -->
        <?php if (!empty($error)): ?>
            <p style="color:red;"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>

        <!-- Formulaire pour ajouter une réponse -->
        <form id="reponseForm" class="contact-form" action="" method="POST">
            <label for="nom_rep">Nom :</label>
            <input type="text" id="nom_rep" name="nom_rep" value="<?php echo htmlspecialchars($reclamation['nomrec'] ?? ''); ?>">


            <label for="adressmail_rep">Email :</label>
            <input type="text" id="adressmail_rep" name="adressmail_rep" value="<?php echo htmlspecialchars($reclamation['adressmail'] ?? ''); ?>">

            <label for="reponse_rep">Réponse :</label>
            <textarea id="reponse_rep" name="reponse_rep" rows="4"></textarea>

            <button type="submit">Confirmer</button>
        </form>
    </div>
</body>
</html>
