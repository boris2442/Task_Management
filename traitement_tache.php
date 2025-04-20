<?php
session_start();
require_once './includes/database/database.php';
// Vérification de la connexion de l'utilisateur
if (!isset($_SESSION['users'])) {
    header('location:connexion.php');
    exit();
}
// Connexion à la base de données



// traitement_tache.php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $type_tache = $_POST['type_tache'] ?? '';

    switch ($type_tache) {
        case 'simple':
            header('Location: formulaire_simple.php');
            exit;
        case 'complexe':
            header('Location: formulaire_complexe.php');
            exit;
        case 'recurrente':
            header('Location: formulaire_recurrente.php');
            exit;
        default:
            // Redirection vers le formulaire de sélection avec un message d'erreur
            header('Location: connexion.php');
            exit;
    }
}
?>
