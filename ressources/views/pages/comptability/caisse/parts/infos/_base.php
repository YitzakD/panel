<div class="p-portlet rounded">
	
	<?php #	En-tête ?>
	<div class="p-portlet-head">
		
		<div class="p-portlet-head-label">
			<h3>Mouvement de caisse</h3>
		</div>

	</div>


	<?php #	Contenu ?>
	<div class="p-portlet-body">
		
		<form action="" method="post" class="p-form-table">
			
			<div class="form-group mb-3<?= !empty($error) && count($error[1]) != 0 ? ' has-error' : '';  ?>">

				<label for="addingdate" class="mb-0">Date&nbsp;<i class="text-danger font-weight-bold align-top">*</i></label>

				<input type="date" name="addingdate" id="addingdate" class="form-control p-form-ctrl p-form-ctrl-sm" value="<?= get_input("addingdate"); ?>" placeholder="Entrez la date" autofocus required />

			<?= !empty($error[1]) 
				? '<span class="help-block mt-1">' . $error[1] . '</span>' 
				: '<small class="text-muted">Entrez la date de l\'opération.</small>'; 
			?>

			</div>

			<div class="form-group mb-3<?= !empty($error) && count($error[2]) != 0 ? ' has-error' : '';  ?>">

				<label for="typeof" class="mb-0">Type</label>

				<select name="typeof" class="form-control p-form-ctrl p-form-ctrl-sm">
					
					<option value="2">Sortie</option>

					<option value="1">Entrée</option>
				
				</select>

			<?= !empty($error[2]) 
				? '<span class="help-block mt-1">' . $error[2] . '</span>' 
				: '<small class="text-muted">sélectionnez le type de la transaction.</small>'; 
			?>

			</div>

			<div class="form-group mb-3<?= !empty($error) && count($error[3]) != 0 ? ' has-error' : '';  ?>">

				<label for="amount" class="mb-0">Montant&nbsp;<i class="text-danger font-weight-bold align-top">*</i></label>

				<input type="number" name="amount" id="amount" class="form-control p-form-ctrl p-form-ctrl-sm" value="<?= get_input("amount"); ?>" placeholder="Entrez le montant" required />

			<?= !empty($error[3]) 
				? '<span class="help-block mt-1">' . $error[3] . '</span>' 
				: '<small class="text-muted">Entrez le montant de la transaction.</small>'; 
			?>

			</div>

			<div class="form-group mb-3<?= !empty($error) && count($error[4]) != 0 ? ' has-error' : '';  ?>">

				<label for="justif" class="mb-0">Justification&nbsp;<i class="text-danger font-weight-bold align-top">*</i></label>

				<textarea name="justif" class="form-control p-form-ctrl p-form-ctrl-sm" placeholder="Entrez le justificatif" required><?= get_input("justif"); ?></textarea>

			<?= !empty($error[4]) 
				? '<span class="help-block mt-1">' . $error[4] . '</span>' 
				: '<small class="text-muted">Entrez le justificatif de la transaction.</small>'; 
			?>

			</div>


			<button type="submit" name="newsubmit_plus" class="btn btn-sm btn-primary p-btn-primary mb-3 mr-1">Ajouter</button>

		</form>

	</div>

</div>