<div class="p-portlet rounded">

	<?php #	En-tête ?>
	<div class="p-portlet-head">
		
		<div class="p-portlet-head-label"><h3>Informations de base</h3></div>

	</div>


	<?php #	Contenu ?>
	<div class="p-portlet-body">

		<form action="" method="post" class="p-form-table">

			<div class="form-group mb-3<?= !empty($error) && count($error[1]) != 0 ? ' has-error' : '';  ?>">

				<label for="pseudo" class="mb-0">Identifiant / Pseudonyme&nbsp;<i class="text-danger font-weight-bold align-top">*</i></label>

				<input type="text" name="pseudo" id="pseudo" class="form-control p-form-ctrl p-form-ctrl-sm" value="<?= get_input("pseudo") ?: $utilisateur->pseudo; ?>" placeholder="Entrez l'identiant" autofocus autocomplete="off" required />

			<?= !empty($error[1]) 
				? '<span class="help-block mt-1">' . $error[1] . '</span>' 
				: '<small class="text-muted">Modifiez l\'identifiant de ' . $utilisateur->pseudo . '.</small>'; 
			?>

			</div>


			<button type="submit" name="basesubmit" class="btn btn-sm btn-primary p-btn-primary mb-3 mr-1 p-pill-submit">Editer</button>

		</form>

	</div>

</div>	