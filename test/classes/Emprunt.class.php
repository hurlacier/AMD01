<?php

class Emprunt {

	private $id_emprunt;
	private $id_abonne;
	private $id_livre;
	private $date_emprunt;

	// Un tableau de données doit être passé à la fonction (d'où le préfixe « array »).
	public function hydrate(array $donnees) {
	 foreach ($donnees as $key => $value) {
	  // On récupère le nom du setter correspondant à l'attribut.
	  $method = 'set'.ucfirst($key);
	  // Si le setter correspondant existe.
	  if (method_exists($this, $method)) {
	    // On appelle le setter.
	    $this->$method($value);
	  }
	 }
	}

	public function getId_emprunt() { return $this->id_emprunt; }
	public function getId_abonne() { return $this->id_abonne; }
	public function getId_livre() { return $this->id_livre; }
	public function getDate_emprunt() { return $this->date_emprunt; }

	private function setId_emprunt($id) {
		$this->id_emprunt = $id;
	}

	public function setId_abonne($id) {
		$this->id_abonne = $id;
	}

	public function setId_livre($id) {
		$this->id_livre = $id;
	}

	public function setDate_emprunt($date) {
		$this->date_emprunt = $date;
	}

	public function __construct(array $donnees) {
	$this->hydrate($donnees);
	}
}
