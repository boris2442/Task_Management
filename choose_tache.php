<?php
session_start();
require_once 'includes/functions/function.php';
require_once 'includes/functions/clean_input.php';
require_once 'includes/database/database.php';

if (!isset($_SESSION['users'])) {
    header('location:connexion.php');
    exit();
}

$recherche = isset($_GET['recherche']) ? trim($_GET['recherche']) : '';
?>

<?php require_once 'includes/header.php'; ?>
<?php require_once 'includes/navbar.php'; ?>

<section>
    <h1 class="text-2xl text-center p-2">Listes de taches de 
        <span class="font-bold"><?php echo $_SESSION['users']['pseudo']; ?></span>
    </h1>

    <!-- Zone de recherche -->
    <div class="max-w-4xl mx-auto px-4 py-4">
        <form id="form-filtre" class="flex flex-col sm:flex-row gap-4 items-center justify-between">
            <select name="recherche" id="recherche"
                class="w-full sm:w-3/4 px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-red-400  text-[#333]">
                <option value="">-- Filtrer par type de tâche --</option>
                <option value="simple" <?= ($recherche === 'simple') ? 'selected' : '' ?>>Simple</option>
                <option value="complexe" <?= ($recherche === 'complexe') ? 'selected' : '' ?>>Complexe</option>
                <option value="recurrente" <?= ($recherche === 'recurrente') ? 'selected' : '' ?>>Récurrente</option>
            </select>

            <button type="submit"
                class="bg-red-400 text-white px-6 py-2 rounded-lg hover:bg-red-500 transition duration-200 shadow">
                Rechercher
            </button>
            <button type="button" onclick="window.location.href='taches_list.php'"
                class="bg-gray-300 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-400 transition duration-200 shadow">
                Réinitialiser
            </button>
        </form>
    </div>

    <!-- Contenu dynamique -->
    <div id="contenu-taches" class="container"></div>
</section>

<script>
function chargerTaches(page = 1) {
    const recherche = document.getElementById('recherche').value;
    fetch(`ajax_taches.php?page=${page}&recherche=${encodeURIComponent(recherche)}`)
        .then(response => response.text())
        .then(data => {
            document.getElementById('contenu-taches').innerHTML = data;
        });
}

// Au chargement
document.addEventListener("DOMContentLoaded", () => {
    chargerTaches();
    document.getElementById('form-filtre').addEventListener('submit', e => {
        e.preventDefault();
        chargerTaches();
    });
});
</script>

<?php require_once 'includes/footer.php'; ?>
