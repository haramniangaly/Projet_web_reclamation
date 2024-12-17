<?php

require '../vendor/PHPMailer/src/PHPMailer.php';
require '../vendor/PHPMailer/src/SMTP.php';
require '../vendor/PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include '../Controller/reclamationC.php';

$error = ""; // Initialiser le message d'erreur
$recController = new recController(); // Instancier le contrôleur

function sendConfirmationEmail($to, $name, $subject, $description) {
    $mail = new PHPMailer(true);

    try {
        // Configuration du serveur SMTP pour Gmail
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Serveur SMTP de Gmail
        $mail->SMTPAuth = true;
        $mail->Username = 'haram.niangaly@esprit.tn'; // Votre adresse Gmail
        $mail->Password = 'znbn fenf xbno nsyc'; // Votre mot de passe spécifique à l'application
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Sécurisation TLS
        $mail->Port = 587;

        // Expéditeur et destinataire
        $mail->setFrom('haram.niangaly@esprit.tn', 'Votre Application');
        $mail->addAddress($to, $name);

        // Contenu de l'email
        $mail->isHTML(true);
        $mail->Subject = $subject; // Sujet personnalisé
        $mail->Body = "<p>Bonjour $name,</p>
                       <p>$description</p>
                       <p>Merci pour votre confiance.</p>
                       <p>Cordialement,</p>
                       <p>L'équipe de support</p>";

        $mail->send();
        return true; // Email envoyé avec succès
    } catch (Exception $e) {
        echo "Erreur d'envoi d'email : " . $mail->ErrorInfo; // Afficher l'erreur
        return false; // Échec de l'envoi
    }
}

// Traitement de la soumission du formulaire
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nomrec = $_POST["nomrec"] ?? "";
    $adressmail = $_POST["adressmail"] ?? "";
    $sujetrec = $_POST["sujetrec"] ?? "";
    $descriptionrec = $_POST["descriptionrec"] ?? "";

    if (empty($nomrec) || empty($adressmail) || empty($sujetrec) || empty($descriptionrec)) {
        echo "Tous les champs sont requis.";
    } elseif (!filter_var($adressmail, FILTER_VALIDATE_EMAIL)) {
        echo "Adresse email invalide.";
    } else {
        $reclamation = new rec(
            null,
            $nomrec,
            $adressmail,
            $sujetrec,
            $descriptionrec,
            date("Y-m-d H:i:s"),
            "Nouvelle"
        );

        // Ajouter la réclamation à la base de données
        $recController->addrec($reclamation);

        // Envoyer l'email avec le sujet et la description personnalisés
        if (sendConfirmationEmail($adressmail, $nomrec, $sujetrec, $descriptionrec)) {
            echo "Votre réclamation a été soumise avec succès ! Un email de confirmation a été envoyé.";
        } else {
            echo "Votre réclamation a été soumise avec succès, mais l'email de confirmation n'a pas pu être envoyé.";
        }
    }
}
?>




<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta nomrec="viewport" content="width=device-width, initial-scale=1.0">
  <title>Déposer Réclamations</title>
  <link rel="stylesheet" href="Font.css">
  <link rel="stylesheet" href="Reclamation.css"> 
  <script src="JS/validation.js" defer></script>

</head>
<body>
  <div class="ES-HUB">
    <h1>ES-HUB</h1>
</div>
<div class="line-container">
    <div class="line"></div>
</div>

<div class="navigation">
  <a href="C:\Users\MSI\Desktop\Projet Web\Home\home.html">Home</a>
  <a href="C:\Users\MSI\Desktop\Projet Web\Ktchou\acceuil.html">Continents</a>
  <a href="C:\Users\MSI\Desktop\Projet Web\ahd\reclamation.html">Contact Us</a>
  <a href="#">About Us</a>
</div>

<div class="">
  <br>
<br>
<br>
<br>
  <div class="container">
    <h2>Deposer Votre Reclamation :</h2>
    <form id="reclamationForm" class="contact-form" action="" method="POST">
    <label for="nomrec">Nom :</label><br>
    <textarea id="nomrec" name="nomrec" rows="2" cols="80" class="input-box"></textarea><br>

    <label for="adressmail">Email :</label><br>
    <textarea id="adressmail" name="adressmail" rows="2" cols="80" class="input-box"></textarea><br>

    <label for="sujetrec">Sujet :</label><br>
    <textarea id="sujetrec" name="sujetrec" rows="2" cols="80" class="input-box"></textarea><br>

    <label for="descriptionrec">Description :</label><br>
    <textarea id="descriptionrec" name="descriptionrec" rows="10" cols="80" class="input-box"></textarea><br>

    <input type="submit" value="Soumettre Réclamation" class="animated-button">
</form>

  </div>
  </div>
</body>
</html>
