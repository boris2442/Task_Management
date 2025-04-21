<!-- Navbar -->
<header class="bg-[#B4CA65] shadow-md sticky top-0 z-50">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center h-16">

    <!-- Logo -->
    <div class="flex items-center space-x-2">
      <!-- <img src="../assets/logo/logo.webp" alt="Logo" class="h-10 w-10 object-cover"> -->
      <span class="text-xl font-bold text-white uppercase" style="font-family: cursive; ">TASKMANAGER</span>
    </div>

    <!-- Desktop Nav -->
    <nav class="hidden md:flex space-x-6 items-center text-white font-medium">

      <!-- <a href="#" class="hover:underline hover:text-[#ff6c6c]">Profil</a> -->
      <?php
      if (!isset($_SESSION['users']['id'])) {

      ?>
        <!-- <a href="taches_list" class="hover:underline hover:text-[#ff6c6c]">Tâches</a> -->
        <!-- <a href="presentation_after_connexion.php" class="hover:underline hover:text-[#ff6c6c]">presentation</a> -->
        <a href="inscription.php" class="hover:underline hover:text-[#ff6c6c]">Inscription</a>
        <a href="connexion.php" class="hover:underline hover:text-[#ff6c6c]">Connexion</a>
      <?php
      } else {
      ?>
        <a href="presentation_after_connexion.php" class="hover:underline hover:text-[#ff6c6c]">Presentation</a>
        <a href="taches_list.php" class="hover:underline hover:text-[#ff6c6c]">Tâches</a>
        <a href="#" class="hover:underline hover:text-[#ff6c6c]">Profil</a>
        <a href="deconnexion.php" class="hover:underline hover:text-[#ff6c6c]">Déconnexion</a>
      <?php
      }
      ?>

      <!-- <a href="#" class="hover:underline">Inscription</a> -->

    </nav>

    <!-- Mobile menu button -->
    <div class="md:hidden">
      <button id="menu-btn" class="text-white focus:outline-none">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
          viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
          <path d="M4 6h16M4 12h16M4 18h16" />
        </svg>
      </button>
    </div>
  </div>

  <!-- Mobile menu -->
  <div id="mobile-menu" class="hidden md:hidden bg-[#B4CA65] px-4 py-4 space-y-2 text-white font-medium">
    <!-- Mêmes liens que le desktop, à adapter aussi -->
    <!-- <a href="#" class="block hover:underline">Profil</a> -->

    <?php
      if (!isset($_SESSION['users']['id'])) {
      ?>
        <a href="inscription.php" class="block hover:underline">Inscription</a>
        <a href="connexion.php" class="block hover:underline">Connexion</a>
    <?php
      } else {
      ?>
        <a href="presentation_after_connexion.php" class="block hover:underline">Presentation</a>
        <a href="taches_list.php" class="block hover:underline">Tâches</a>
        <a href="#" class="block hover:underline">Profil</a>
        <a href="deconnexion.php" class="block hover:underline">Déconnexion</a>
      <?php
      }
      ?>

    <!-- <a href="taches_list.php" class="block hover:underline">Listes-Tâches</a>

    <a href="presentation_after_connexion.php" class="block hover:underline">Presentation</a>
 
    <a href="deconnexion.php" class="block hover:underline">Déconnexion</a> -->
  </div>
</header>

<script>
  const btn = document.getElementById('menu-btn');
  const menu = document.getElementById('mobile-menu');
  btn.addEventListener('click', () => {
    menu.classList.toggle('hidden');
  });
</script>