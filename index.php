<?php
require_once "includes/header.php"
?>


<section class="bg-[#B4CA65] py-20 px-6 md:px-16">
    <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center gap-10">

        <!-- Texte -->
        <div class="flex-1 text-center md:text-left">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">
                Bienvenue sur notre <span class="text-[#9A5151]">gestionnaire de tâches</span>
            </h1>
            <p class="text-lg md:text-xl text-white mb-6">
                Organisez, suivez et gérez toutes vos tâches en toute simplicité.
            </p>
            <button class="bg-[#9A5151] text-white font-semibold px-6 py-3 rounded-full shadow-md hover:bg-[#B4CA66] transition duration-300">
                <a href="inscription.php">       Commencer</a>
         
            </button>
        </div>

        <!-- Image -->
        <div class="flex-1">
            <img src="./assets/inages/image.png" alt="Tâche" class="w-full max-w-sm mx-auto md:mx-0 rounded-lg shadow-lg">


        </div>

    </div>
</section>






<?php
require_once "includes/footer.php"
?>