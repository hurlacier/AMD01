<?php
require_once 'connexion.php';

if(isset($_POST['action']) && $_POST['action']=='affiche'){   //je recois la requete ajax pour afficher les véhicules

    // J'effectue la requête de lecture dans la table que je renvoie dans un tableau
    $tab['biblio'] = $bdd->query('SELECT * FROM livre')->fetchAll(PDO::FETCH_ASSOC);
    // Je prépare une variable qui me permettra de savoir si j'ai des véhicules dans ma base de données
    $tab['resultat'] = false;
    // Je regarde si le tableau contien des véhicules si oui la variable passe à 'Vrai'
    if ( count($tab['biblio']) > 0 ) {
        $tab['resultat'] = true;
    }
    // je renvoie mon tableau de véhicules et ma variable de controle en JSON à la requête Ajax
    echo json_encode($tab);
}


if(isset($_POST['action']) && $_POST['action']=='insert'){  //je recois la requete ajax pour inserer un véhicule

    //j'écris ma requête SQL d'insertion puis j'affecte les valeurs envoyées par la méthode AJAX en 'POST'
    $insertVehicule = $bdd->prepare('INSERT INTO livre (titre, auteur) VALUES (:titre, :auteur)');
    $insertVehicule->bindValue(':titre', $_POST['titre'], PDO::PARAM_STR);
    $insertVehicule->bindValue(':auteur', $_POST['auteur'], PDO::PARAM_STR);
    // Je prépare une variable qui me permettra de savoir si l'insertion c'est bien déroulé
    $tab['resultat']=false;
    // J'execute la requête et je contrôle si tout c'est bien passé ma variable est 'Vrai'
    if($insertVehicule->execute()===true){
        //insert réussit
        $tab['resultat']=true;
    }
    // je renvoie la variable de controle en JSON à la requête Ajax
    echo json_encode($tab);
}
