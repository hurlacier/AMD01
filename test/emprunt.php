<?php require_once 'inc/header.php';?>

<!--******************************* tableau ***********************************************************-->

<div class="row">
	<div class="col-10 mx-auto">
		<div class='table-responsive my-4'>
		 <!--Table-->
			 <table class="table table-sm table-striped text-center">

				<thead>
					<tr>
						<th class="font-weight-bold">id_emprunt</th>
						<th class="font-weight-bold">Abonne</th>
						<th class="font-weight-bold">Livre</th>
						<th class="font-weight-bold">Date d'emprunt</th>
						<th class="font-weight-bold">Modification</th>
						<th class="font-weight-bold">Suppression</th>
					</tr>
				</thead>

				<tbody class="insert">
                    <!--********* A remplir dynamiquement avec JS et Ajax ***************-->					
				</tbody>

			 </table>
		<!--Table-->
		</div>
	</div>
</div>  <!-- fin de row -->

<!-- ************************************ formulaire d'ajout ******************************************-->

<div class="row">
    <div class="col-10 mx-auto">
        <form id="emprunt">

            <label for="id_abonne" class="font-weight-bold">Abonné</label>
			<select class="form-control my-2" name="id_abonne" id="select_id_abonne">
		<!--*********!!!!!!!!!!!!! A remplir dynamiquement avec JS et Ajax !!!!!!!!!!!!***************-->					
			</select>

            <label for="id_livre" class="font-weight-bold">Livre</label>				
			<select class="form-control my-2" name="id_livre" id="select_id_livre">
		<!--*********!!!!!!!!!!!!! A remplir dynamiquement avec JS et Ajax !!!!!!!!!!!!***************-->			
			</select>						

            <label for="date_emprunt" class="font-weight-bold">Date d'emprunt</label>
            <input class="form-control my-2" type="date" name="date_emprunt" id="date_emprunt" placeholder="date d'emprunt" required>                

            <input type="submit" class="btn btn-outline-blue-grey my-4"  id="envoyer" name="envoyer" value="Ajouter cet emprunt">

        </form>
    </div>
</div>  <!-- fin de row -->

<!--********************* Modal du formulaire d'Update *******************************************-->

<div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

        <div class="modal-header text-center">
            <h4 class="modal-title w-100 font-weight-bold"></h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div> 

        <div class="modal-body mx-3">
            <form id="emprunt_update">

                <label for="id_abonne" class="font-weight-bold">Abonné</label>
				<select class="form-control my-2" name="id_abonne" id="select_id_abonne_update">
		<!--*********!!!!!!!!!!!!! A remplir dynamiquement avec JS et Ajax !!!!!!!!!!!!***************-->
				</select>

                <label for="id_livre" class="font-weight-bold">Livre</label>				
				<select class="form-control my-2" name="id_livre" id="select_id_livre_update">
		<!--*********!!!!!!!!!!!!! A remplir dynamiquement avec JS et Ajax !!!!!!!!!!!!***************-->
				</select>

	            <label for="date_emprunt" class="font-weight-bold">Date d'emprunt</label>
	            <input class="form-control my-2" type="date" name="date_emprunt" id="date_emprunt_update" placeholder="date d'emprunt" required>				
				
            </form>
        </div>

      <div class="modal-footer d-flex justify-content-center">
            <button type="submit" class="btn btn-outline-blue-grey" id="btnSaveIt">Modifier cet emprunt</button>
            <button type="button" class="btn btn-blue-grey" id="btnCloseIt" data-dismiss="modal">Annuler</button>
      </div>

    </div>
  </div>
</div>

<!--********************* Fin de Modal du formulaire d'Update *******************************************-->

<?php
	$js = ['emprunt'];
	require_once('inc/footer.php');
?>