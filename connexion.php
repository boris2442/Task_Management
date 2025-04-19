<?php
session_start();
require_once "includes/database/database.php";
require_once 'includes/functions/clean_input.php';
$error = [];

if (!empty($_POST)) {
    if (
        isset($_POST['email'], $_POST['password'])  && !empty($_POST['email']) && !empty($_POST['password'])


    ) {
        $email = clean_input($_POST['email']);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error['email'] = "email is not valid";
        }
        // $sql = "SELECT* FROM `utilisateurs` WHERE email=:email";
        $sql = "SELECT id_utilisateur, nom, email, functions,  password FROM `utilisateurs` WHERE email = :email";

        $requete = $db->prepare($sql);
        $requete->bindValue(":email", $email);
        $requete->execute();
        $users = $requete->fetch();
        echo "<pre>";
        var_dump($users);
        echo "</pre>";
        if (!$users) {
            $error['users'] = "❌ Aucun utilisateur trouvé avec cet email.";
        }


        //verification du mot de passe
        $password =clean_input($_POST['password']) ;


        if ($users && !password_verify($password, $users['password'])) {
            $error = " ❌ incorrect password";
        }


        if (empty($error)) {

            $_SESSION['users'] = [
                'id' => $users['id_utilisateur'],
                'email' => $users['email'], // c’est bien "mail" dans ta BDD
                'functions' => $users['functions'],
                'pseudo' => $users['nom']
            ];


            // Si l'utilisateur a coché "Se souvenir de moi"
            if (isset($_POST['remember_me'])) {
                setcookie('email', $users['email'], time() + 1 * 24 * 3600, "/", null, false, true); // Cookie valide pendant 1 an
            } else {
                // Si la case n'est pas cochée, supprimer le cookie existant
                setcookie('email', '', time() - 3600, "/");
            }

            // if ($users['functions'] === 'admin') {
            //     header('location:dashbord.php');
            // } else {
            //     header('location:choose_tache.php');
            // }
            header('location:presentation_after_connexion.php');
        }
    } else {
        $error = "veuillez remplir tous les champs";
    }
}

?>

<?php
$title = 'connexion a la database';
require_once 'includes/header.php'
?>
<section>
<h2 class="text-2xl ">Bien vouloir vous connectez</h2>
<!-- <form method="POST" class=" bg-white p-6 rounded shadow max-w-lg mx-auto">
    <div class="flex flex-col gap-[7px] pt-[7px]">
        <?php
        if (isset($error)) {
            echo '<p class="bg-green-500  border-green-300 p-[9px] rounded focus:outline-none focus:border-green-500 text-white font-bold min-h-[30px]">' . $error . '</p>';
        }

        ?>

        <div class="text-left flex flex-col gap-[7px]">
            <label for="mail">Email :</label>

            <input type="text" required placeholder="Votre mail" id="mail" value="<?php echo isset($_COOKIE['email']) ? htmlspecialchars($_COOKIE['email']) : ''; ?>" name="email" class="w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500" />
        </div>


        <div class="text-left flex flex-col gap-[7px]">
            <label for="password">Mot de passe</label>
            <div class="relative">
                <input type="password" placeholder="Votre mot de passe" id="password" name="password" required
                    class="w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500" value="<?php echo $password ?? ""  ?>" />

                <i class="fa-solid fa-eye  absolute right-3 top-3 cursor-pointer text-gray-500" id="togglePassword"></i>
            </div>
        </div>


        <div class="w-full text-left flex  gap-[7px] ">



            <label for="souvenir">remember_me!</label>
            <input type="checkbox" name="remember_me" id="souvenir" value="Se souvenir de moi!">
        </div>
        <div class="text-left flex flex-col gap-[7px]">
            <input type="submit" name="formconnexion" value="Se connecter" class="w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500 bg-green-100" />
        </div>


    </div>
</form>
 -->


<form method="POST" action="" class=" p-6 rounded shadow max-w-lg mx-auto mt-[10vh]" id='form_inscription'>
    <div class="flex flex-col gap-[7px] pt-[7px] justify-center ">
        <?php
        if (!empty($errors)) {
            echo '<div style="color:white; text-align: center; background-color:#ff6c6c;padding:2px 7px; margin-bottom:10px; font-size:16px;">' . reset($errors) . '</div>';
        }
        ?>



        <div class="text-left flex flex-col gap-[7px]">
            <label for="mail">Email :</label>
            <input type="email" required placeholder="Votre mail" id="mail" value="<?php echo isset($_COOKIE['email']) ? htmlspecialchars($_COOKIE['email']) : ''; ?>" name="email" class="w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500" />
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



            </div>
        </div>
        <div class="w-full text-left flex  gap-[7px] ">



            <label for="souvenir">remember_me!</label>
            <input type="checkbox" name="remember_me" id="souvenir" value="Se souvenir de moi!">
        </div>
        <div class="text-left flex flex-col gap-[7px]">

            <input type="submit" name="forminscription" value="connectez" class="w-full border  p-2 rounded focus:outline-none focus:border-green-500 bg-[#ff6c6c] hover:bg-red-400" />
        </div>


    </div>
</form>

</section>







<?php
require_once 'includes/footer.php'
?>