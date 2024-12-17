<?php

include '../Controller/reclamationC.php';

// Créer une instance du contrôleur et récupérer la liste des réclamations
$recController = new recController();
$list = $recController->listrecs();

?>
<!DOCTYPE html> 
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Réclamations</title>
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            height: 100vh;
            color: #333;
        }

        /* Sidebar Styles */
        .sidebar {
            width: 250px;
            -color: #2c3e50;
            color: #ecf0f1;
            padding: 20px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        }

        .sidebar img.logo {
            width: 100%;
            margin-bottom: 20px;
            border-radius: 8px;
        }

        .sidebar-btn {
            display: block;
            text-decoration: none;
            color: #ecf0f1;
            font-size: 1rem;
            padding: 10px 15px;
            border-radius: 5px;
            margin-bottom: 10px;
            background-color: #34495e;
            text-align: center;
            transition: -color 0.3s ease;
        }

        .sidebar-btn:hover {
            -color: #1abc9c;
        }

        /* Main Content Styles */
        .main-content {
            flex-grow: 1;
            padding: 20px;
            background-color: #f8f9fa;
        }

        .main-content h2 {
            font-size: 2rem;
            margin-bottom: 20px;
            color: #2c3e50;
        }

        .complaints-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            : #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            overflow: hidden;
        }

        .complaints-table th,
        .complaints-table td {
            padding: 10px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .complaints-table th {
            -color: #2c3e50;
            color: #ecf0f1;
            font-size: 1rem;
        }

        .complaints-table tr:nth-child(even) {
            -color: #f2f2f2;
        }

        .complaints-table tr:hover {
            -color: #e1f5fe;
        }

        .complaints-table a {
            color: #3498db;
            text-decoration: none;
            font-weight: bold;
            margin: 0 5px;
            transition: color 0.3s ease;
        }

        .complaints-table a:hover {
            color: #1abc9c;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        
        <a href="listreponse.php" class="sidebar-btn">Gestion des réponses</a>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <h2>Gestion des Réclamations</h2>
        <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names..">
        <table class="complaints-table" id="myTable">
            <thead>
                <tr>
                    <th class="sortable">ID <span>&#x2195;</span></th>
                    <th class="sortable">Nom <span>&#x2195;</span></th>
                    <th class="sortable">Email <span>&#x2195;</span></th>
                    <th class="sortable">Sujet <span>&#x2195;</span></th>
                    <th class="sortable">Message <span>&#x2195;</span></th>
                    <th class="sortable">Date de Création <span>&#x2195;</span></th>
                    <th class="sortable">Statut <span>&#x2195;</span></th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($list as $reclamation): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($reclamation["idrec"]); ?></td>
                        <td><?php echo htmlspecialchars($reclamation["nomrec"]); ?></td>
                        <td><?php echo htmlspecialchars($reclamation["adressmail"]); ?></td>
                        <td><?php echo htmlspecialchars($reclamation["sujetrec"]); ?></td>
                        <td><?php echo htmlspecialchars($reclamation["descriptionrec"]); ?></td>
                        <td><?php echo htmlspecialchars($reclamation["date_creation"]); ?></td>
                        <td><?php echo htmlspecialchars($reclamation["statut_rec"]); ?></td>
                        <td>
                            <a href="updateRec.php?idrec=<?php echo $reclamation["idrec"]; ?>">Modifier</a> | 
                            <a href="deleteRec.php?idrec=<?php echo $reclamation["idrec"]; ?>" 
                               onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette réclamation ?');">Supprimer</a> | 
                            <a href="reponses.php?idrec=<?php echo $reclamation["idrec"]; ?>">Voir les réponses</a> | 
                            <a href="creatreponse.php?idrec=<?php echo $reclamation["idrec"]; ?>">Répondre</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
<script>
     function myFunction() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");

        // Loop through all table rows, and hide those who don't match the search query
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[1];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
    document.addEventListener("DOMContentLoaded", function () {
        const headers = document.querySelectorAll(".sortable");

        function sortByColumn(columnIndex) {
            const tableBody = document.querySelector("tbody");
            const rows = Array.from(tableBody.querySelectorAll("tr"));
            const isAscending = headers[columnIndex].classList.toggle("asc");

            rows.sort((rowA, rowB) => {
                const valueA = rowA.cells[columnIndex].textContent.trim();
                const valueB = rowB.cells[columnIndex].textContent.trim();

                if (columnIndex === 0) {
                    // If the column is the ID column, parse the values as integers for numeric sorting
                    return isAscending ? parseInt(valueA) - parseInt(valueB) : parseInt(valueB) - parseInt(valueA);
                } else if (columnIndex === 1) {
                    // If the column is the date column, convert the dates to objects for comparison
                    return isAscending
                        ? new Date(valueA) - new Date(valueB)
                        : new Date(valueB) - new Date(valueA);
                }

                return isAscending
                    ? valueA.localeCompare(valueB)
                    : valueB.localeCompare(valueA);
            });

            rows.forEach((row) => tableBody.appendChild(row));
        }


        headers.forEach((header, index) => {
            header.addEventListener("click", () => sortByColumn(index));
        });
    });
</script>
</html>
