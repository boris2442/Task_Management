<?php
session_start();
require_once 'includes/database/database.php';
require_once 'includes/functions/clean_input.php';











// if (isset($_SESSION['users']['id'])) {

//     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//         if (empty($_POST['sujet'])) {
//             $errors = "Le sujet de la tache ne doit pas etre vide";
//         } elseif (strlen($_POST['sujet']) > 40) {
//             $errors = "titre trop long";
//         } else {
//             $sujet = clean_input($_POST['sujet']);
//         }
//         if (empty($_POST['description'])) {
//             $errors = "Le description de la tache ne doit pas etre vide";
//         } elseif (strlen($_POST['description']) > 200) {
//             $errors = "description trop long";
//         } else {
//             $description = clean_input($_POST['description']);
//         }
//         if (empty($_POST['etapes'])) {
//             $errors = "Les etapes de la tache ne doit pas etre vide";
//         } elseif (strlen($_POST['etapes']) > 200) {
//             $errors = "etapes trop long";
//         } else {
//             $etapes = clean_input($_POST['etapes']);
//         }


//         if (!isset($_POST['frequence'])) {
//             $errors = "choisir une frequence";
//         } else {
//             $frequence = $_POST['frequence'];
//         }

//         if (!isset($_POST['statut'])) {
//             $errors = "choisir une statut";
//         } else {
//             $statut = $_POST['statut'];
//         }

//         if (empty($_POST['date'])) {
//             $errors = 'please insert date';
//         } else {
//             $date_limite = $_POST['date'];
//         }
//         echo "<pre>";
//         var_dump(
//             $sujet,
//             $description,
//             $etapes,
//             $frequence,
//             $date_limite,
//             $statut
//         );
//         echo "</pre>";
//         $id = $_SESSION['users']['id'];
//         if (empty($errors)) {
//             $sql = $db->prepare("INSERT INTO `taches` (`sujet`,`message`, `etapes`, `frequence`, `date_limite`,`type`,`id_utilisateur`,`statut`)VALUES(:sujet, :description, :etapes, :frequence, :date_limite,'reccurrente', :id_utilisateur,:statut )");
//             $sql->execute([
//                 'sujet' => $sujet,
//                 "description" => $description,
//                 "etapes" => $etapes,
//                 "frequence" => $frequence,
//                 "date_limite" => $date_limite,
//                 'id_utilisateur' => $id,
//                 'statut' => $statut
//             ]);
//         } else {
//             echo "une erreur s'est produite";
//         }
//     }
// } else {
//     header("location:connexion.php");
// }




?>
<?php
require_once 'includes/header.php';
?>
<h1>Renommer une tache </h1>
<section>
    <div class="min-h-screen bg-[#B4CA65] flex items-center justify-center p-6">
        <form method="POST" class="w-full max-w-xl bg-white p-8 rounded-2xl shadow-lg space-y-6">

            <h2 class="text-2xl font-bold text-red-400">Editer une tache</h2>

            <!-- Titre -->
            <div>
                <label class="block text-[#333] mb-1 font-semibold">Titre de la tâche</label>
                <input type="text" name="sujet" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-2 focus:border-[#B4CA65] focus:text-gray-800 text-gray-700" placeholder="Ex: Organiser un événement">
            </div>

            <!-- Description -->
            <div>
                <label class="block text-[#333] mb-1 font-semibold">Description</label>
                <textarea name="description" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-2 focus:border-[#B4CA65] focus:text-gray-800 text-gray-700" placeholder="Détails de la tâche..."></textarea>
            </div>

            <!-- Échéance -->
            <!-- <div>
      <label class="block text-[#333] mb-1 font-semibold">Échéance</label>
      <input type="date" name="echeance" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-2 focus:border-[#B4CA65] focus:text-gray-800 text-gray-700">
    </div> -->

            <!-- Étapes (tâche complexe) -->
            <div>
                <label class="block text-[#333] mb-1 font-semibold">Étapes (si complexe)</label>
                <textarea name="etapes" rows="4" class="w-full resize-none px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-2 focus:border-[#B4CA65] focus:text-gray-800 text-gray-700" placeholder="Ex: Préparer la salle, Envoyer les invitations, etc."></textarea>
            </div>

            <!-- Fréquence (tâche récurrente) -->
            <div>
                <label class="block text-[#333] mb-1 font-semibold">Fréquence (si récurrente)</label>
                <select name="frequence" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-2 focus:border-[#B4CA65] focus:text-gray-800 text-gray-700">
                    <option value="">-- Sélectionner la fréquence --</option>
                    <option value="quotidien">Quotidien</option>
                    <option value="hebdomadaire">Hebdomadaire</option>
                    <option value="mensuel">Mensuel</option>
                    <option value="annuel">Annuel</option>
                </select>
            </div>

            <!-- Date de fin (pour tâche récurrente) -->
            <div>
                <label class="block text-[#333] mb-1 font-semibold">Date de fin (si récurrente)</label>
                <input type="date" name="date" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-2 focus:border-[#B4CA65] focus:text-gray-800 text-gray-700">
            </div>
            <div>
                <label class="block text-[#333] mb-1 font-semibold">Statut actuel</label>
                <select name="statut" " class=" w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-2 focus:border-[#B4CA65] focus:text-gray-800 text-gray-700">
                    <option value="">-- Sélectionner le statut a enregistrer--</option>
                    <option value="terniner">Terminer</option>
                    <option value="attente">En attente</option>
                </select>
            </div>
            <!-- Bouton -->
            <div class="text-right">
                <button type="submit" name="update" class="w-full bg-[#ff6c6c] hover:bg-red-400 text-white font-bold py-2 px-4 rounded-md transition duration-300">Ajouter la tâche</button>
            </div>
        </form>
    </div>

</section>
<script>
    function toggleOptions() {
        const zone = document.getElementById("zoneAvancee");
        zone.style.display = zone.style.display === "none" ? "block" : "none";
    }
</script>
<?php
require_once 'includes/footer.php'
?>