<?php
include '../Controller/reponseC.php';

if (isset($_GET['id_rep']) && is_numeric($_GET['id_rep'])) {
    $id_rep = $_GET['id_rep']; // Récupérer l'ID de la réponse

    // Créer une instance du contrôleur
    $repController = new repController();

    // Appeler la méthode de suppression
    try {
        $repController->deletereponse($id_rep);
        header('Location:listreponse.php'); // Rediriger après la suppression
        exit();
    } catch (Exception $e) {
        // Si une erreur survient lors de la suppression
        echo "Erreur lors de la suppression : " . $e->getMessage();
    }
} else {
    // Si l'ID de la réponse est manquant ou invalide
    echo "ID de réponse invalide.";
}
?>
