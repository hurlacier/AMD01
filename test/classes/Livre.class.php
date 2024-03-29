<?php
class Livre {

  private $id_livre;
  private $titre;
  private $auteur;

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

  public function getId_livre() { return $this->id_livre; }
  public function getTitre() { return $this->titre; }
  public function getAuteur() { return $this->auteur; }

  private function setId_livre($id) {
    $this->id_livre = $id;
  }

  public function setTitre($titre) {
    if (is_string($titre) && strlen($titre) <= 50) {
      $this->titre = $titre;
    }  else {
        echo 'ERREUR LIVRE TITRE'; die();
    }
  }

  public function setAuteur($auteur) {
    if (is_string($auteur) && strlen($auteur) <= 50) {
      $this->auteur = $auteur;
    }  else {
        echo 'ERREUR LIVRE AUTEUR'; die();
    }
  }

  public function __construct(array $donnees) {
    $this->hydrate($donnees);
  }
}
