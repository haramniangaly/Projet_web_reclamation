<?php 
include(__DIR__ . '../../config.php');
include(__DIR__ . '../../Model/reponse.php');

class repController
{
    // Liste des réponses avec leur réclamation associée (optionnel)
    public function listreponses()
    {
        // Requête SQL avec jointure pour obtenir les détails de la réclamation
        $sql = "SELECT r.*, rec.nomrec AS reclamation_nom
                FROM reponse r
                LEFT JOIN rec ON r.idrec = rec.idrec"; // Assure-toi que les noms des colonnes sont corrects
    
        $db = config::getConnexion();
        try {
            // Exécution de la requête et récupération des résultats
            $query = $db->query($sql);
            return $query->fetchAll(PDO::FETCH_ASSOC); // Récupérer les résultats sous forme de tableau associatif
        } catch (PDOException $e) {
            // Gestion des erreurs
            echo 'Erreur : ' . $e->getMessage();
            return [];
        }
    }
    


    // Suppression d'une réponse
    public function deletereponse($idreponse)
    {
        $sql = "DELETE FROM reponse WHERE id_rep = :id_rep";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute(['id_rep' => $idreponse]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    // Ajout d'une nouvelle réponse avec idrec
    public function addreponse($reponse)
    {
        $sql = "INSERT INTO reponse (reponse_rep, nom_rep, adressmail_rep, idrec)
                VALUES (:reponse_rep, :nom_rep, :adressmail_rep, :idrec)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'reponse_rep' => $reponse->getReponse(),
                'nom_rep' => $reponse->getNom(),
                'adressmail_rep' => $reponse->getMail(),
                'idrec' => $reponse->getIdrec()
            ]);
            echo "Réponse ajoutée avec succès!";
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    // Mise à jour d'une réponse avec idrec
    public function updatereponses($reponse, $id_rep)
    {
        $sql = "UPDATE reponse SET reponse_rep = :reponse_rep, nom_rep = :nom_rep, adressmail_rep = :adressmail_rep WHERE id_rep = :id_rep";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'reponse_rep' => $reponse->getReponseRep(),
                'nom_rep' => $reponse->getNomRep(),
                'adressmail_rep' => $reponse->getAdressmailRep(),
                'id_rep' => $id_rep
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    // Récupération d'une réponse spécifique
    public function showreponse($idrep)
    {
        $sql = "SELECT * FROM reponse WHERE id_rep = :id_rep";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute(['id_rep' => $idrep]);
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    // Récupérer les informations de la réclamation par son ID
    public function getReclamationById($idrec)
    {
        // Requête pour récupérer la réclamation par ID
        $sql = "SELECT * FROM rec WHERE idrec = :idrec"; // Table 'rec' au lieu de 'reclamation'
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute(['idrec' => $idrec]); // Passer l'ID de la réclamation à la requête
            return $query->fetch(); // Retourner la réclamation trouvée
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage(); // Gérer l'erreur en cas de problème
        }
    }
    // Récupérer les réponses par réclamation
public function listreponsesByReclamation($idrec)
{
    $sql = "SELECT r.*, rec.nomrec AS reclamation_nom
            FROM reponse r
            LEFT JOIN rec rec ON r.idrec = rec.idrec
            WHERE r.idrec = :idrec";  // Ajouter une condition WHERE pour filtrer par réclamation
    $db = config::getConnexion();
    try {
        $query = $db->prepare($sql);
        $query->execute(['idrec' => $idrec]);
        return $query->fetchAll(PDO::FETCH_ASSOC);  // Retourner les réponses
    } catch (PDOException $e) {
        echo 'Erreur : ' . $e->getMessage();
        return [];
    }
}

}
?>
