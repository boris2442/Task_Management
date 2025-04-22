<?php
session_start();
require_once "includes/database/database.php";
require_once "includes/functions/clean_input.php";
if ($_SESSION['users']) {
    $id = $_SESSION['users']['id'];
    if (isset($_GET['id'])) {
        $id_tache = $_GET['id'];

        // Récupérer la tâche à modifier
        $sql = "SELECT * FROM taches WHERE id_tache = :id_tache";
        $requete = $db->prepare($sql);
        $requete->bindParam(':id_tache', $id_tache);
        $requete->execute();
        $tache = $requete->fetch(PDO::FETCH_ASSOC);
        echo "<pre>";
       var_dump($tache);
         // Debugging line
        echo "</pre>";
        if (!$tache) {
            echo "Aucune tâche trouvée avec cet ID.";
            exit;
        }

        // Traitement de la soumission du formulaire
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $sql = "UPDATE taches SET sujet = :sujet, message = :message, etapes = :etapes, frequence = :frequence, date_limite = :date_limite, statut = :statut WHERE id_tache = :id_tache";
            $requete = $db->prepare($sql);
            $requete->bindParam(':sujet', $_POST['sujet']);
            $requete->bindParam(':message', $_POST['description']);
            $requete->bindParam(':etapes', $_POST['etapes']);
            $requete->bindParam(':frequence', $_POST['frequence']);
            $requete->bindParam(':date_limite', $_POST['date']);
            $requete->bindParam(':statut', $_POST['statut']);
            $requete->bindParam(':id_tache', $id_tache);
            $requete->execute();

            // Rediriger après modification
            // header("Location: editer_tache.php?id=" . $id_tache . "&success=1");
            // exit;
            header('location: taches_list.php');
        }
    } else {
        echo "Aucun ID de tâche fourni.";
        exit;
    }
} else {
    header('location:connexion.php');
    exit();
}
?>





<?php $title = "Éditer une tâche récurrente";
require_once 'includes/header.php'; ?>
<section>
    <div class="min-h-screen bg-[#B4CA65] flex items-center justify-center p-6">
        <form method="POST" class="w-full max-w-xl bg-white p-8 rounded-2xl shadow-lg space-y-6">

            <?php
            //  if (isset($_GET['success'])): 
             ?>
                <!-- <div class="bg-green-400 text-white text-center py-2 px-4 rounded-md"> -->
                    <!-- La tâche a été modifiée avec succès ! -->
                <!-- </div> -->
            <?php 
            // endif;
             ?>

            <h2 class="text-2xl font-bold text-red-400">Éditer une tâche récurrente</h2>

            <!-- Titre -->
            <div>
                <label class="block text-[#333] mb-1 font-semibold">Titre de la tâche</label>
                <input type="text" name="sujet" value="<?= htmlspecialchars($tache['sujet'] ?? '') ?>" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-[#B4CA65] text-[#333]">
            </div>

            <!-- Description -->
            <div>
                <label class="block text-[#333] mb-1 font-semibold">Description</label>
                <textarea name="description" rows="4" class="resize-none text-[#333] w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-[#B4CA65]"><?= htmlspecialchars($tache['message']) ?></textarea>
            </div>

            <!-- Étapes -->
            <div>
                <label class="block text-[#333] mb-1 font-semibold">Étapes (si complexe)</label>
                <textarea name="etapes" rows="4" class="w-full resize-none px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-[#B4CA65] text-[#333]"><?= htmlspecialchars($tache['etapes'] ?? '') ?></textarea>
            </div>

            <!-- Fréquence -->
            <div>
                <label class="block text-[#333] mb-1 font-semibold">Fréquence (si récurrente)</label>
                <select name="frequence" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-[#B4CA65] text-[#333]">
                    <!-- <option value="">-- Sélectionner la fréquence --</option>
                    <option value="quotidien" <?= $tache['frequence'] === 'quotidien' ? 'selected' : '' ?>>Quotidien</option>
                    <option value="hebdomadaire" <?= $tache['frequence'] === 'hebdomadaire' ? 'selected' : '' ?>>Hebdomadaire</option>
                    <option value="mensuel" <?= $tache['frequence'] === 'mensuel' ? 'selected' : '' ?>>Mensuel</option>
                    <option value="annuel" <?= $tache['frequence'] === 'annuel' ? 'selected' : '' ?>>Annuel</option> -->

                    <option value="">-- Sélectionner la fréquence --</option>
                    <option value="quotidien" <?= $tache['frequence'] === 'quotidien' ? 'selected' : '' ?>>Quotidien</option>
                    <option value="hebdomadaire" <?= $tache['frequence'] === 'hebdomadaire' ? 'selected' : '' ?>>Hebdomadaire</option>
                    <option value="mensuel" <?= $tache['frequence'] === 'mensuel' ? 'selected' : '' ?>>Mensuel</option>
                    <option value="annuel" <?= $tache['frequence'] === 'annuel' ? 'selected' : '' ?>>Annuel</option>
                </select>
            </div>

            <!-- Date de fin -->
            <div>
                <label class="block text-[#333] mb-1 font-semibold">Date de fin</label>
                <input type="date" name="date" value="<?= htmlspecialchars($tache['date_limite'] ?? '') ?>" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-[#B4CA65] text-[#333]">
            </div>

            <!-- Statut -->
            <div>
                <label class="block text-[#333] mb-1 font-semibold">Statut</label>
                <select name="statut" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-[#B4CA65] text-[#333]">
                    <!-- <option value="">-- Sélectionner le statut --</option>
                    <option value="terminer" <?= $tache['statut'] === 'terminer' ? 'selected' : '' ?>>Terminer</option>
                    <option value="attente" <?= $tache['statut'] === 'attente' ? 'selected' : '' ?>>En attente</option> -->
                    <option value="">-- Sélectionner le statut --</option>
                    <option value="terminer" <?= $tache['statut'] === 'terminer' ? 'selected' : '' ?>>Terminer</option>
                    <option value="attente" <?= $tache['statut'] === 'attente' ? 'selected' : '' ?>>En attente</option>
                </select>
            </div>

            <!-- Bouton -->
            <div class="text-right">
                <button type="submit" class="w-full bg-[#ff6c6c] hover:bg-red-400 text-white font-bold py-2 px-4 rounded-md transition duration-300">
                    Modifier la tâche
                </button>
            </div>
        </form>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>