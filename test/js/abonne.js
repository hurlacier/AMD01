$(document).ready(function(){

// AFFICHAGE DU TABLEAU D'ABONNES ***************************************************************************************************
function afficheAbonne() {
    $.post ('Traitement.php',  // URL du dossier où s'effectue le traitement
            'action=affiche_abonne', // Valeur à 'envoyer', ici pas de valeurs à envoyer uniquement une indication pour le traitement
            function (abonnes) {
                // console.log(abonnes); // pensez à vérifier vos données ça peut servir !!
                if(abonnes.length > 0){
                    let tab='';
                    abonnes.forEach(abonne => {
                        tab += '<tr>';
                            tab += '<td>'+abonne.id_abonne+'</td>';
                            tab += '<td>'+abonne.prenom+'</td>';
                            tab += '<td>'+abonne.nom+'</td>';
                            tab += '<td><i id='+abonne.id_abonne+' class="modifier fas fa-pen blue-text"></i></td>';
                            tab += '<td><i id='+abonne.id_abonne+' class="effacer fas fa-times blue-text"></i></td>';
                            tab += '</tr>';
                    });
                    $('.insert').append(tab);
                }
            }, 'json'); // format attendu pour le retour
}  // fin de la fonction afficheAbonne

afficheAbonne();

//  AJOUT D'UN ABONNE **************************************************************************************************************
//soumission du formulaire et déclenchement de l'événement
$('#abonne').on('submit', function(e){
    e.preventDefault(); //j'annule l'envoi du formulaire
    //je constitue mon paramètre
    let params='action=ajout_abonne&'+$(this).serialize();
    //console.log(params); // pensez à vérifier vos données ça peut servir !!
    $.post('Traitement.php', // URL du dossier où s'effectue le traitement
            params,  // Valeurs à 'envoyer' contenues dans la variable params
            function (ajout) {
 				if (ajout) {
                    $('.insert').html('');
                    afficheAbonne();
            	}
                $('#abonne')[0].reset();  // reset du formulaire pour effacer les champs
            }, 'json');
}); //fin de l'event d'ajout


// EFFACEMENT D'UN ABONNE *************************************************************************************************************

$('.insert').on('click','.effacer', function(e) {
	e.preventDefault();
	let efface_id = $(this).attr('id');
    let ligne_a_effacer = $(this).closest('tr');
	let choix = confirm('Voulez vous effacer l\'abonné n° '+efface_id);
	if (choix) {
		// traitement ajax de l'effacement
		params = 'action=supprime_abonne&id_abonne='+efface_id;
	    $.post('Traitement.php', // URL du dossier où s'effectue le traitement
	            params,  // Valeurs à 'envoyer' contenues dans la variable params
	            function (supprime) {
	 				if (supprime) {
	 					// on efface uniquement la ligne qui vient d'être effacé en BDD dans le tableau
	 					ligne_a_effacer.remove();
	            	}
	            }, 'json');	// fin de l'ajax
	}
}); // fin de l'event d'effacement


// UPDATE D'UN ABONNE ****************************************************************************************************************
// ouverture de la modal avec les infos de l'abonné à modifier
var update_id = ''; // sauvegarde de l'id de l'abonné à modifier utilisé dans les deux fonctions Ajax qui suivent donc on le garde au chaud
var ligne_a_modifier = '';

$('.insert').on('click','.modifier', function(e) {
	e.preventDefault();
	update_id = $(this).attr('id'); // on conserve l'ID de la ligne que l'on modifie
	ligne_a_modifier = $(this).closest('tr'); // on mémorise la ligne qu'il faudra éventuellement modifier à la fin du processus
	infos_abonne = 'action=get_abonne&id_abonne='+update_id;
    $.post('Traitement.php', // URL du dossier où s'effectue le traitement
            infos_abonne,  // Valeurs à 'envoyer' contenues dans la variable params
            function (infos) {
            	$('.modal-title').html('Modification de l\'abonné n° '+update_id); // on prépare le titre de la modal
				$('#prenom_update').val(infos.prenom);	// on prépare les champs input avec les valeurs à modifier
				$('#nom_update').val(infos.nom);
				$('#modalLoginForm').modal('show');	  // on montre la modal
            }, 'json');	// fin de l'ajax
});

// validation des modifications et mise à jour de la BDD
$("#btnSaveIt").on('click', function (e) {
	e.preventDefault();
	let update_prenom = $('#prenom_update').val();  // nouvelles valeurs que l'on mémorise
	let update_nom = $('#nom_update').val();
    let params='action=modification_abonne&'+$('#abonne_update').serialize()+'&id_abonne='+update_id;
    $.post('Traitement.php', // URL du dossier où s'effectue le traitement
            params,  // Valeurs à 'envoyer' contenues dans la variable params
            function (update) {
            	if (update) {
                    // on ne va remettre à jour à l'écran uniquement la ligne qui vient d'être modifié en BDD dans le tableau
                    // pour cela on utilise les variables sauvegardées si l'on entre ici c'est qu'elles ont été vérifiées
                    let ligne='';
                    ligne += '<tr>';
                        ligne += '<td>'+update_id+'</td>';
                        ligne += '<td>'+update_prenom+'</td>';
                        ligne += '<td>'+update_nom+'</td>';
                        ligne += '<td><i id='+update_id+' class="modifier fas fa-pen blue-text"></i></td>';
                        ligne += '<td><i id='+update_id+' class="effacer fas fa-times blue-text"></i></td>';
     				ligne += '</tr>';
                    ligne_a_modifier.replaceWith(ligne);
            	}
				$('#modalLoginForm').modal('hide'); // on referme la modal
                $('#abonne_update')[0].reset();  // reset du formulaire pour effacer les champs juste pour être propre !!
				update_id=''; // on reset les variables de sauvegarde toujours pour être propre !!
				ligne_a_modifier = '';
            }, 'json');	// fin de l'ajax
});

}) //fin du document ready
