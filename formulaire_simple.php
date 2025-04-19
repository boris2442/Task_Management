<?php
$title = "simple tache";
require_once 'includes/header.php'
?>
<section>
   
    <form action="traitement_tache_simple.php" method="POST" class="max-w-xl mx-auto bg-white p-8 rounded-lg shadow-md mt-[5%] w-[90%]">
  <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Répondre à un Email</h2>

  <div class="mb-4">
    <label for="destinataire" class="block text-gray-700 font-semibold mb-2">Adresse Email du Destinataire</label>
    <input type="email" id="destinataire" name="destinataire" required
           class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-2 focus:border-[#B4CA65] focus:text-gray-800 text-gray-700">
  </div>

  <div class="mb-4">
    <label for="sujet" class="block text-gray-700 font-semibold mb-2">Sujet</label>
    <input type="text" id="sujet" name="sujet" required
           class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-2 focus:border-[#B4CA65] focus:text-gray-800 text-gray-700">
  </div>

  <div class="mb-4">
    <label for="message" class="block text-gray-700 font-semibold mb-2">Message</label>
    <textarea id="message" name="message" rows="6" required
              class="resize-none w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-2 focus:border-[#B4CA65]  focus:text-gray-800 text-gray-700"></textarea>
  </div>

  <button type="submit"
          class="w-full bg-[#ff6c6c] hover:bg-red-400 text-white font-bold py-2 px-4 rounded-md transition duration-300">
    Envoyer la Réponse
  </button>
</form>

</section>
<?php

require_once 'includes/footer.php'
?>