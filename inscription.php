<?php
session_start();
require_once "includes/database/database.php";
require_once 'includes/functions/function.php';
require_once 'includes/functions/clean_input.php';

if ($_POST) {
    //recuperation des erreurs sous forme de tableau
    $errors = [];
    if (
        empty($_POST['nom'])
        // || !preg_match('/^[a-zA-Z0-9_]{3,20}$/', $_POST['nom'])


    ) {
        $errors['nom'] = "Le nom  doit contenir entre 3 et 20 caractères alphanumériques";
    } else {
        $nom = clean_input($_POST['nom']);
        $stmt = $db->prepare("SELECT * FROM utilisateurs WHERE nom = ?");
        $stmt->execute([$nom]);
        if ($stmt->rowCount() > 0) {
            $errors['nom'] = "Ce nom d'utilisateur existe déjà";
        }
    }
    //email
    if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "L'email est invalide";
    } else {
        $email = clean_input($_POST['email']);
        $stmt = $db->prepare("SELECT * FROM utilisateurs WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->rowCount() > 0) {
            $errors['email'] = "Cet email existe déjà";
        }
    }

    if (
        empty($_POST['password'])

    ) {
        $errors['password'] = "Le mot de passe doit contenir au moins 8 caractères, une majuscule, une minuscule et un chiffre";
    }
    var_dump(clean_input($_POST['nom']), clean_input($_POST['email']), clean_input($_POST['password']));
    //INSERT INTO
    if (empty($errors)) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);


        $stmt = $db->prepare("INSERT INTO utilisateurs (nom, email, password) VALUES (:nom, :email, :password )");
        $stmt->execute([
            'nom' => $nom,
            'email' => $email,
            'password' => $password,

        ]);
        header('location:connexion.php');
        exit();
    }
}

?>

<?php
$title = "inscription a la database";
require_once 'includes/header.php'
?>
<h1 class="text-2xl pl-[20px] pt-[20px]">Bien vouloir vous inscrire</h1>
<form method="POST" action="" class=" p-6 rounded shadow max-w-lg mx-auto mt-[10vh]" id='form_inscription'>
    <div class="flex flex-col gap-[7px] pt-[7px] justify-center ">
        <?php
        if (!empty($errors)) {
            echo '<div style="color:white; text-align: center; background-color:#ff6c6c;padding:2px 7px; margin-bottom:10px; font-size:16px;">' . reset($errors) . '</div>';
        }
        ?>

        <div class="text-left flex flex-col gap-[7px]">
            <label for="nom">Pseudo :</label>
            <input type="text" placeholder="Votre pseudo" id="nom" name="nom" value="<?= clean_input($_POST['nom'] ?? '')  ?>" required class="w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500" />
        </div>

        <div class="text-left flex flex-col gap-[7px]">
            <label for="mail">Email :</label>
            <input type="email" required placeholder="Votre email" id="mail" value="<?= clean_input($_POST['email'] ?? '')  ?>" name="email" class="w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500" />
        </div>

        <div class="text-left flex flex-col gap-[7px]">
            <label for="password">Mot de passe</label>
            <div class="relative">
                <input type="password" required placeholder="Votre mot de passe" id="password" name="password" class="w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500" value="<?= clean_input($_POST['password'] ?? '')  ?>" /> <svg id="togglePassword" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor" width="24" height="24" class="absolute right-3 top-3 cursor-pointer ">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5
           c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5
           c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774
           M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21
           m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243
           m4.242 4.242L9.88 9.88" />
                </svg>



                <!-- <i class="fa-solid fa-eye absolute right-3 top-3 cursor-pointer text-gray-500" id="togglePassword"></i> -->
            </div>
        </div>

        <div class="text-left flex flex-col gap-[7px]">

            <input type="submit" name="forminscription" value="S'inscrire" class="w-full border  p-2 rounded focus:outline-none focus:border-green-500 bg-[#ff6c6c] hover:bg-red-400" />
        </div>

        <!-- <div class="w-full text-left flex gap-[7px] justify-between">
            <a href="connexion.php" class="border  p-2 rounded focus:outline-none focus:border-green-500 bg-red-500 hover:bg-red-400">Se connecter</a>
        </div> -->
    </div>
</form>


<?php
require_once 'includes/footer.php'
?>