<?php
// traitement_tache_simple.php

// Connexion à la base de données
require_once __DIR__ . '/includes/database/database.php';
require_once 'includes/functions/clean_input.php';

// Vérification de la soumission du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération et nettoyage des données
    $destinataire = clean_input($_POST['destinataire'] ?? '');
    $sujet = clean_input($_POST['sujet'] ?? '');
    $message = clean_input($_POST['message'] ?? '');

    // Validation des données
    $errors = [];

    if (empty($destinataire) || !filter_var($destinataire, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Le destinataire est requis.";
    }

    if (empty($sujet) ||strlen($sujet>40)) {
        $errors[] = "La sujet est requise et la taille n excede pas 50 caracteres.";
    }

    if (empty($message) || strlen($message>255)) {
        $errors[] = "L'échéance est requise et la taille n excede pas 50 caracteres.";
    }
    $id=$_SESSION['users']['id'];
    if (empty($errors)) {
        // Préparation de la requête d'insertion
        $stmt = $db->prepare("INSERT INTO taches (destinataire, sujet, message, type,id_utilisateur) VALUES (:destinataire, :sujet, :message, 'simple',:id_utilisateur)");
        $stmt->execute([
            'destinataire' => $destinataire,
            'sujet' => $sujet,
            'message' => $message,
            'id_utilisateur'=>$id
        ]);
var_dump(   $stmt);
        // Redirection ou message de succès
        header('Location: liste_taches.php');
        exit();
        echo "on a reussi";
    } else {
        // Affichage des erreurs
        foreach ($errors as $error) {
            echo "<p style='color:red;'>$error</p>";
        }
    }
}else{
    echo "error";
}
?>
