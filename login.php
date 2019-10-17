<!DOCTYPE html>
<html lang="en">
<head>
    <?php require "include/head.php"; ?>
    <title>Aïda M'DALLA Cosmétique capillaire | Connexion</title>
</head>
<body class="p-0 h-100">

<?php require "include/navbar.php"; ?>

<main class="vh-100 row justify-content-center align-items-center w-100">
    <!-- Default form subscription -->
    <form class="text-center border border-light px-5 pt-5 col-4" action="traitements/login.php"  method="post">

    <p class="h4 mb-4">Connexion</p>

    <p>
        Vous n'avez pas de compte? <a href="inscription.php">Inscrivez-vous.</a>
    </p>

    <label for="mail">Votre Email : </label>
    <input type="mail" name="mail" class="form-control mb-4" placeholder="Votre adresse mail">

    <label for="pass">Votre mot de passe : </label>  
    <input type="password" name="pass" class="form-control mb-4" placeholder="Votre mot de passe">

    <div class="custom-control custom-checkbox">
        <input type="checkbox" name="maintienco" id="maintienco" class="custom-control-input">
        <label class="custom-control-label" for="maintienco">Rester connecté?</label>
    </div>

    
    <button class="btn btn-dark btn-block" type="submit" value="Valider">Se connecter</button>

    <p>
        <a href="" target="_blank">Mot de passe oubié?</a>
    </p>
    <p style="color: red">
        <?php
        // On traite les retours de login.php en 'GET' pour afficher le message adapté
        if (isset($_GET['Message'])) {
        switch ($_GET['Message']) {
                case '0':
                    echo 'Vous devez vous déconnecter d\'abord !!';
                break;
                case '1':
                    echo 'Mauvais mot de passe';
                break;
                case '2':
                    echo 'Compte inconnu';
                break;
                case '3':
                    echo 'Erreur dans les champs';
                break;
                case '4':
                    echo 'Aucune donnée reçue';
                    break;
                case '5':
                    echo 'l\'email est invalide';
                    break;
                case '6':
                    echo 'Format de mot de passe invalide';
                    break;             
                case '7':
                    echo '!! Merci vous êtes bien enregistré !!';
                    break; 
                case '8':
                    echo '!! Merci de bien vouloir activer votre compte !!';
                 break; 
            default:
                break;
        }
        }?>
        <hr>
    </p>


    </form>
    <!-- Default form subscription -->
</main>

<?php require "include/footer.php"; ?>
    
</body>
</html>