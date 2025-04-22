<?php

// require_once "includes/database/database.php";
// $message = "";
// if (isset($_GET['id_tache'])) {
//     $id = $_GET['id_tache'];
//     var_dump($id_tache);

//     if (!is_numeric($id)) {
//         $message = "ID de tâche invalide.";
//         header("Location: taches_list.php");
//         exit;
//     }

//     $sql = "DELETE FROM `taches` WHERE id_tache=:idAND id_utilisateur=:id_utilisateur";
//     $requete = $db->prepare($sql);
//     $requete->bindParam(':id_tache', $id);
//     $requete->bindParam(':id_utilisateur', $_SESSION['users']['id']);
//     $requete->execute();
//     if ($requete->rowCount() > 0) {
//         $message = "Tâche supprimée avec succès.";
//         header("Location: taches_list.php");
//         exit;
//     } else {
//         $message = "Aucune tâche trouvée avec cet ID.";
//         header("Location: taches_list.php");
//         exit;
//     }
// } else {
//     $message = "Aucun ID de tâche fourni.";
//     header("Location: taches_list.php");
//     exit;

// }



require_once 'includes/database/database.php';

$idTache = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($idTache > 0) {
    $sql = $db->prepare("DELETE FROM taches WHERE id_tache = :id");
    $sql->execute(['id' => $idTache]);
    header('Location: taches_list.php');
    exit();
} else {
    echo "ID de tâche invalide.";
}











?>

<!-- <?php
        require_once "includes/header.php";

        ?>
<section>
    <div class=" p-8 rounded-lg shadow-md w-full max-w-md">
        <div class="mb-4">
            <h1 class="text-2xl font-bold text-center text-red-400">Suppression de tache</h1>
        </div>
        <div class="mb-4">
            <p class="text-center text-gray-600"><?= $message ?></p>
        </div>
        <div class="flex justify-center">
            <a href="taches_list.php"
                class="bg-red-400 text-white px-4 py-2 rounded-lg hover:bg-red-500 transition duration-200 shadow">Retour à
                la liste des taches</a>
        </div>
    </div>
</section>
<?php
require_once "includes/footer.php";
?> -->