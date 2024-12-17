<?php

include(__DIR__ . '../../config.php');
include(__DIR__ . '../../Model/reclamation.php');

class recController
{
    public function listrecs()
    {
        $sql = "SELECT * FROM rec";
        $db = config::getConnexion();
        try {
            return $db->query($sql);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function deleterec($idrec)
    {
        $sql = "DELETE FROM rec WHERE idrec = :idrec";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute(['idrec' => $idrec]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function addrec($rec)
    {
        $sql = "INSERT INTO rec (nomrec, adressmail, sujetrec, descriptionrec, date_creation, statut_rec) 
                VALUES (:nomrec, :adressmail, :sujetrec, :descriptionrec, :date_creation, :statut_rec)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'nomrec' => $rec->getNom(),
                'adressmail' => $rec->getMail(),
                'sujetrec' => $rec->getSujet(),
                'descriptionrec' => $rec->getDescription(),
                'date_creation' => $rec->getDateCreation(),
                'statut_rec' => $rec->getStatutRec()
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function updaterec($rec, $idrec)
    {
        $sql = "UPDATE rec SET 
                nomrec = :nomrec, 
                adressmail = :adressmail, 
                sujetrec = :sujetrec, 
                descriptionrec = :descriptionrec,
                date_creation = :date_creation,
                statut_rec = :statut_rec
                WHERE idrec = :idrec";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'idrec' => $idrec,
                'nomrec' => $rec->getNom(),
                'adressmail' => $rec->getMail(),
                'sujetrec' => $rec->getSujet(),
                'descriptionrec' => $rec->getDescription(),
                'date_creation' => $rec->getDateCreation(),
                'statut_rec' => $rec->getStatutRec()
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function showrec($idrec)
    {
        $sql = "SELECT * FROM rec WHERE idrec = :idrec";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute(['idrec' => $idrec]);
            return $query->fetch();
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
}
?>
