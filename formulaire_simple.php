<?php
session_start();
//traitement_tache_simple.php

// Connexion à la base de données
require_once __DIR__ . '/includes/database/database.php';
require_once 'includes/functions/clean_input.php';
if (isset($_SESSION['users']['id'])) {


  // Vérification de la soumission du formulaire
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération et nettoyage des données
    $destinataire = clean_input($_POST['destinataire'] ?? '');
    $sujet = clean_input($_POST['sujet'] ?? '');
    $message = clean_input($_POST['message'] ?? '');

    // Validation des données
    $errors = [];

    if (empty($destinataire) || !filter_var($destinataire, FILTER_VALIDATE_EMAIL)) {
      $errors[] = "Le destinataire est requis.";
    }

    if (empty($sujet) || strlen($sujet) > 40) {
      $errors[] = "La sujet est requise et la taille n excede pas 50 caracteres.";
    }

    if (empty($message) || strlen($message) > 255) {
      $errors[] = "L'échéance est requise et la taille n excede pas 50 caracteres.";
    }

    if (empty($errors)) {
      // Préparation de la requête d'insertion
      $stmt = $db->prepare("INSERT INTO taches (destinataire, sujet, message, type) VALUES (:destinataire, :sujet, :message, 'simple')");
      $stmt->execute([
        'destinataire' => $destinataire,
        'sujet' => $sujet,
        'message' => $message
      ]);
      $id=$db->lastInsertId();
      $email=$_SESSION['users']['email'];
      $subjet=$_POST['sujet'];
      // $message_content=$_POST['message'];
      $message_content="
       <html>
        <head>
            <style>
                body {
                    font-family: 'Poppins', Arial, sans-serif;
                    background-color: #B4CA65;
                    color: #fff;
                }
                a {
                    color: #007BFF;
                    font-family:monospace;
                
                    text-decoration: underline;
                  }
            </style>
        </head>
        <body>
        <p>$message</p>
        </body>
        </html>
      ";
      $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        mail($email,$subjet, $message_content,$headers );
      // Redirection ou message de succès
      header('Location: liste_taches.php');
      exit();

      // } else {
      //   // Affichage des erreurs
      //   foreach ($errors as $error) {
      //     // echo "<p style='color:red;'>
      //     $error
      //     // </p>";
      //   }
    }
  }
} else {
  header('location:connexion.php');
} ?>

<?php
$title = "simple tache";
require_once 'includes/header.php'
?>
<section>

  <form

    method="POST" class="max-w-xl mx-auto bg-white p-8 rounded-lg shadow-md mt-[5%] w-[90%]">
    <?php

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      foreach ($errors as $error) {
        echo "<div style='color:white; text-align: center; background-color:#ff6c6c;padding:2px 7px; margin-bottom:10px; font-size:16px;'>
      $error
      </div>";
      }
    }
    ?>
    <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Répondre à un Email</h2>

    <div class="mb-4">
      <label for="destinataire" class="block text-gray-700 font-semibold mb-2">Adresse Email du Destinataire</label>
      <input type="email" id="destinataire" name="destinataire" required
        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-2 focus:border-[#B4CA65] focus:text-gray-800 text-gray-700" placeholder="destinataire@gmail.com">
    </div>

    <div class="mb-4">
      <label for="sujet" class="block text-gray-700 font-semibold mb-2">Sujet</label>
      <input type="text" id="sujet" name="sujet" required
        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-2 focus:border-[#B4CA65] focus:text-gray-800 text-gray-700">
    </div>

    <div class="mb-4">
      <label for="message" class="block text-gray-700 font-semibold mb-2">Message</label>
      <textarea id="message" name="message" rows="6" required
        class="resize-none w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-2 focus:border-[#B4CA65]  focus:text-gray-800 text-gray-700">
      </textarea>
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