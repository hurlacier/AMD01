<?php
require_once 'inc/connexion.php';
spl_autoload_register(function($classe){
  require_once 'classes/'.$classe.'.class.php';
});

// **************** SERVICES POUR LES ABONNES ***************************************************************************
$managerAbonne = new AbonneManager($bdd);

// affichage
if(isset($_POST['action']) && $_POST['action']=='affiche_abonne') {

	echo json_encode( $managerAbonne->getListAbonne() );
}

// ajout
if(	isset($_POST['action']) && $_POST['action']=='ajout_abonne' &&
	isset($_POST['prenom']) && !empty($_POST['prenom']) &&
	isset($_POST['nom']) && !empty($_POST['nom']) ) {

	$abonne = new Abonne( array( 'prenom' => $_POST['prenom'], 'nom' => $_POST['nom'] ));
	echo json_encode( $managerAbonne->addAbonne($abonne) );
}

// suppression
if(	isset($_POST['action']) && $_POST['action']=='supprime_abonne' &&
	isset($_POST['id_abonne']) && !empty($_POST['id_abonne']) ) {

	echo json_encode($managerAbonne->deleteAbonne($_POST['id_abonne']));
}

// récupération des données pour update
if(	isset($_POST['action']) && $_POST['action']=='get_abonne' &&
	isset($_POST['id_abonne']) && !empty($_POST['id_abonne']) ) {

	echo json_encode($managerAbonne->getAbonnebyId($_POST['id_abonne']));
}

// update
if(	isset($_POST['action']) && $_POST['action']=='modification_abonne' &&
	isset($_POST['id_abonne']) && !empty($_POST['id_abonne']) &&
	isset($_POST['prenom']) && !empty($_POST['prenom']) &&
	isset($_POST['nom']) && !empty($_POST['nom']) ) {

	$abonne = new Abonne( array( 'id_abonne' => $_POST['id_abonne'], 'prenom' => $_POST['prenom'], 'nom' => $_POST['nom'] ));
	echo json_encode( $managerAbonne->updateAbonne($abonne) );
}

// **************** SERVICES POUR LES LIVRES ***************************************************************************
$managerLivre = new LivreManager($bdd);

// affichage
if(isset($_POST['action']) && $_POST['action']=='affiche_livre') {

	echo json_encode($managerLivre->getListLivre());
}

// ajout
if(	isset($_POST['action']) && $_POST['action']=='ajout_livre' &&
	isset($_POST['titre']) && !empty($_POST['titre']) &&
	isset($_POST['auteur']) && !empty($_POST['auteur']) ) {

	$livre = new Livre( array( 'titre' => $_POST['titre'], 'auteur' => $_POST['auteur'] ));
	echo json_encode( $managerLivre->addLivre($livre) );
}

// suppression
if(	isset($_POST['action']) && $_POST['action']=='supprime_livre' &&
	isset($_POST['id_livre']) && !empty($_POST['id_livre']) ) {

	echo json_encode($managerLivre->deleteLivre($_POST['id_livre']));
}

// récupération des données pour update
if(	isset($_POST['action']) && $_POST['action']=='get_livre' &&
	isset($_POST['id_livre']) && !empty($_POST['id_livre']) ) {

	echo json_encode($managerLivre->getLivrebyId($_POST['id_livre']));
}

// update
if(	isset($_POST['action']) && $_POST['action']=='modification_livre' &&
	isset($_POST['id_livre']) && !empty($_POST['id_livre']) &&
	isset($_POST['titre']) && !empty($_POST['titre']) &&
	isset($_POST['auteur']) && !empty($_POST['auteur']) ) {

	$livre = new Livre( array( 'id_livre' => $_POST['id_livre'], 'titre' => $_POST['titre'], 'auteur' => $_POST['auteur'] ));
	echo json_encode( $managerLivre->updateLivre($livre) );
}

// **************** SERVICES POUR LES EMPRUNTS ***************************************************************************
$managerEmprunt = new EmpruntManager($bdd);

// affichage
if(isset($_POST['action']) && $_POST['action']=='affiche_emprunt') {
	// avec reformatage de la date pour l'affichage
	$liste = $managerEmprunt->getListEmprunt();
	foreach ($liste as $key => $value) {
		$liste[$key]['date_emprunt'] = date('d/m/Y', strtotime($value['date_emprunt']));
	}
	echo json_encode($liste);
}

// ajout
if(	isset($_POST['action']) && $_POST['action']=='ajout_emprunt' &&
	isset($_POST['id_abonne']) && !empty($_POST['id_abonne']) &&
	isset($_POST['id_livre']) && !empty($_POST['id_livre']) &&
	isset($_POST['date_emprunt']) && !empty($_POST['date_emprunt']) ) {

	$emprunt = new Emprunt( array( 'id_abonne' => $_POST['id_abonne'], 'id_livre' => $_POST['id_livre'], 'date_emprunt' => $_POST['date_emprunt'] ));
	echo json_encode($managerEmprunt->addEmprunt($emprunt));
}

// suppression
if(	isset($_POST['action']) && $_POST['action']=='supprime_emprunt' &&
	isset($_POST['id_emprunt']) && !empty($_POST['id_emprunt']) ) {

	echo json_encode($managerEmprunt->deleteEmprunt($_POST['id_emprunt']));
}

// récupération des données pour update
if(	isset($_POST['action']) && $_POST['action']=='get_emprunt' &&
	isset($_POST['id_emprunt']) && !empty($_POST['id_emprunt']) ) {

	echo json_encode($managerEmprunt->getEmpruntbyId($_POST['id_emprunt']));
}

// update
if(	isset($_POST['action']) && $_POST['action']=='modification_emprunt' &&
	isset($_POST['id_abonne']) && !empty($_POST['id_abonne']) &&
	isset($_POST['id_livre']) && !empty($_POST['id_livre']) &&
	isset($_POST['date_emprunt']) && !empty($_POST['date_emprunt']) ) {

	$emprunt = new Emprunt( array( 'id_emprunt' => $_POST['id_emprunt'], 'id_abonne' => $_POST['id_abonne'], 'id_livre' => $_POST['id_livre'], 'date_emprunt' => $_POST['date_emprunt'] ));
	echo json_encode( $managerEmprunt->updateEmprunt($emprunt) );
}

// service spécifique pour 'emprunt' qui retourne les listes de livres et d'abonnés pour remplir les champs 'select' du formulaire.
if(isset($_POST['action']) && $_POST['action']=='listes_selects_emprunt') {

	$listes['abonne'] = $managerAbonne->getListAbonne();
	$listes['livre'] = $managerLivre->getListLivre();

	echo json_encode($listes);
}

// ****************************************************************************************************************************************************
