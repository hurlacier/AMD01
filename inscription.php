<!DOCTYPE html>
<html lang="en">
<head>
    <?php require "include/head.php"; ?>
    <title>Aïda M'DALLA Cosmétique capillaire | Produits pour cheveux de qualité Professionnelle</title>
</head>
<body class="p-0 h-100">

<?php require "include/navbar.php"; ?>
<?php
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
    // On teste si une session de 'User' est déjà active
    if (isset($_SESSION['user_name']) && !empty($_SESSION['user_name'])) {
       header("Location:index.php?Message=0");
       exit;
       // tu t'en vas de là tu es déjà connecté donc tu retournes à l'accueil
       // et plus vite que çà !!
    }   
?>
<?php
echo '<a href="index.php"><button>RETOUR A LA CONNEXION</button></a>';
?>

<p><strong><u>Entrez vos informations d'inscription</u> :</strong></p>

<form class="mt-5 pt-5" action="traitements/traitement_inscription.php" method="post">
    <p>
   	<label for="nom">Nom : </label>
  	<input type="text" name="nom" placeholder="champ obligatoire"/><br><br>
  	<label for="mail">Email : </label>
  	<input type="email" name="mail" placeholder="champ obligatoire"/><br><br>
  	<label for="pass">Mot de passe : </label>		
  	<input type="password" name="pass" placeholder="champ obligatoire"/>
    <p><i>(8 caractères minimum avec au moins une lettre en majuscule et minuscule, un chiffre et un caractère spécial)</i></p>
    <label for="confirm_pass">Confirmer votre mot de passe : </label>        
    <input type="password" name="confirm_pass" placeholder="champ obligatoire"/><br><br>    
    <input type="submit" value="Valider" />
    </p>
</form>

<p style="color: red">
<?php
// On traite les retours de traitement_inscription.php en 'GET' pour afficher le message adapté
if (isset($_GET['Message'])) {
   switch ($_GET['Message']) {
        case '0':
            echo 'Votre eMail est déjà présent';
           break;
        case '1':
            echo 'Mot de passe non conforme';
           break;
        case '2':
            echo 'Les 2 mots de passe sont différents';
            break;
        case '3':
            echo 'Erreur dans les champs';
           break;
        case '4':
            echo 'Aucune donnée reçue';
            break;
        case '5':
            echo 'eMail invalide';
            break;                 
       default:
           break;
   }      
}
?>
<?php require "include/footer.php"; ?>
    
</body>
</html>