<?php 

include '../Controller/reponseC.php';

$error = "";
$recController = new repController();
$reclamation = null;

// Vérification de l'existence de l'ID de la réponse et récupération des données
if (isset($_GET["id_rep"])) {
    $reclamation = $recController->showreponse($_GET["id_rep"]);
    if (!$reclamation) {
        echo "<p style='color:red;'>Réponse introuvable.</p>";
        exit;
    }
}

// Gestion de la soumission du formulaire
if (
    isset($_POST["id_rep"]) &&
    isset($_POST["nom_rep"]) &&
    isset($_POST["adressmail_rep"]) &&
    isset($_POST["reponse_rep"])
) {
    if (
        !empty($_POST["nom_rep"]) &&
        !empty($_POST["adressmail_rep"]) &&
        !empty($_POST["reponse_rep"])
    ) {
        // Mise à jour de la réponse
        $updatedRep = new reponse(
            $_POST["id_rep"], // ID
            $_POST["reponse_rep"], // Réponse
            $_POST["nom_rep"], // Nom
            $_POST["adressmail_rep"] // Email
        );

        // Appel à la méthode du contrôleur pour mettre à jour la réponse
        $recController->updatereponses($updatedRep, $_POST["id_rep"]);

        // Redirection après la mise à jour
        header('Location: listreponse.php');
        exit();
    } else {
        $error = "Veuillez remplir tous les champs.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mettre à jour la réponse</title>
    <style>
        /* CSS intégré */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f9;
            color: #333;
        }

        .container {
            background: #fff;
            width: 400px;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        h1 {
            font-size: 1.5rem;
            text-align: center;
            margin-bottom: 20px;
            color: #2c3e50;
        }

        .error-message {
            color: red;
            font-size: 0.9rem;
            text-align: center;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        label {
            font-size: 1rem;
            color: #333;
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
            box-sizing: border-box;
        }

        button {
            padding: 10px;
            border: none;
            background-color: #3498db;
            color: #fff;
            font-size: 1rem;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s ease;
        }

        button:hover {
            background-color: #2980b9;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 10px;
            color: #3498db;
            text-decoration: none;
            font-size: 0.9rem;
        }

        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Mettre à jour la réponse</h1>
        
        <!-- Affichage du message d'erreur s'il y en a -->
        <?php if (!empty($error)) echo "<p class='error-message'>$error</p>"; ?>
        
        <!-- Formulaire de mise à jour -->
        <form action="" method="POST">
            <input type="hidden" name="id_rep" value="<?php echo htmlspecialchars($reclamation['id_rep'] ?? ''); ?>">

            <label for="nom_rep">Nom :</label>
            <input type="text" id="nom_rep" name="nom_rep" value="<?php echo htmlspecialchars($reclamation['nom_rep'] ?? ''); ?>" required>

            <label for="adressmail_rep">Email :</label>
            <input type="email" id="adressmail_rep" name="adressmail_rep" value="<?php echo htmlspecialchars($reclamation['adressmail_rep'] ?? ''); ?>" required>

            <label for="reponse_rep">Réponse :</label>
            <textarea id="reponse_rep" name="reponse_rep" rows="4" required><?php echo htmlspecialchars($reclamation['reponse_rep'] ?? ''); ?></textarea>

            <button type="submit">Confirmer</button>
        </form>
        
        <!-- Lien pour revenir à la liste des réponses -->
        <a href="listreponse.php" class="back-link">Retour à la liste</a>
    </div>
</body>

</html>
