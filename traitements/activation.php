<?php
 // On inclut le "connecteur" à la bdd
include_once("../include/connexion.php");
 
 
// Récupération des variables nécessaires à l'activation
$mail = $_GET['log'];
$cle = $_GET['cle'];
 
// Récupération de la clé correspondant au $mail dans la base de données
$stmt = $bdd->prepare("SELECT cle, actif FROM user WHERE mail like :mail ");
if($stmt->execute(array(':mail' => $mail)) && $row = $stmt->fetch())
  {
    $clebdd = $row['cle'];	// Récupération de la clé
    $actif = $row['actif']; // $actif contiendra alors 0 ou 1
  }
 
 
// On teste la valeur de la variable $actif récupéré dans la BDD
if($actif == '1') // Si le compte est déjà actif on prévient
  {
     echo "Votre compte est déjà actif !";
  }
else // Si ce n'est pas le cas on passe aux comparaisons
  {
     if($cle == $clebdd) // On compare nos deux clés	
       {
          // Si elles correspondent on active le compte !	
          echo "Votre compte a bien été activé !";
 
          // La requête qui va passer notre champ actif de 0 à 1
          $stmt = $bdd->prepare("UPDATE user SET actif = 1 WHERE mail like :mail ");
          $stmt->bindParam(':mail', $mail);
          $stmt->execute();
          header("Location:../index.php?Message=6");
       }
     else // Si les deux clés sont différentes on provoque une erreur...
       {
          echo "Erreur ! Votre compte ne peut être activé...";
       }
  }
 
 
//...	
// Fermeture de la connexion	
//...
// Votre code
//...