<?php
session_start();
require_once "includes/database/database.php";


if ($_POST) {
    echo "<pre>";
    // var_dump($_POST);
    echo "</pre>";




    //recuperation des erreurs sous forme de tableau
    $errors = [];
    if (
        empty($_POST['username'])
        || !preg_match("/^[a-zA-Z0-9_]{3,20}$/", $_POST['username'])
    ) {
        $errors['username'] = "Le nom  doit contenir entre 3 et 20 caractères alphanumériques";
        // var_dump($errors['username']);
    } else {
        $username = htmlspecialchars(trim($_POST['username']));
        $stmt = $db->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        if ($stmt->rowCount() > 0) {
            $errors['username'] = "Ce nom d'utilisateur existe déjà";
        }
    }
    //email
    if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "L'email est invalide";
    } else {
        $email = htmlspecialchars(trim($_POST['email']));
        $stmt = $db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->rowCount() > 0) {
            $errors['email'] = "Cet email existe déjà";
        }
    }

    if (
        empty($_POST['password'])
        
    ) {
        $errors['password'] = "Le mot de passe doit contenir au moins 8 caractères, une majuscule, une minuscule et un chiffre";
    } elseif (trim($_POST['password']) !== trim($_POST['confirm_password'])) {
        $errors['confirm_password'] = "Les mots de passe ne correspondent pas";
    }
    //INSERT INTO
    if (empty($errors)) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        //appele la fonction generateToken pour generer un token aleatoire de 100 caracteres
        $token = generateToken(100);
        var_dump($token);
     
        $stmt = $db->prepare("INSERT INTO users (username, email, password, confirmation_token) VALUES (:username, :email, :password, :confirmation_token)");
        $stmt->execute([
            'username' => $username,
            'email' => $email,
            'password' => $password,
            'confirmation_token' => $token
        ]);
        $userId = $db->lastInsertId(); //retourne l'id du dernier utilisateur inserer


        $mail = $_POST['email'];
        $subject="Confirmation du compte";
        $link="http://localhost/php-2025/cours-php/gestion_compte_user_cfpc_2025/confirm?id=$userId&token=$token";
     

        $message = "
        <html>
        <head>
            <style>
                body {
                    font-family: 'Poppins', Arial, sans-serif;
                    background-color: #f4f4f4;
                    color: #333;
                }
                a {
                    color: #007BFF;
                    font-family:'Italianno', sans-serif;
                
                    text-decoration: underline;
                }
            </style>
        </head>
        <body>
            <p>Bonjour,</p>
            <p>Afin de confirmer votre compte, merci de cliquer sur ce lien :</p>
            <p><a href='$link'>Confirmer mon compte</a></p>
            <p>Merci,</p>
            <p>L'équipe de gestion des comptes utilisateurs</p>
        </body>
        </html>
    ";

        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        mail($mail, $subject, $message, $headers);
        //////Envoie d'un message vers la page de connexion
        $_SESSION['flash']['success'] = "Un email de confirmation a été envoyé à $mail. Veuillez verifier  votre adresse email afin de confirmer votre compte.";
        header('location:login.php');
        exit();
      
    }
}
 
?>

<?php
require_once 'includes/header.php'
?>

<form method="POST" action="" class=" p-6 rounded shadow max-w-lg mx-auto   ">
    <div class="flex flex-col gap-[7px] pt-[7px] justify-center ">
   
            <p class="bg-green-500 border-green-300 p-[9px] rounded focus:outline-none focus:border-green-500 text-white font-bold min-h-[30px]">
           
            </p>
      

        <div class="text-left flex flex-col gap-[7px]">
            <label for="pseudo">Pseudo :</label>
            <input type="text" placeholder="Votre pseudo" id="pseudo" name="pseudo" value="" required class="w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500" />
        </div>

        <div class="text-left flex flex-col gap-[7px]">
            <label for="mail">Email :</label>
            <input type="email" required placeholder="Votre mail" id="mail" value="" name="email" class="w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500" />
        </div>

        <div class="text-left flex flex-col gap-[7px]">
            <label for="password">Mot de passe</label>
            <div class="relative">
                <input type="password" required  placeholder="Votre mot de passe"  id="password" name="password" class="w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500" value=""  />
                <i class="fa-solid fa-eye absolute right-3 top-3 cursor-pointer text-gray-500" id="togglePassword"></i>
            </div>
        </div>

        <div class="text-left flex flex-col gap-[7px]">
            <input type="submit" name="forminscription" value="S'inscrire" class="w-full border  p-2 rounded focus:outline-none focus:border-green-500 bg-red-500 hover:bg-red-400" />
        </div>

        <div class="w-full text-left flex gap-[7px] justify-between">
            <a href="connexion.php" class="border  p-2 rounded focus:outline-none focus:border-green-500 bg-red-500 hover:bg-red-400" >Se connecter</a>
        </div>
    </div>
</form>


<?php
require_once 'includes/footer.php'
?>
