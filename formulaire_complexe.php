<?php
session_start();
require_once "includes/database/database.php";
require_once "includes/functions/clean_input.php";
$errors = [];
if (isset($_SESSION['users']['id'])) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (empty($_POST['sujet']) || strlen($_POST['sujet']) > 60) {
            $errors[] = "sujet inexistant et ou n'excede pas 60 caracteres";
        }
        $sujet = clean_input($_POST['sujet']);
        if (empty($_POST['message']) || strlen($_POST['message']) > 255) {
            $errors[] = "La message ne doit pas exceder 250 caracteres";
        }
        $message = clean_input($_POST['message']);
        $date_limite = clean_input($_POST['deadline']);
        $today = date('Y-m-d');
        if ($date_limite < $today) {
            $errors[] = "La date limite doit etre superieure a la date d'aujourd'hui";
        }

        $etapes = clean_input($_POST['etapes']);
        $id = $_SESSION['users']['id'];
        if (empty($errors)) {
            $sql = $db->prepare("INSERT INTO `taches` (`sujet`, `message`,`date_limite`,`etapes`, `type`,`id_utilisateur`) VALUES(:sujet, :message, :date_limite, :etapes, 'complexe',:id_utilisateur) ");
            $sql->execute([
                "sujet" => $sujet,
                "message" => $message,
                "date_limite" => $date_limite,
                "etapes" => $etapes,
                'id_utilisateur' => $id
            ]);
        }
    }
} else {
    echo "Bien vouloir vous connecter avec d'effectuer cette tache";
    header("location:connexion.php");
    exit();
}
?>




<?php
$title = "tache complexe";
require_once 'includes/header.php'
?>
<section>


    <div class="min-h-screen bg-[#B4CA65] flex items-center justify-center p-4">
        <form method="POST" class="bg-white rounded-2xl shadow-xl p-8 w-full max-w-xl space-y-6">
            <h2 class="text-2xl font-bold text-[#ff6c6c] text-center underline">Ajouter une tâche complexe</h2>
            <?php
            if (!empty($errors)) {
                foreach ($errors as $error):
                    echo "<div style='color:white; text-align: center; background-color:#ff6c6c;padding:2px 7px; margin-bottom:10px; font-size:16px;'>
        $error
        </div>";
                endforeach;
            }
            ?>

            <!-- Nom de la tâche -->
            <div>
                <label class="block text-[#333] mb-1 font-semibold">sujet de la tâche</label>
                <input type="text" name="sujet" placeholder="Ex: Organiser une conférence"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-2 focus:border-[#B4CA65] focus:text-gray-800 text-gray-700">
            </div>

            <!-- message -->
            <div>
                <label class="block text-[#333] mb-1 font-semibold">message</label>
                <textarea name="message" rows="4" placeholder="Détaille les étapes..."
                    class="resize-none w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-2 focus:border-[#B4CA65] focus:text-gray-800 text-gray-700"></textarea>
            </div>

            <!-- Date d'échéance -->
            <div>
                <label class="block text-[#333] mb-1 font-semibold">Date limite</label>
                <input type="date" name="deadline"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-2 focus:border-[#B4CA65] focus:text-gray-800 text-gray-700">
            </div>

            <!-- Étapes de la tâche -->
            <div>
                <label class="block text-[#333] mb-1 font-semibold">Étapes (séparées par des virgules)</label>
                <input type="text" name="etapes" placeholder="Planifier, Réserver salle, Envoyer invitations"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-2 focus:border-[#B4CA65] focus:text-gray-800 text-gray-700">
            </div>

            <!-- Bouton -->
            <div class="text-center">
                <button type="submit"
                    class="w-full bg-[#ff6c6c] hover:bg-red-400 text-white font-bold py-2 px-4 rounded-md transition duration-300">
                    Enregistrer la tâche
                </button>
            </div>
        </form>
    </div>
</section>
<?php
require_once 'includes/footer.php'
?>