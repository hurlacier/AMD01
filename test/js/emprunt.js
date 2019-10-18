$(document).ready(function(){

// CREATION DES SELECTS DANS LE FORMULAIRE *******************************************************************************************

// on recupère avec Ajax le contenu des listes des champs 'select' dans le formulaire
function creationFormulaire() {
	let select_abonne = $('#select_id_abonne');
	let select_livre = $('#select_id_livre');
    // on ajoute les 2 champs d'infos
	select_abonne.append('<option selected disabled>Choisir l\'abonné</option>');
	select_livre.append('<option selected disabled>Choisir le livre</option>');
    // on demande le contenu
	$.post ('Traitement.php',  
	       	'action=listes_selects_emprunt', 
            // on crée les 2 listes 'select' avec 2 boucles pour remplir les champs selon le format désiré
	       	function (listes) {  
	       		listes.abonne.forEach(liste => {
					select_abonne.append($('<option></option>').attr('value', liste.id_abonne).text(liste.prenom+'  '+liste.nom));
		  		});
		  		listes.livre.forEach(liste => {
					select_livre.append($('<option></option>').attr('value', liste.id_livre).text(liste.titre+' de '+liste.auteur));
		  		});
	       	}, 'json');
} // fin de la fonction creationFormulaire

creationFormulaire();

// AFFICHAGE DU TABLEAU D'EMPRUNTS ***************************************************************************************************

function afficheEmprunt() {
    $.post ('Traitement.php',  // URL du dossier où s'effectue le traitement
            'action=affiche_emprunt', // Valeur à 'envoyer', ici pas de valeurs à envoyer uniquement une indication pour le traitement
            function (emprunts) {
                if(emprunts.length > 0){
                    let tab=''; 
                    emprunts.forEach(emprunt => {
                        tab += '<tr>';
                            tab += '<td>'+emprunt.id_emprunt+'</td>';                           
                            tab += '<td><p>'+emprunt.prenom+' '+emprunt.nom+'</p><p>'+emprunt.id_abonne+'</p></td>';
                            tab += '<td><p>'+emprunt.titre+'</p><p>'+emprunt.auteur+'</p><p>'+emprunt.id_livre+'</p></td>';
                            tab += '<td>'+emprunt.date_emprunt+'</td>';
                            tab += '<td><i id='+emprunt.id_emprunt+' class="modifier fas fa-pen blue-text"></i></td>';     
                            tab += '<td><i id='+emprunt.id_emprunt+' class="effacer fas fa-times blue-text"></i></td>';                                
                     	tab += '</tr>';
                    });
                    $('.insert').append(tab);
                }
            }, 'json'); // format attendu pour le retour
}  // fin de la fonction afficheAbonne

afficheEmprunt();

//  AJOUT D'UN EMPRUNT **************************************************************************************************************

//soumission du formulaire et déclenchement de l'événement
$('#emprunt').on('submit', function(e){
    e.preventDefault(); //j'annule l'envoi du formulaire
    //je constitue mon paramètre
    let params = 'action=ajout_emprunt&'+$(this).serialize();
    $.post('Traitement.php', // URL du dossier où s'effectue le traitement
            params,  // Valeurs à 'envoyer' contenues dans la variable params
            function (ajout) {
 				if (ajout) {
                    $('.insert').html('');
                    afficheEmprunt(); 						
            	}
                $('#emprunt')[0].reset();  // reset du formulaire pour effacer les champs
            }, 'json');
}); //fin de l'event d'ajout

// EFFACEMENT D'UN EMPRUNT *************************************************************************************************************

$('.insert').on('click','.effacer', function(e) {
    e.preventDefault();
    let efface_id = $(this).attr('id');
    let ligne_a_effacer = $(this).closest('tr');   
    let choix = confirm('Voulez vous effacer l\'emprunt n° '+efface_id);
    if (choix) {
        // traitement ajax de l'effacement
        params = 'action=supprime_emprunt&id_emprunt='+efface_id;
        $.post('Traitement.php', // URL du dossier où s'effectue le traitement
                params,  // Valeurs à 'envoyer' contenues dans la variable params
                function (supprime) {
                     if (supprime) {
                         // on efface uniquement la ligne qui vient d'être effacé en BDD dans le tableau
                         ligne_a_effacer.remove();                    
                    }
                }, 'json');    // fin de l'ajax       
    }
}); // fin de l'event d'effacement

// UPDATE D'UN EMPRUNT ****************************************************************************************************************
// ouverture de la modal avec les infos de l'emprunt à modifier
var update_id = ''; // sauvegarde de l'id de l'emprunt à modifier utilisé dans les deux fonctions Ajax qui suivent donc on le garde au chaud

// on prépare le formulaire de la modal
function updateFormulaire(idabonne, idlivre) {
	let select_abonne = $('#select_id_abonne_update');
	let select_livre = $('#select_id_livre_update');
    // on les vide au cas où
	select_abonne.empty();
	select_livre.empty();
	$.post ('Traitement.php',  
	       'action=listes_selects_emprunt', 
	       function (listes) {        
	       		listes.abonne.forEach(liste => {
	       			if (liste.id_abonne == idabonne ) {
	       				select_abonne.append($('<option selected></option>').attr('value', liste.id_abonne).text(liste.prenom+'  '+liste.nom));
	       			} else {
	       				select_abonne.append($('<option></option>').attr('value', liste.id_abonne).text(liste.prenom+'  '+liste.nom));	
	       			}	
		  		});
		  		listes.livre.forEach(liste => {
		  			if (liste.id_livre == idlivre) {
						select_livre.append($('<option selected></option>').attr('value', liste.id_livre).text(liste.titre+' de '+liste.auteur));
		  			} else {
						select_livre.append($('<option></option>').attr('value', liste.id_livre).text(liste.titre+' de '+liste.auteur));		  				
					}
		  		});
	       }, 'json');
} // fin de la fonction updateFormulaire

// Initialisation de la 'modal' de formulaire avec les infos des champs 'select'
$('.insert').on('click','.modifier', function(e) {
	e.preventDefault();
	update_id = $(this).attr('id');
	infos_emprunt = 'action=get_emprunt&id_emprunt='+update_id;
    $.post('Traitement.php', // URL du dossier où s'effectue le traitement
            infos_emprunt,  // Valeurs à 'envoyer' contenues dans la variable params
            function (infos) {
            	$('.modal-title').html('Modification de l\'emprunt n° '+update_id);
            	updateFormulaire (infos.id_abonne, infos.id_livre); // on met à jour le formulaire en présélectionnant les champs correspondants
            	$('#date_emprunt_update').val(infos.date_emprunt); // idem pour le champ 'date'
				$('#modalLoginForm').modal('show');	// on appelle la modal				
            }, 'json');	// fin de l'ajax
});

// validation des modifications et mise à jour de la BDD
$("#btnSaveIt").on('click', function(e) {
	e.preventDefault();
    let params='action=modification_emprunt&'+$('#emprunt_update').serialize()+'&id_emprunt='+update_id;
    $.post('Traitement.php', // URL du dossier où s'effectue le traitement
            params,  // Valeurs à 'envoyer' contenues dans la variable params
            function (update) {  
                 if (update) {
	            	$('.insert').html('');
					afficheEmprunt();   			
            	}   	
				$('#modalLoginForm').modal('hide'); // on cache la modal
            	$('#emprunt')[0].reset();  // reset du formulaire pour effacer les champs juste pour être propre !!				
				update_id=''; // on reset les variables de sauvegarde toujours pour être propre !!
				ligne_a_modifier = '';
            }, 'json');	// fin de l'ajax
});

}) //fin du document ready