<?php
// session_start();

// require_once 'includes/functions/function.php';
// require_once 'includes/functions/clean_input.php';
// require_once 'includes/database/database.php';

// if (!isset($_SESSION['users'])) {
//     header('location:connexion.php');
//     exit();
// }


// $id = $_SESSION['users']['id'];
// // $sql = $db->prepare("SELECT * FROM taches WHERE id_utilisateur = :id_utilisateur orderniere_modification = :id_utilisateur ORDER BY create_at DESC");
//  $sql = $db->prepare("SELECT * FROM taches WHERE id_utilisateur = :id_utilisateur ORDER BY create_at DESC");
// $sql->execute([
//     'id_utilisateur' => $id
// ]);
// $taches = $sql->fetchAll(PDO::FETCH_ASSOC);





// session_start();
// require_once 'includes/functions/function.php';
// require_once 'includes/functions/clean_input.php';
// require_once 'includes/database/database.php';

// // Vérification de la connexion
// if (!isset($_SESSION['users'])) {
//     header('location:connexion.php');
//     exit();
// }

// $id = $_SESSION['users']['id'];

// // Gestion de la recherche et pagination
// $recherche = isset($_GET['recherche']) ? trim($_GET['recherche']) : '';
// $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
// $limit = 5;
// $offset = ($page - 1) * $limit;

// $req = "SELECT * FROM taches WHERE id_utilisateur = :id_utilisateur";
// $params = ['id_utilisateur' => $id];

// if (!empty($recherche)) {
//     $req .= " AND (sujet LIKE :recherche OR destinataire LIKE :recherche OR message LIKE :recherche)";
//     $params['recherche'] = '%' . $recherche . '%';
// }

// // Nombre total
// $totalReq = $db->prepare($req);
// $totalReq->execute($params);
// $totalTaches = $totalReq->rowCount();

// // Tâches à afficher avec pagination
// $req .= " ORDER BY create_at DESC LIMIT $limit OFFSET $offset";
// $sql = $db->prepare($req);
// $sql->execute($params);
// $taches = $sql->fetchAll(PDO::FETCH_ASSOC);











session_start();
require_once 'includes/functions/function.php';
require_once 'includes/functions/clean_input.php';
require_once 'includes/database/database.php';

if (!isset($_SESSION['users'])) {
    header('location:connexion.php');
    exit();
}

$id = $_SESSION['users']['id'];

// Récupération des paramètres
$recherche = isset($_GET['recherche']) ? trim($_GET['recherche']) : '';
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$limit = 5;
$offset = ($page - 1) * $limit;

// Requête de base
$req = "SELECT * FROM taches WHERE id_utilisateur = :id_utilisateur";
$params = ['id_utilisateur' => $id];

// Recherche par type
$typesAutorises = ['simple', 'complexe', 'recurrente'];
if (!empty($recherche) && in_array($recherche, $typesAutorises)) {
    $req .= " AND type = :recherche";
    $params['recherche'] = $recherche;
}

// Récupération du nombre total de résultats
$totalReq = $db->prepare($req);
$totalReq->execute($params);
$totalTaches = $totalReq->rowCount();

// Ajout de l'ordre et de la pagination
$req .= " ORDER BY create_at DESC LIMIT $limit OFFSET $offset";
$sql = $db->prepare($req);
$sql->execute($params);
$taches = $sql->fetchAll(PDO::FETCH_ASSOC);



?>

<?php
require_once 'includes/header.php';
require_once 'includes/navbar.php';
?>
<section>

<h1 class="text-2xl text-center p-2">Listes de taches de <span class="font-bold"><?php echo $_SESSION['users']['pseudo'] ?></span> </h1>



<!-- Zone de recherche -->


<div class="max-w-4xl mx-auto px-4 py-4">
    <form method="GET" action="" class="flex flex-col sm:flex-row gap-4 items-center justify-between">
        <select name="recherche"
                class="w-full sm:w-3/4 px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-red-400 text-[#333]">
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


<div class="container">
    <?php
    foreach ($taches as $tache):
    ?>

        <!-- <div class="bg-white rounded-xl shadow-lg p-6 mb-6 border-l-8 border-red-400 max-w-3xl mx-auto">
            <h5 class="text-2xl font-bold text-[#333] mb-4">
                <?= clean_input($tache['sujet']); ?>
            </h5>

            <div class="space-y-2 text-[#333]">
                <p><span class="font-semibold">Destinataire :</span> <?= clean_input($tache['destinataire']); ?></p>
                <p><span class="font-semibold">Message :</span> <?= clean_input($tache['message']); ?></p>
                <p><span class="font-semibold">Type :</span> <?= clean_input($tache['type']); ?></p>
                <p><span class="font-semibold">Fréquence :</span> <?= clean_input($tache['frequence']); ?></p>
                <p><span class="font-semibold">Date Limite :</span> <?= clean_input($tache['date_limite']); ?></p>
                <p><span class="font-semibold">Étapes :</span> <?= clean_input($tache['etapes']); ?></p>
                <p><span class="font-semibold">Créée le :</span> <?= clean_input($tache['create_at']); ?></p>
            </div>

            <div class="mt-6">
                <span class="inline-block bg-red-400 text-white px-4 py-1 rounded-full text-sm font-semibold">
                    Statut actuel : <?= strtoupper(clean_input($tache['statut'] ?? 'En attente')) ?>
                </span>
            </div>
        </div> -->
        <div class="bg-white rounded-2xl shadow-lg p-6 mb-6 border-l-8 border-red-400 max-w-4xl w-full mx-auto">
    <h5 class="text-2xl sm:text-3xl font-bold text-[#333] mb-4 break-words">
        <?= clean_input($tache['sujet']); ?>
    </h5>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-[#333]">
        <p><span class="font-semibold">Destinataire :</span> <?= clean_input($tache['destinataire']); ?></p>
        <p><span class="font-semibold">Type :</span> <?= clean_input($tache['type']); ?></p>

        <p class="sm:col-span-2"><span class="font-semibold">Message :</span> <?= clean_input($tache['message']); ?></p>
        
        <p><span class="font-semibold">Fréquence :</span> <?= clean_input($tache['frequence']); ?></p>
        <p><span class="font-semibold">Date Limite :</span> <?= clean_input($tache['date_limite']); ?></p>
        
        <p><span class="font-semibold">Étapes :</span> <?= clean_input($tache['etapes']); ?></p>
        <p><span class="font-semibold">Créée le :</span> <?= clean_input($tache['create_at']); ?></p>
    </div>

    <div class="mt-6">
        <span class="inline-block bg-red-400 text-white px-4 py-1 rounded-full text-sm font-semibold shadow-sm">
            Statut actuel : <?= strtoupper(clean_input($tache['statut'] ?? 'EN ATTENTE')) ?>
        </span>
    </div>
</div>

    <?php endforeach; ?>

</div>


<!-- Pagination -->
<?php
$totalPages = ceil($totalTaches / $limit);
if ($totalPages > 1): ?>
    <div class="flex justify-center items-center space-x-2 my-6">
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a href="?page=<?= $i ?>&recherche=<?= urlencode($recherche) ?>"
               class="px-4 py-2 rounded-lg 
               <?= $i == $page ? 'bg-red-400 text-white font-semibold' : 'bg-gray-200 text-[#333]' ?> 
               hover:bg-red-300 transition duration-200">
                <?= $i ?>
            </a>
        <?php endfor; ?>
    </div>
<?php endif; ?>
</section>

<?php
require_once 'includes/footer.php';
?>