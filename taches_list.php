<?php
session_start();
// Connexion à la base de données
require_once 'includes/functions/function.php';
require_once 'includes/functions/clean_input.php';
require_once 'includes/database/database.php';
// Vérification de la connexion de l'utilisateur
if (!isset($_SESSION['users'])) {
    header('location:connexion.php');
    exit();
}

// Listes des taches de l utilisateur
$id = $_SESSION['users']['id'];
$sql = $db->prepare("SELECT * FROM taches WHERE id_utilisateur = :id_utilisateur");
$sql->execute([
    'id_utilisateur' => $id
]);
$taches = $sql->fetchAll(PDO::FETCH_ASSOC);
// echo "<pre>";
// var_dump($taches);
// echo "</pre>";
// exit();



?>

<?php
require_once 'includes/header.php';
require_once 'includes/navbar.php';
?>
<h1>Listes de taches Par</h1>
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


<?php
require_once 'includes/footer.php';
?>