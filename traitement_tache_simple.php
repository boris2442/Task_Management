<?php
// traitement_tache_simple.php

// Connexion à la base de données
require_once __DIR__ . '/includes/database/database.php';

// Vérification de la soumission du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération et nettoyage des données
    $titre = trim($_POST['titre'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $echeance = $_POST['echeance'] ?? '';

    // Validation des données
    $errors = [];

    if (empty($titre)) {
        $errors[] = "Le titre est requis.";
    }

    if (empty($description)) {
        $errors[] = "La description est requise.";
    }

    if (empty($echeance)) {
        $errors[] = "L'échéance est requise.";
    }

    if (empty($errors)) {
        // Préparation de la requête d'insertion
        $stmt = $db->prepare("INSERT INTO taches (titre, description, echeance, type) VALUES (:titre, :description, :echeance, 'simple')");
        $stmt->execute([
            'titre' => $titre,
            'description' => $description,
            'echeance' => $echeance
        ]);

        // Redirection ou message de succès
        // header('Location: liste_taches.php');
        // exit();
        echo "on a reussi";
    } else {
        // Affichage des erreurs
        foreach ($errors as $error) {
            echo "<p style='color:red;'>$error</p>";
        }
    }
}
?>
