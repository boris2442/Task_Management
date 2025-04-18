<?php
session_start();
require_once './includes/database/database.php';
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




<?php
$title = "welcome-page";
require_once 'includes/header.php'
?>
<section class="bg-[#B4CA65] text-white py-10 px-6 rounded-lg shadow-md">
    <h1 class="text-2xl pl-[20px] pt-[20px]">Bienvenue <?= $_SESSION['users']['pseudo']  ?></h1>
    <h2 class="text-3xl font-bold mb-6 text-center underline">Présentation des types de tâches</h2>
    <p class="mb-8 text-lg text-center">
        Pour une meilleure organisation, vos tâches sont classées en trois catégories distinctes :
    </p>

    <div class="space-y-6">
        <!-- Tâches simples -->
        <div class="bg-white bg-opacity-10 p-6 rounded-lg">
            <h3 class="text-xl font-semibold text-[#ff6c6c] mb-2">Tâches simples</h3>
            <p class="text-[#333]">
                Ces tâches sont rapides à accomplir, ne nécessitant qu'une seule étape avec une échéance courte.
                <br>
                <span class="italic text-sm text-[#333]">Exemple : répondre à un email.</span>
            </p>
        </div>

        <!-- Tâches complexes -->
        <div class="bg-white bg-opacity-10 p-6 rounded-lg">
            <h3 class="text-xl font-semibold text-[#ff6c6c] mb-2">Tâches complexes</h3>
            <p class="text-[#333]">
                Elles impliquent plusieurs étapes et s'étendent sur une période plus longue.
                <br>
                <span class="italic text-sm text-[#333]">Exemple : organiser un événement.</span>
            </p>
        </div>

        <!-- Tâches récurrentes -->
        <div class="bg-white bg-opacity-10 p-6 rounded-lg">
            <h3 class="text-xl font-semibold text-[#ff6c6c] mb-2">Tâches récurrentes</h3>
            <p class="text-[#333]">
                Ce sont des tâches qui reviennent régulièrement, comme une réunion hebdomadaire ou la mise à jour mensuelle d'un rapport.
                <br>
                <span class="italic text-sm text-[#333]">Exemple : réunion hebdomadaire.</span>
            </p>
        </div>
    </div>
</section>
<section>
    <form  method="POST" class="bg-[#B4CA65] text-white p-8 rounded-lg shadow-md max-w-md mx-auto mt-[20px]">
        <h2 class="text-2xl font-bold mb-6 text-center">Sélectionnez le type de tâche</h2>

        <label for="type_tache" class="block mb-2 text-lg font-semibold">Type de tâche :</label>
        <select id="type_tache" name="type_tache" required
            class="w-full p-3 rounded-md bg-white text-[#B4CA65] font-medium focus:outline-none focus:ring-2 focus:ring-[#ff6c6c]">
            <option value="" disabled selected>-- Choisir un type --</option>
            <option value="simple">Tâche simple</option>
            <option value="complexe">Tâche complexe</option>
            <option value="recurrente">Tâche récurrente</option>
        </select>

        <button type="submit"
            class="mt-6 w-full bg-[#ff6c6c] hover:bg-[#e85c5c] text-white font-bold py-2 px-4 rounded-md transition duration-300">
            Continuer
        </button>
    </form>
</section>



<?php
require_once 'includes/footer.php'
?>