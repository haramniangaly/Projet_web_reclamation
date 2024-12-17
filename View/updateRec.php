<?php

include '../Controller/reclamationC.php';

$error = "";
$recController = new recController();
$reclamation = null;

// Fetch the reclamation for editing
if (isset($_GET["idrec"])) {
    $reclamation = $recController->showrec($_GET["idrec"]);
}

// Handle form submission
if (
    isset($_POST["idrec"]) &&
    isset($_POST["nomrec"]) &&
    isset($_POST["adressmail"]) &&
    isset($_POST["sujetrec"]) &&
    isset($_POST["descriptionrec"])
) {
    if (
        !empty($_POST["nomrec"]) &&
        !empty($_POST["adressmail"]) &&
        !empty($_POST["sujetrec"]) &&
        !empty($_POST["descriptionrec"])
    ) {
        // Update the reclamation
        $updatedRec = new rec(
            $_POST["idrec"], // ID (hidden field in form)
            $_POST["nomrec"], // Name
            $_POST["adressmail"], // Email
            $_POST["sujetrec"], // Subject
            $_POST["descriptionrec"] // Description
        );

        $recController->updaterec($updatedRec, $_POST["idrec"]);

        // Redirect after update
        header('Location: listRec.php');
        exit();
    } else {
        $error = "Informations manquantes.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mettre à jour une réclamation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #333;
        }

        .main-content {
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 400px;
        }

        h1 {
            font-size: 1.5rem;
            margin-bottom: 15px;
            color: #2c3e50;
            text-align: center;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            font-size: 1rem;
            margin-bottom: 5px;
            color: #333;
        }

        input,
        textarea {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
        }

        button {
            background-color: #3498db;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #2980b9;
        }

        a {
            display: inline-block;
            margin-top: 10px;
            font-size: 0.9rem;
            color: #3498db;
            text-decoration: none;
        }

        a:hover {
            color: #2980b9;
        }

        p {
            color: red;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="main-content">
        <h1>Mettre à jour la réclamation</h1>
        <?php if (!empty($error)) echo "<p>$error</p>"; ?>
        <form action="" method="POST">
            <input type="hidden" name="idrec" value="<?php echo htmlspecialchars($reclamation['idrec'] ?? ''); ?>">

            <label for="nomrec">Nom:</label>
            <input type="text" id="nomrec" name="nomrec" value="<?php echo htmlspecialchars($reclamation['nomrec'] ?? ''); ?>" required>

            <label for="adressmail">Email:</label>
            <input type="email" id="adressmail" name="adressmail" value="<?php echo htmlspecialchars($reclamation['adressmail'] ?? ''); ?>" required>

            <label for="sujetrec">Sujet:</label>
            <input type="text" id="sujetrec" name="sujetrec" value="<?php echo htmlspecialchars($reclamation['sujetrec'] ?? ''); ?>" required>

            <label for="descriptionrec">Description:</label>
            <textarea id="descriptionrec" name="descriptionrec" rows="4" required><?php echo htmlspecialchars($reclamation['descriptionrec'] ?? ''); ?></textarea>

            <button type="submit">Confirmer</button>
        </form>
        <a href="listRec.php">Retour à la liste</a>
    </div>
</body>

</html>
