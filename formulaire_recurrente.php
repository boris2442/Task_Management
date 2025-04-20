<?php
$title = "reccurente tache";
require_once 'includes/header.php'
?>
<section>
<div class="min-h-screen bg-[#B4CA65] flex items-center justify-center p-6">
  <form action="ajouter_tache.php" method="POST" class="w-full max-w-xl bg-white p-8 rounded-2xl shadow-lg space-y-6">
    
    <h2 class="text-2xl font-bold text-[#333]">Ajouter une tâche</h2>

    <!-- Titre -->
    <div>
      <label class="block text-[#333] mb-1 font-semibold">Titre de la tâche</label>
      <input type="text" name="titre" required class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-400" placeholder="Ex: Organiser un événement">
    </div>

    <!-- Description -->
    <div>
      <label class="block text-[#333] mb-1 font-semibold">Description</label>
      <textarea name="description" rows="4" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-400" placeholder="Détails de la tâche..."></textarea>
    </div>

    <!-- Échéance -->
    <div>
      <label class="block text-[#333] mb-1 font-semibold">Échéance</label>
      <input type="date" name="echeance" required class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-400">
    </div>

    <!-- Étapes (tâche complexe) -->
    <div>
      <label class="block text-[#333] mb-1 font-semibold">Étapes (si complexe)</label>
      <textarea name="etapes" rows="3" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-400" placeholder="Ex: Préparer la salle, Envoyer les invitations, etc."></textarea>
    </div>

    <!-- Fréquence (tâche récurrente) -->
    <div>
      <label class="block text-[#333] mb-1 font-semibold">Fréquence (si récurrente)</label>
      <select name="frequence" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-400">
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
      <input type="date" name="date_fin" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-400">
    </div>

    <!-- Bouton -->
    <div class="text-right">
      <button type="submit" class="bg-red-400 text-white px-6 py-2 rounded-xl font-semibold hover:bg-red-500 transition">Ajouter la tâche</button>
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