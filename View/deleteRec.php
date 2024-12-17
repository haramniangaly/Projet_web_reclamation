<?php
include '../Controller/reclamationC.php';

if (isset($_GET['idrec'])) {
    $recController = new recController();
    $recController->deleterec($_GET['idrec']);
    header('Location: listRec.php'); // Redirect after deletion
    exit();
}
?>
