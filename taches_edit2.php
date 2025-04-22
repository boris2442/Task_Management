<?php
// require_once "includes/database/database.php";
// require_once "includes/functions/clean_input.php";
// if($_GET['id']){
//     $id_tache=$_GET['id'];
//     $sql = "SELECT * FROM taches WHERE id_tache=:id_tache";
//     $requete = $db->prepare($sql);
//     $requete->bindParam(':id_tache', $id_tache);
//     $requete->execute();
//     $tache = $requete->fetch(PDO::FETCH_ASSOC);
    
//     $sql="UPDATE `taches` SET `sujet`=:sujet,`message`=:message,`etapes`=:etapes, `frequence`=:frequence,`date_limite`=:date_limite , `statut`=:statut WHERE id_tache=:id_tache";
//     $requete = $db->prepare($sql);
//     $requete->bindParam(':sujet', $_POST['sujet']);
//     $requete->bindParam(':message', $_POST['description']);
//     $requete->bindParam(':etapes', $_POST['etapes']);
//     $requete->bindParam(':frequence', $_POST['frequence']);
//     $requete->bindParam(':date_limite', $_POST['date']);
//     $requete->bindParam(':statut', $_POST['statut']);
//     $requete->bindParam(':id_tache', $id_tache);
//     $requete->execute();
 


 
//     if (!$tache) {
//         echo "Aucune tâche trouvée avec cet ID.";
//         exit;
//     }
// } else {
//     echo "Aucun ID de tâche fourni.";
//     exit;


// }

?>






<?php

require_once "includes/database/database.php";
require_once "includes/functions/clean_input.php";

if ($_GET['id']) {
    $id_tache = $_GET['id'];

    // 1. Récupérer la tâche AVANT tout
    $sql = "SELECT * FROM taches WHERE id_tache=:id_tache";
    $requete = $db->prepare($sql);
    $requete->bindParam(':id_tache', $id_tache);
    $requete->execute();
    $tache = $requete->fetch(PDO::FETCH_ASSOC);

    if (!$tache) {
        echo "Aucune tâche trouvée avec cet ID.";
        exit;
    }

    // 2. Si formulaire soumis : mettre à jour
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $sql = "UPDATE taches SET sujet=:sujet, message=:message, etapes=:etapes, frequence=:frequence, date_limite=:date_limite, statut=:statut WHERE id_tache=:id_tache";
        $requete = $db->prepare($sql);
        $requete->bindParam(':sujet', $_POST['sujet']);
        $requete->bindParam(':message', $_POST['description']);
        $requete->bindParam(':etapes', $_POST['etapes']);
        $requete->bindParam(':frequence', $_POST['frequence']);
        $requete->bindParam(':date_limite', $_POST['date']);
        $requete->bindParam(':statut', $_POST['statut']);
        $requete->bindParam(':id_tache', $id_tache);
        $requete->execute();

        // Pour mise à jour en temps réel dans le formulaire après submit :
        header("Location: editer_tache.php?id=" . $id_tache); // ou redirection
        exit;
    }
} else {
    echo "Aucun ID de tâche fourni.";
    exit;
}


?>











<?php
$title = "editer reccurente tache";
require_once 'includes/header.php'
?>
<section>
  <div class="min-h-screen bg-[#B4CA65] flex items-center justify-center p-6">
    <form method="POST" class="w-full max-w-xl bg-white p-8 rounded-2xl shadow-lg space-y-6">
      <?php

      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        foreach ($errors as $error) {
          echo "<div style='color:white; text-align: center; background-color:#ff6c6c;padding:2px 7px; margin-bottom:10px; font-size:16px;'>
      $error
      </div>";
        }
      }
      ?>
      <h2 class="text-2xl font-bold text-red-400">Editer une tâche reccurrente</h2>

      <!-- Titre -->
      <div>
        <label class="block text-[#333] mb-1 font-semibold">Titre de la tâche</label>
        <input type="text" name="sujet" value="<?= $tache['sujet'] ?>" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-2 focus:border-[#B4CA65] focus:text-gray-800 text-gray-700" placeholder="Ex: Organiser un événement" >
      </div>

      <!-- Description -->
      <div>
        <label class="block text-[#333] mb-1 font-semibold">Description</label>
        <textarea name="description" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-2 focus:border-[#B4CA65] focus:text-gray-800 text-gray-700" placeholder="Détails de la tâche..." value="<?= clean_input($tache['message'] ??'') ?>"></textarea>
      </div>

      <!-- Échéance -->
      <!-- <div>
      <label class="block text-[#333] mb-1 font-semibold">Échéance</label>
      <input type="date" name="echeance" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-2 focus:border-[#B4CA65] focus:text-gray-800 text-gray-700">
    </div> -->

      <!-- Étapes (tâche complexe) -->
      <div>
        <label class="block text-[#333] mb-1 font-semibold">Étapes (si complexe)</label>
        <textarea name="etapes" rows="4" class="w-full resize-none px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-2 focus:border-[#B4CA65] focus:text-gray-800 text-gray-700" placeholder="Ex: Préparer la salle, Envoyer les invitations, etc." value="<?= clean_input($tache['etapes'] ?? '') ?>"></textarea>
      </div>

      <!-- Fréquence (tâche récurrente) -->
      <div>
        <label class="block text-[#333] mb-1 font-semibold">Fréquence (si récurrente)</label>
        <select name="frequence" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-2 focus:border-[#B4CA65] focus:text-gray-800 text-gray-700" value="<?= $tache['frequence'] ?>">
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
        <input type="date" value="<?= clean_input($tache['date_limite'] ?? '') ?>" name="date" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-2 focus:border-[#B4CA65] focus:text-gray-800 text-gray-700">
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
        <button type="submit" class="w-full bg-[#ff6c6c] hover:bg-red-400 text-white font-bold py-2 px-4 rounded-md transition duration-300">Renommer tâche</button>
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