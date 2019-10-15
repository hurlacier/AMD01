<?php
// On inclut le "connecteur" à la bdd
include_once("../include/connexion.php");

// On va vérifier qu'on a reçu des données
if(isset($_POST) && !empty($_POST)){
	//Ici $_POST existe et n'est pas vide

	// On vérifie que TOUS les champs obligatoires existent
	if(
		isset($_POST['nom']) && !empty($_POST['nom']) && 
		isset($_POST['mail']) && !empty($_POST['mail']) && 
		isset($_POST['pass']) && !empty($_POST['pass']) &&
		isset($_POST['confirm_pass']) && !empty($_POST['confirm_pass'])){
		// Ici tous les champs obligatoires sont remplis
		// On crée les variables seulement maintenant, inutile si on ne va pas jusque là de toute façon
		$nom = preg_replace('/\s+/', '', filter_var($_POST['nom'], FILTER_SANITIZE_STRING));
		// On filtre le nom pour enlever toute forme de balises 'filter_var' et les espaces 'preg_replace'
		$mail = filter_var($_POST['mail'], FILTER_SANITIZE_EMAIL);
		// On filtre également le mail

		if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
			// On teste la validité du champ email

			if (!strcmp($_POST['pass'], $_POST['confirm_pass'])) {
			// Ici le mot de passe et sa confirmation sont identiques	

				if (preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).{8,}$#', $_POST['pass'])) {
				// Ici le mot de passe est conforme au regex demandé
				// Maintenant on peut encrypter le mot de passe, on dit 'hasher' en bon Franglais
					$password = password_hash($_POST['pass'], PASSWORD_BCRYPT);

					// On ajoute une entrée dans la table en utilisant des 'marqueurs' dans la préparation de la requête
					$new_user = $bdd->prepare('INSERT INTO user(nom, mail, password) VALUES (:nom, :mail, :password)');
					// On l'exécute en passant la valeur des marqueurs dans un tableau
					$new_user->execute(array('nom' => $nom, 'mail' => $mail, 'password' => $password));
					// On compte le nombre de lignes affectées par la requête si il est égal à 0 c'est que la requête
					// ne s'est pas exécutée correctement à cause de la contrainte 'Unique' sur l'email dans la bdd
					// et l'on gère le message à afficher sur la page en fonction des cas.

					if ($new_user->rowCount()) {
						// Ici tous c'est bien passé
						// On retourne à l'accueil
						header("Location:../index.php");
					} else { 
						// Ici l'email existe déjà
						header("Location:../inscription.php?Message=0"); 
				}
				} else { 
					//Ici le mot de passe ne correspond pas au format
					header("Location:../inscription.php?Message=1"); 
				}
			} else {
				// Ici le mot de passe et sa confirmation sont différents
				header("Location:../inscription.php?Message=2");
			}
		} else {
			// Ici le champs email est invalide
			header("Location:../inscription.php?Message=5");
		}		
	} else { 
		// Ici tous les champs ne sont pas remplis
		header('Location:../inscription.php?Message=3'); 
	}
} else {
	// Ici $_POST n'existe pas ou est vide
	header('Location:../inscription.php?Erreur=4');
}