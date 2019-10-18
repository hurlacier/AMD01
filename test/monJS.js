$(document).ready(function(){

    //Initialisation du site et affichage du tableau de données de véhicules
    function afficheLivre() {
        $.post ('ajax.php',  // URL du dossier où s'effectue le traitement
                'action=affiche', // Valeur à 'envoyer', ici pas de valeurs à envoyer uniquement une indication pour le traitement
                // Fonction de retour du traitement permettant l'affichage (donnees) est le retour du traitement suite à (echo) en PHP
                function (donnees) { //traitement de la réponse
                    console.log(donnees); // pensez à vérifier vos données ça peut servir !!
                    // je recupère mon tableau de véhicules et ma variable de contrôle en JSON envoyés par PHP en echo
                    if(donnees.resultat){
                        let tab=''; // on initialise une variable pour mettre en forme le tableau
                        // je parcours mon tableau de Véhicules avec une boucle forEach et oui la même qu'en PHP !!
                        // et je crée ainsi un tableau HTML contenant les valeurs
                        donnees.biblio.forEach(livre => {
                            tab += '<tr>';
                                tab += '<td>'+livre.id_livre+'</td>';
                                tab += '<td>'+livre.titre+'</td>';
                                tab += '<td>'+livre.auteur+'</td>';
                            tab += '</tr>';
                        });
                    // j'insère mon tableau ainsi créé dans le DOM pour affichage
                    $('.insert').html('');
                    $('.insert').append(tab);
                    }
                }, 'json'); // format attendu pour le retour
    }  // fin de la fonction afficheVehicule

    afficheLivre();


   //soumission du formulaire et déclenchement de l'événement
    $('#livre').on('submit', function(e){
        e.preventDefault(); //j'annule l'envoie du formulaire
        $('.msg').html(); //j'efface tout dans la div msg

        //je constitue mon paramètre
        let params='action=insert'; // indication pour le traitement en PHP
        let erreurForm='';
        // je teste tous les champs input un par un si il est vide on stocke un message d'erreur
        // sinon on mémorise la valeur dans une variable 'params'
        // et on le fait pour chaque
        if ($('#titre').val().length==0) {
            erreurForm += '<div>le titre ne peut pas être vide</div>';
        } else {
            params += '&titre='+$('#titre').val();
        }
        if ($('#auteur').val().length==0) {
            erreurForm += '<div>l\'auteur ne peut pas être vide</div>';
        } else {
            params += '&auteur='+$('#auteur').val();
        }
        if(erreurForm.length==0){
            // si erreurForm  = 0 alors ca veut dire qu'il n'y a pas d'erreurs
            // j'envoie ma requête ajax
            // console.log(params); // pensez à vérifier vos données ça peut servir !!
            $.post('ajax.php', // URL du dossier où s'effectue le traitement
                    params,  // Valeurs à 'envoyer' contenues dans la variable params
                    function (donnees) {  //traitement de la réponse
                        console.log(donnees);
                        //traitement de la réponse
                        if(donnees.resultat){
                            afficheResultat = '<div>vous avez ajouté le livre avec succès !</div>';
                            $('#livre').find('input').val(''); // reset du formulaire : on va chercher les enfants de type input et on leur met une valeur vide
                            // autre méthode qui fonctionne aussi
                            //$('#vehicule')[0].reset();
                            afficheLivre(); // pour actualiser le résultat
                        } else {
                            afficheResultat = '<div>une erreur est survenue lors de l\'ajout du livre !</div>';
                        }
                        // On insère le message de résultat dans le DOM
                        $('.msg').html(afficheResultat);
                    }, 'json')
        } else {
            // Affichage des messages d'erreurs suivant les champs Input vides
            $('.msg').html(erreurForm);
        }
    }); //fin de l'event

}) //fin du document ready

