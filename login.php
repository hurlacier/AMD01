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
    <form class="text-center border border-light px-5 pt-5 col-4" action="#!">

    <p class="h4 mb-4">Connexion</p>

    <p>
        Vous n'avez pas de compte? <a href="" target="_blank">Inscrivez-vous.</a>
    </p>

    <!-- Name -->
    <input type="email" id="mail" class="form-control mb-4" placeholder="Votre adresse mail">

    <!-- Email -->
    <input type="password" id="password" class="form-control mb-4" placeholder="Votre mot de passe">

    <!-- Sign in button -->
    <button class="btn btn-dark btn-block" type="submit">Se connecter</button>

    <p>
        <a href="" target="_blank">Mot de passe oubié?</a>
    </p>


    </form>
    <!-- Default form subscription -->
</main>

<?php require "include/footer.php"; ?>
    
</body>
</html>