<?php
session_start();
require_once 'includes/functions/function.php';
require_once 'includes/functions/clean_input.php';
require_once 'includes/database/database.php';

if (!isset($_SESSION['users'])) {
    exit("Non autorisé");
}

$id = $_SESSION['users']['id'];
$recherche = isset($_GET['recherche']) ? trim($_GET['recherche']) : '';
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$limit = 5;
$offset = ($page - 1) * $limit;

$req = "SELECT * FROM taches WHERE id_utilisateur = :id_utilisateur";
$params = ['id_utilisateur' => $id];

$typesAutorises = ['simple', 'complexe', 'recurrente'];
if (!empty($recherche) && in_array($recherche, $typesAutorises)) {
    $req .= " AND type = :recherche";
    $params['recherche'] = $recherche;
}

// Total tâches
$totalReq = $db->prepare($req);
$totalReq->execute($params);
$totalTaches = $totalReq->rowCount();

// Pagination
$req .= " ORDER BY create_at DESC LIMIT $limit OFFSET $offset";
$sql = $db->prepare($req);
$sql->execute($params);
$taches = $sql->fetchAll(PDO::FETCH_ASSOC);

// Affichage des tâches
foreach ($taches as $tache): ?>
    <div class="bg-white rounded-2xl shadow-lg p-6 mb-6 border-l-8 border-r-8 border-red-400 max-w-4xl w-full mx-auto">
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

<?php if ($totalTaches > $limit): ?>
    <div class="flex justify-center items-center space-x-2 my-6">
        <?php
        $totalPages = ceil($totalTaches / $limit);
        for ($i = 1; $i <= $totalPages; $i++): ?>
            <button onclick="chargerTaches(<?= $i ?>)"
                class="px-4 py-2 rounded-lg 
                <?= $i == $page ? 'bg-red-400 text-white font-semibold' : 'bg-gray-200 text-[#333]' ?> 
                hover:bg-red-300 transition duration-200">
                <?= $i ?>
            </button>
        <?php endfor; ?>
    </div>
<?php endif; ?>
