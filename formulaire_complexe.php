<?php
$title = "tache complexe";
require_once 'includes/header.php'
?>
<section>

    <div class="min-h-screen bg-[#B4CA65] flex items-center justify-center p-4">
        <form class="bg-white rounded-2xl shadow-xl p-8 w-full max-w-xl space-y-6">
            <h2 class="text-2xl font-bold text-[#333] text-center">Ajouter une tâche complexe</h2>

            <!-- Nom de la tâche -->
            <div>
                <label class="block text-[#333] mb-1 font-semibold">Titre de la tâche</label>
                <input type="text" name="titre" placeholder="Ex: Organiser une conférence"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-2 focus:border-[#B4CA65] focus:text-gray-800 text-gray-700">
            </div>

            <!-- Description -->
            <div>
                <label class="block text-[#333] mb-1 font-semibold">Description</label>
                <textarea name="description" rows="4" placeholder="Détaille les étapes..."
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-2 focus:border-[#B4CA65] focus:text-gray-800 text-gray-700"></textarea>
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