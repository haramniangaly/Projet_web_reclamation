<?php
include '../Controller/reponseC.php';  // Inclure le contrôleur qui récupère les réponses
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voir les Réponses</title>
    <style>
        /* Insérez le CSS ici */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            height: 100vh;
            color: #333;
            background-color: #f8f9fa;
        }

        .main-content {
            flex-grow: 1;
            padding: 20px;
            max-width: 800px;
            margin: auto;
        }

        .main-content h2 {
            font-size: 2rem;
            margin-bottom: 20px;
            color: #2c3e50;
            text-align: center;
        }

        .response-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            overflow: hidden;
        }

        .response-table th,
        .response-table td {
            padding: 10px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .response-table th {
            background-color: #2c3e50;
            color: #ecf0f1;
            font-size: 1rem;
        }

        .response-table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .response-table tr:hover {
            background-color: #e1f5fe;
        }

        .response-table td {
            font-size: 0.9rem;
        }

        p {
            text-align: center;
            color: #555;
            font-size: 1rem;
        }
    </style>
</head>
<body>
    <div class="main-content">
        <h2>Réponses à la Réclamation</h2>

        <?php
        if (isset($_GET['idrec'])) { // Vérification de l'ID de la réclamation
            $repController = new repController();
            $reponses = $repController->listreponsesByReclamation($_GET['idrec']);

            if (empty($reponses)) {
                echo "<p>Aucune réponse pour cette réclamation.</p>";
            } else {
                // Création d'un tableau
                echo "<table class='response-table'>";
                echo "<thead>";
                echo "<tr><th>ID Réponse</th><th>Réponse</th><th>Nom</th><th>Email</th></tr>";
                echo "</thead>";
                echo "<tbody>";
                foreach ($reponses as $reponse) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($reponse['id_rep']) . "</td>";
                    echo "<td>" . htmlspecialchars($reponse['reponse_rep']) . "</td>";
                    echo "<td>" . htmlspecialchars($reponse['nom_rep']) . "</td>";
                    echo "<td>" . htmlspecialchars($reponse['adressmail_rep']) . "</td>";
                    echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";
            }
        } else {
            echo "<p>ID de réclamation non spécifié.</p>";
        }
        ?>
    </div>
</body>
</html>
