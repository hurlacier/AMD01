<?php
// On inclut le "connecteur" à la bdd
include_once("../include/connexion.php");

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
// On teste si une session de 'User' est déjà active
if (isset($_SESSION['user_name']) && !empty($_SESSION['user_name'])) {
   header("Location:../index.php");
   exit;
   // tu t'en vas de là tu es déjà connecté donc tu retournes à l'accueil
   // et plus vite que çà hop hop hop !!...
}   

// On va vérifier qu'on a reçu des données
if(isset($_POST) && !empty($_POST)){
	//Ici $_POST existe et n'est pas vide
	// on crée les variables seulement maintenant, inutile si on ne va pas jusque là de toute façon
	$mail_user = $_POST['mail'];
	$pass_user = $_POST['pass'];
	// On vérifie que TOUS les champs obligatoires existent
	if(
		isset($mail_user) && !empty($mail_user) && 
		isset($pass_user) && !empty($pass_user)){
		// Ici tous les champs obligatoires sont remplis

		if (filter_var($mail_user, FILTER_VALIDATE_EMAIL)) {
			// On teste la validité du champ email

			if (preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).{8,}$#', $_POST['pass'])) {
				// Ici le mot de passe est conforme au regex demandé

				// On ajoute une entrée dans la table en utilisant un 'marqueur' dans la préparation de la requête
				$login_user = $bdd->prepare('SELECT id, prenom, nom, mail, password FROM user WHERE mail = :mail');
				// On l'exécute en passant la valeur du marqueur :mail dans un tableau
				$login_user->execute(array('mail' => $mail_user));
				$user = $login_user->fetch();

					// On compte le nombre de lignes affectées par la requête si il est égal à 0 c'est que la requête
					// ne s'est pas exécutée correctement et l'on gère le message à afficher sur la page en fonction des cas
				if ($login_user->rowCount()) {
					// password_verify — Vérifie qu'un mot de passe correspond à un hachage
					if (password_verify ($pass_user, $user['password'])) {
					// Ici le mot de passe est le bon

					$mail = $_POST['mail'];
 
					// Récupération de la valeur du champ actif pour le mail $mail
					$stmt = $bdd->prepare("SELECT actif FROM user WHERE mail like :mail ");
					if($stmt->execute(array(':mail' => $mail))  && $row = $stmt->fetch())
					  {
						   $actif = $row['actif']; // $actif contiendra alors 0 ou 1
						   // Il ne nous reste plus qu'à tester la valeur du champ 'actif' pour
							// autoriser ou non le membre à se connecter
							
							if($actif == '1') // Si $actif est égal à 1, on autorise la connexion
							{
								// On mémorise le nom d'utilisateur dans la session
								// et on retourne à l'accueil
								$_SESSION['user_name'] = $user['prenom'];
								$_SESSION['user_names'] = $user['nom'];
								$_SESSION['user_mail'] = $user['mail'];
								$_SESSION['user_id'] = $user['id'];
								header("Location:../index.php?profile=".$_SESSION['user_id']."");
							}
						else // Sinon la connexion est refusé...
							{
								header("Location:../login.php?Message=8");
							}
					  }
					 
					
					} else {
					// Ici on a pas le bon mot de passe	
					header("Location:../login.php?Message=1");
					}
				} else {
					// Ici on a pas trouvé le mail dans la BDD
					header("Location:../login.php?Message=2");
				}	
			} else {
				// Ici le mot de passe est invalide dans son format
				header("Location:../login.php?Message=6");
			}	
		} else {
			// Ici le format de l'email est non valide
			header("Location:../login.php?Message=5");
		}
	} else {
		// Ici il y a une erreur sur les champs remplis
		header('Location:../login.php?Message=3');
	}
} else {
	// Ici $_POST n'existe pas ou est vide
	header('Location:../login.php?Erreur=4');
}
?>