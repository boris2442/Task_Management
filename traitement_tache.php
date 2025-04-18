<?php
require_once './includes/database/database.php';

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
            header('Location: selection_tache.php?erreur=type_invalide');
            exit;
    }
}
?>
